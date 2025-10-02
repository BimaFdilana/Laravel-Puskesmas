<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posyandu;
use App\Models\ImunisasiBayi;
use App\Models\ImunisasiWusBumil;
use App\Models\JenisImunisasi;
use App\Exports\LaporanImunisasiExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class LaporanImunisasiController extends Controller
{
    public function index()
    {
        // Pastikan path view ini sesuai dengan lokasi file blade Anda
        // Contoh: 'pages.laporan.imunisasi.index' jika filenya di resources/views/pages/laporan/imunisasi/index.blade.php
        return view('pages.apps.pustu.imunisasi.laporan_imunisasi.index');
    }
    public function exportImunisasi(Request $request)
    {
        // Ambil filter bulan dan tahun jika ada, jika tidak gunakan bulan dan tahun saat ini
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        // 1. Ambil semua Posyandu sebagai baris utama
        $allPosyandu = Posyandu::orderBy('nama_posyandu')->get();

        // 2. Ambil semua jenis imunisasi sebagai kolom
        $allJenisImunisasi = JenisImunisasi::pluck('nama_imunisasi')->toArray();

        // 3. Ambil data imunisasi bayi dan WUS/Bumil pada periode yang ditentukan
        $imunisasiBayi = ImunisasiBayi::with(['posyandu', 'jenisImunisasi'])
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        $imunisasiWusBumil = ImunisasiWusBumil::with(['posyandu', 'jenisImunisasi'])
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        // 4. Proses data menjadi struktur yang siap ditampilkan
        $reportData = [];
        foreach ($allPosyandu as $posyandu) {
            $rowData = ['nama_posyandu' => $posyandu->nama_posyandu];

            // Inisialisasi semua kolom dengan nilai 0
            foreach ($allJenisImunisasi as $jenis) {
                // Untuk bayi, ada L dan P
                if (!in_array($jenis, ['TT1', 'TT2', 'TT3', 'TT4', 'TT5'])) {
                    $rowData[$jenis] = ['L' => 0, 'P' => 0];
                } else { // Untuk WUS/BUMIL, hanya ada total
                    $rowData['BUMIL'][$jenis] = 0;
                    $rowData['WUS'][$jenis] = 0;
                }
            }

            // Isi data imunisasi bayi
            foreach ($imunisasiBayi->where('posyandu_id', $posyandu->id) as $data) {
                $jenis = $data->jenisImunisasi->nama_imunisasi;
                $gender = $data->jenis_kelamin; // 'L' atau 'P'
                if (isset($rowData[$jenis][$gender])) {
                    $rowData[$jenis][$gender]++;
                }
            }

            // Isi data imunisasi WUS/Bumil
            foreach ($imunisasiWusBumil->where('posyandu_id', $posyandu->id) as $data) {
                $jenis = $data->jenisImunisasi->nama_imunisasi;
                // Asumsi: Jika hamil_ke > 0 maka BUMIL, selain itu WUS
                if ($data->hamil_ke > 0) {
                    if (isset($rowData['BUMIL'][$jenis])) {
                        $rowData['BUMIL'][$jenis]++;
                    }
                } else {
                    if (isset($rowData['WUS'][$jenis])) {
                        $rowData['WUS'][$jenis]++;
                    }
                }
            }
            $reportData[] = $rowData;
        }

        // 5. Kirim data ke Class Export dan unduh file
        $namaFile = 'Laporan Imunisasi - ' . Carbon::create()->month($bulan)->format('F') . ' ' . $tahun . '.xlsx';

        return Excel::download(new LaporanImunisasiExport($reportData, $bulan, $tahun), $namaFile);
    }
}
