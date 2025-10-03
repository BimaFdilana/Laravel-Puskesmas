<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\SurveilansPenyakit;
use App\Exports\LaporanSurveilansExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class LaporanSurveilansController extends Controller
{
    public function index()
    {
        return view('pages.apps.pustu.penyakit.laporan_penyakit.index');
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        // 1. Ambil semua jenis penyakit sebagai baris
        $allPenyakit = Penyakit::orderBy('id')->get();

        // 2. Ambil data surveilans mentah pada periode yang dipilih
        $records = SurveilansPenyakit::whereMonth('tanggal_kunjungan', $bulan)
            ->whereYear('tanggal_kunjungan', $tahun)
            ->get();

        // 3. Siapkan struktur data laporan dan definisikan kelompok umur
        $reportData = [];
        $ageGroups = [
            '0-7 Hr' => ['start' => 0, 'end' => 7, 'unit' => 'day'],
            '8-28 Hr' => ['start' => 8, 'end' => 28, 'unit' => 'day'],
            '< 1' => ['start' => 29, 'end' => 364, 'unit' => 'day'], // Di atas 28 hari, di bawah 1 tahun
            '1-4' => ['start' => 1, 'end' => 4, 'unit' => 'year'],
            '5-9' => ['start' => 5, 'end' => 9, 'unit' => 'year'],
            '10-14' => ['start' => 10, 'end' => 14, 'unit' => 'year'],
            '15-19' => ['start' => 15, 'end' => 19, 'unit' => 'year'],
            '20-44' => ['start' => 20, 'end' => 44, 'unit' => 'year'],
            '45-54' => ['start' => 45, 'end' => 54, 'unit' => 'year'],
            '55-59' => ['start' => 55, 'end' => 59, 'unit' => 'year'],
            '60-69' => ['start' => 60, 'end' => 69, 'unit' => 'year'],
            '70+' => ['start' => 70, 'end' => 200, 'unit' => 'year'], // Batas atas besar untuk mencakup semua
        ];

        // 4. Inisialisasi data laporan dengan nilai 0
        foreach ($allPenyakit as $penyakit) {
            $rowData = ['nama_penyakit' => $penyakit->nama_penyakit];
            foreach (array_keys($ageGroups) as $key) {
                $rowData[$key] = ['L' => 0, 'P' => 0];
            }
            $rowData['total'] = ['L' => 0, 'P' => 0];
            $reportData[$penyakit->id] = $rowData;
        }

        // 5. Proses setiap record dan masukkan ke kelompok yang tepat
        foreach ($records as $record) {
            $tglLahir = Carbon::parse($record->tanggal_lahir);
            $tglKunjungan = Carbon::parse($record->tanggal_kunjungan);

            // Hitung umur pasien saat kunjungan
            $ageInDays = $tglLahir->diffInDays($tglKunjungan);
            $ageInYears = $tglLahir->diffInYears($tglKunjungan);
            $gender = $record->jenis_kelamin;

            // Tentukan kelompok umur pasien
            foreach ($ageGroups as $key => $group) {
                $age = ($group['unit'] === 'day') ? $ageInDays : $ageInYears;
                if ($age >= $group['start'] && $age <= $group['end']) {
                    if (isset($reportData[$record->penyakit_id][$key][$gender])) {
                        // Tambahkan hitungan
                        $reportData[$record->penyakit_id][$key][$gender]++;
                        $reportData[$record->penyakit_id]['total'][$gender]++;
                    }
                    break; // Keluar dari loop setelah kelompok umur ditemukan
                }
            }
        }

        $namaBulan = Carbon::create()->month($bulan)->translatedFormat('F');
        $namaFile = "Laporan Surveilans Penyakit - {$namaBulan} {$tahun}.xlsx";

        return Excel::download(new LaporanSurveilansExport($reportData, $namaBulan, $tahun), $namaFile);
    }
}
