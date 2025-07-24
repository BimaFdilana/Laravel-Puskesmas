<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanRekapImunisasiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Posyandu;

class LaporanRekapController extends Controller
{
    public function index()
    {
        return view('pages.apps.pustu.rekap-laporan.laporan-imunisasi');
    }

    public function export(Request $request)
    {
        $request->validate([
            'desa' => 'required|string',
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $imunisasiBayiFields = ['HBO', 'BCG', 'Polio 1', 'DPTHBHIB 1', 'Polio 2', 'DPTHBHIB 2', 'Polio 3', 'DPTHBHIB 3', 'Polio 4', 'IPV', 'Campak', 'DPTHBHIB Booster', 'Campak Booster'];

        $selectsBayi = [];
        foreach ($imunisasiBayiFields as $field) {
            $dbField = str_replace(' ', '_', strtolower($field));
            $selectsBayi[] = "SUM(CASE WHEN ji.nama_imunisasi = '{$field}' AND ib.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as {$dbField}_l";
            $selectsBayi[] = "SUM(CASE WHEN ji.nama_imunisasi = '{$field}' AND ib.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as {$dbField}_p";
        }

        // PERUBAHAN 1: Query untuk Bayi di-JOIN ke tabel posyandus
        $rekapBayi = DB::table('imunisasi_bayi as ib')
            ->join('jenis_imunisasi as ji', 'ib.jenis_imunisasi_id', '=', 'ji.id')
            ->join('posyandus as p', 'ib.posyandu_id', '=', 'p.id') // Join ke tabel posyandus
            ->selectRaw('p.nama_posyandu, ' . implode(', ', $selectsBayi)) // Ambil nama dari tabel posyandus
            ->whereMonth('ib.created_at', $bulan)
            ->whereYear('ib.created_at', $tahun)
            ->groupBy('p.nama_posyandu') // Group by nama dari tabel posyandus
            ->get()
            ->keyBy('nama_posyandu');

        // PERUBAHAN 2: Query untuk WUS/Bumil di-JOIN ke tabel posyandus
        $rekapWusBumil = DB::table('imunisasi_wus_bumil as iwb')
            ->join('jenis_imunisasi as ji', 'iwb.jenis_imunisasi_id', '=', 'ji.id')
            ->join('posyandus as p', 'iwb.posyandu_id', '=', 'p.id') // Join ke tabel posyandus
            ->selectRaw(
                "p.nama_posyandu,
                SUM(CASE WHEN ji.nama_imunisasi = 'TT3' AND iwb.hamil_ke IS NOT NULL THEN 1 ELSE 0 END) as tt_bumil_tt3,
                SUM(CASE WHEN ji.nama_imunisasi = 'TT4' AND iwb.hamil_ke IS NOT NULL THEN 1 ELSE 0 END) as tt_bumil_tt4,
                SUM(CASE WHEN ji.nama_imunisasi = 'TT5' AND iwb.hamil_ke IS NOT NULL THEN 1 ELSE 0 END) as tt_bumil_tt5,
                SUM(CASE WHEN ji.nama_imunisasi = 'TT3' AND iwb.hamil_ke IS NULL THEN 1 ELSE 0 END) as tt_wus_tt3,
                SUM(CASE WHEN ji.nama_imunisasi = 'TT4' AND iwb.hamil_ke IS NULL THEN 1 ELSE 0 END) as tt_wus_tt4,
                SUM(CASE WHEN ji.nama_imunisasi = 'TT5' AND iwb.hamil_ke IS NULL THEN 1 ELSE 0 END) as tt_wus_tt5",
            )
            ->whereMonth('iwb.created_at', $bulan)
            ->whereYear('iwb.created_at', $tahun)
            ->groupBy('p.nama_posyandu') // Group by nama dari tabel posyandus
            ->get()
            ->keyBy('nama_posyandu');

        // PERUBAHAN 3: Logika penggabungan data yang lebih andal
        $posyanduList = Posyandu::orderBy('nama_posyandu')->get();
        $finalData = collect();

        $dataColumns = ['hbo_l', 'hbo_p', 'bcg_l', 'bcg_p', 'polio1_l', 'polio1_p', 'dpthbhib1_l', 'dpthbhib1_p', 'polio2_l', 'polio2_p', 'dpthbhib2_l', 'dpthbhib2_p', 'polio3_l', 'polio3_p', 'dpthbhib3_l', 'dpthbhib3_p', 'polio4_l', 'polio4_p', 'ipv_l', 'ipv_p', 'campak_l', 'campak_p', 'dpthbhib_booster_l', 'dpthbhib_booster_p', 'campak_booster_l', 'campak_booster_p', 'tt_bumil_tt3', 'tt_bumil_tt4', 'tt_bumil_tt5', 'tt_wus_tt3', 'tt_wus_tt4', 'tt_wus_tt5'];

        foreach ($posyanduList as $posyandu) {
            $rowData = ['nama_posyandu' => $posyandu->nama_posyandu];
            $dataBayi = $rekapBayi->get($posyandu->nama_posyandu);
            $dataWusBumil = $rekapWusBumil->get($posyandu->nama_posyandu);

            foreach ($dataColumns as $column) {
                $rowData[$column] = $dataBayi->{$column} ?? ($dataWusBumil->{$column} ?? 0);
            }

            $finalData->push((object) $rowData);
        }

        $filters = $request->only(['desa', 'bulan', 'tahun']);

        return Excel::download(new LaporanRekapImunisasiExport($finalData, $filters), 'laporan_rekap_imunisasi.xlsx');
    }
}