<?php

namespace App\Http\Controllers;

use App\Models\ImunisasiWusBumil;
use App\Models\JenisImunisasi;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use App\Exports\ImunisasiWusBumilExport;
use Maatwebsite\Excel\Facades\Excel;

class ImunisasiWusBumilController extends Controller
{
    public function index()
    {
        $dataImunisasi = ImunisasiWusBumil::latest()->paginate(10);
        return view('pages.apps.pustu.imunisasi.bumil.index', compact('dataImunisasi'));
    }

    public function create()
    {
        $posyanduList = Posyandu::orderBy('nama_posyandu')->get();
        $jenisImunisasiList = JenisImunisasi::orderBy('nama_imunisasi')->get();
        return view('pages.apps.pustu.imunisasi.bumil.create', compact('jenisImunisasiList', 'posyanduList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,id',
            'nama_wus_bumil' => 'required|string|max:255',
            'nama_suami' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'hamil_ke' => 'nullable|integer|min:0',
            'jenis_imunisasi_id' => 'required|exists:jenis_imunisasi,id',
            'alamat_lengkap' => 'required|string',
            'nik' => 'nullable|string|max:255',
        ]);

        ImunisasiWusBumil::create($request->all());

        return redirect()->route('imunisasi-wus-bumil.index')->with('success', 'Data Imunisasi WUS/Bumil berhasil ditambahkan.');
    }

    public function edit(ImunisasiWusBumil $imunisasiWusBumil)
    {
        $posyanduList = Posyandu::orderBy('nama_posyandu')->get();
        $jenisImunisasiList = JenisImunisasi::orderBy('nama_imunisasi')->get();
        return view('pages.apps.pustu.imunisasi.bumil.edit', compact('imunisasiWusBumil', 'jenisImunisasiList', 'posyanduList'));
    }

    public function update(Request $request, ImunisasiWusBumil $imunisasiWusBumil)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,id',
            'nama_wus_bumil' => 'required|string|max:255',
            'nama_suami' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'hamil_ke' => 'nullable|integer|min:0',
            'jenis_imunisasi_id' => 'required|exists:jenis_imunisasi,id',
            'alamat_lengkap' => 'required|string',
            'nik' => 'nullable|string|max:255',
        ]);

        $imunisasiWusBumil->update($request->all());

        return redirect()->route('imunisasi-wus-bumil.index')->with('success', 'Data Imunisasi WUS/Bumil berhasil diperbarui.');
    }

    public function destroy(ImunisasiWusBumil $imunisasiWusBumil)
    {
        $imunisasiWusBumil->delete();

        return redirect()->route('imunisasi-wus-bumil.index')->with('success', 'Data Imunisasi WUS/Bumil berhasil dihapus.');
    }

    public function export()
    {
        $data = ImunisasiWusBumil::with('jenisImunisasi')->get()->groupBy('nama_posyandu');
        return Excel::download(new ImunisasiWusBumilExport($data), 'data_imunisasi_wus_bumil_' . date('Y-m-d') . '.xlsx');
    }
}
