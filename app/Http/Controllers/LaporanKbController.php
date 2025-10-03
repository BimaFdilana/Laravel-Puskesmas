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
    /**
     * Menampilkan halaman form filter untuk Laporan KB.
     */
    public function index()
    {
        return view('pages.apps.pustu.keluarga_berencana.laporan_kb.index');
    }

    /**
     * Menangani proses ekspor Laporan KB ke Excel.
     */
    public function export(Request $request)
    {
        // Ambil filter bulan dan tahun
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        // Ambil semua data Posyandu untuk baris
        $allPosyandu = Posyandu::orderBy('nama_posyandu')->get();

        // Ambil data Peserta KB sesuai periode
        $kbRecords = PesertaKbBaru::whereMonth('tanggal_pelayanan', $bulan)
            ->whereYear('tanggal_pelayanan', $tahun)
            ->get();

        // Proses data menjadi struktur laporan (pivot)
        $reportData = [];
        foreach ($allPosyandu as $posyandu) {
            $rowData = ['nama_desa' => $posyandu->nama_posyandu];

            // Inisialisasi semua kemungkinan kombinasi dengan 0
            $allKontrasepsi = ['PIL', 'SUNTIK', 'KONDOM', 'IUD', 'IMPLAN', 'MOW', 'MOP'];
            $allJalur = ['UMUM', 'BPJS/K', 'PASCA SALIN'];
            foreach ($allKontrasepsi as $kontrasepsi) {
                foreach ($allJalur as $jalur) {
                    $rowData[$kontrasepsi][$jalur] = 0;
                }
            }

            // Hitung data yang ada
            foreach ($kbRecords->where('posyandu_id', $posyandu->id) as $record) {
                $rowData[$record->jenis_kontrasepsi][$record->jalur_layanan]++;
            }

            $reportData[] = $rowData;
        }

        $namaBulan = Carbon::create()->month($bulan)->translatedFormat('F');
        $namaFile = "Laporan KB Peserta Baru - {$namaBulan} {$tahun}.xlsx";

        return Excel::download(new LaporanKbExport($reportData, $namaBulan, $tahun), $namaFile);
    }
}