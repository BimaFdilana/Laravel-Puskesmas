<?php

namespace App\Http\Controllers;

use App\Models\ImunisasiBayi;
use Illuminate\Http\Request;
use App\Exports\ImunisasiBayiExport;
use Maatwebsite\Excel\Facades\Excel;

class ImunisasiBayiController extends Controller
{
    public function index()
    {
        $dataImunisasi = ImunisasiBayi::latest()->paginate(10);
        return view('pages.apps.pustu.imunisasi.bayi.index', compact('dataImunisasi'));
    }

    public function create()
    {
        return view('pages.apps.pustu.imunisasi.bayi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bayi' => 'required|string|max:255',
            'nama_posyandu' => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'nik_orang_tua' => 'nullable|string|max:255',
            'nik_bayi' => 'nullable|string|max:255',
            'jenis_imunisasi' => 'nullable|string|max:255',
        ]);

        ImunisasiBayi::create($request->all());

        return redirect()->route('imunisasi-bayi.index')->with('success', 'Data Imunisasi Bayi berhasil ditambahkan.');
    }

    public function edit(ImunisasiBayi $imunisasiBayi)
    {
        return view('pages.apps.pustu.imunisasi.bayi.edit', compact('imunisasiBayi'));
    }

    public function update(Request $request, ImunisasiBayi $imunisasiBayi)
    {
        $request->validate([
            'nama_bayi' => 'required|string|max:255',
            'nama_posyandu' => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'nik_orang_tua' => 'nullable|string|max:255',
            'nik_bayi' => 'nullable|string|max:255',
            'jenis_imunisasi' => 'nullable|string|max:255',
        ]);

        $imunisasiBayi->update($request->all());

        return redirect()->route('imunisasi-bayi.index')->with('success', 'Data Imunisasi Bayi berhasil diperbarui.');
    }

    public function destroy(ImunisasiBayi $imunisasiBayi)
    {
        $imunisasiBayi->delete();

        return redirect()->route('imunisasi-bayi.index')->with('success', 'Data Imunisasi Bayi berhasil dihapus.');
    }

    public function export()
    {
        $data = ImunisasiBayi::all()->groupBy('nama_posyandu');

        return Excel::download(new ImunisasiBayiExport($data), 'data_imunisasi_bayi_' . date('Y-m-d') . '.xlsx');
    }
}
