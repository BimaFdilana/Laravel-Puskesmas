<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posyandu;
use App\Models\PesertaKbBaru;
use App\Exports\LaporanKbExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class LaporanKbController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('filter_type')) {
            $data = $this->getData($request);
            return view('pages.apps.pustu.keluarga_berencana.laporan_kb.index', $data);
        }
        return view('pages.apps.pustu.keluarga_berencana.laporan_kb.index');
    }

    public function export(Request $request)
    {
        $data = $this->getData($request);
        $namaFile = "Laporan KB Peserta Baru - {$data['periode']}.xlsx";
        return Excel::download(new LaporanKbExport($data['reportData'], $data['periode'], $data['tahun']), $namaFile);
    }

    private function getData(Request $request)
    {
        $filterType = $request->input('filter_type', 'monthly');
        $periode = 'Semua Data';
        $tahun = now()->year;

        $kbQuery = PesertaKbBaru::query();

        if ($filterType === 'monthly') {
            $bulan = $request->input('bulan', now()->month);
            $tahun = $request->input('tahun_bulanan', now()->year);
            $kbQuery->whereMonth('tanggal_pelayanan', $bulan)->whereYear('tanggal_pelayanan', $tahun);
            $periode = Carbon::create()->month($bulan)->translatedFormat('F') . " {$tahun}";
        } elseif ($filterType === 'yearly') {
            $tahun = $request->input('tahun_tahunan', now()->year);
            $kbQuery->whereYear('tanggal_pelayanan', $tahun);
            $periode = "Tahun {$tahun}";
        } elseif ($filterType === 'range') {
            $start = $request->input('start_date', now()->startOfMonth()->toDateString());
            $end = $request->input('end_date', now()->endOfMonth()->toDateString());
            $kbQuery->whereBetween('tanggal_pelayanan', [$start, $end]);
            $periode = Carbon::parse($start)->format('d/m/Y') . ' - ' . Carbon::parse($end)->format('d/m/Y');
            $tahun = Carbon::parse($start)->year;
        }

        $userIdToFilter = null;
        if ($request->has('user_id') && auth()->user()->role_id == 1) {
            $userIdToFilter = $request->user_id;
        } elseif (auth()->user()->role_id == 2) {
            $userIdToFilter = auth()->id();
        }
        if ($userIdToFilter) {
            $kbQuery->where('user_id', $userIdToFilter);
        }

        $kbRecords = $kbQuery->get();

        $posyanduQuery = Posyandu::query();
        if ($userIdToFilter) {
            $posyanduQuery->where('user_id', $userIdToFilter);
        }
        $allPosyandu = $posyanduQuery->orderBy('nama_posyandu')->get();

        $allKontrasepsi = ['PIL', 'SUNTIK', 'KONDOM', 'IUD', 'IMPLAN', 'MOW', 'MOP'];
        $allJalur = ['UMUM', 'BPJS/K', 'PASCA SALIN'];

        $reportData = [];

        foreach ($allPosyandu as $posyandu) {
            $rowData = [
                'nama_desa' => $posyandu->nama_posyandu,
            ];


            foreach ($allKontrasepsi as $kontrasepsi) {
                foreach ($allJalur as $jalur) {
                    $rowData[$kontrasepsi][$jalur] = 0;
                }
            }

            foreach ($kbRecords->where('posyandu_id', $posyandu->id) as $record) {
                if (isset($rowData[$record->jenis_kontrasepsi][$record->jalur_layanan])) {
                    $rowData[$record->jenis_kontrasepsi][$record->jalur_layanan]++;
                }
            }
            $reportData[] = $rowData;
        }

        return [
            'reportData' => $reportData,
            'periode' => $periode,
            'tahun' => $tahun,
            'allKontrasepsi' => $allKontrasepsi,
            'allJalur' => $allJalur
        ];
    }
}