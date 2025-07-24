<?php

namespace App\Http\Controllers;

use App\Models\ImunisasiBayi;
use App\Models\JenisImunisasi;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use App\Exports\ImunisasiBayiExport;
use Maatwebsite\Excel\Facades\Excel;

class ImunisasiBayiController extends Controller
{
    public function index()
    {
        // Memuat relasi untuk ditampilkan di tabel index
        $dataImunisasi = ImunisasiBayi::with('jenisImunisasi')->latest()->paginate(10);
        return view('pages.apps.pustu.imunisasi.bayi.index', compact('dataImunisasi'));
    }

    public function create()
    {
        $posyanduList = Posyandu::orderBy('nama_posyandu')->get();
        $jenisImunisasiList = JenisImunisasi::orderBy('nama_imunisasi')->get();
        return view('pages.apps.pustu.imunisasi.bayi.create', compact('jenisImunisasiList', 'posyanduList'));
    }

    public function store(Request $request)
    {
        // PERBAIKAN: Validasi diubah ke jenis_imunisasi_id
        $request->validate([
            'nama_bayi' => 'required|string|max:255',
            'posyandu_id' => 'required|exists:posyandus,id',
            'nama_orang_tua' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'nik_orang_tua' => 'nullable|string|max:255',
            'nik_bayi' => 'nullable|string|max:255',
            'jenis_imunisasi_id' => 'nullable|exists:jenis_imunisasi,id',
        ]);

        ImunisasiBayi::create($request->all());

        return redirect()->route('imunisasi-bayi.index')->with('success', 'Data Imunisasi Bayi berhasil ditambahkan.');
    }

    public function edit(ImunisasiBayi $imunisasiBayi)
    {
        $posyanduList = Posyandu::orderBy('nama_posyandu')->get();
        $jenisImunisasiList = JenisImunisasi::orderBy('nama_imunisasi')->get();
        return view('pages.apps.pustu.imunisasi.bayi.edit', compact('imunisasiBayi', 'jenisImunisasiList', 'posyanduList'));
    }

    public function update(Request $request, ImunisasiBayi $imunisasiBayi)
    {
        // PERBAIKAN: Validasi diubah ke jenis_imunisasi_id
        $request->validate([
            'nama_bayi' => 'required|string|max:255',
            'posyandu_id' => 'required|exists:posyandus,id',
            'nama_orang_tua' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'nik_orang_tua' => 'nullable|string|max:255',
            'nik_bayi' => 'nullable|string|max:255',
            'jenis_imunisasi_id' => 'nullable|exists:jenis_imunisasi,id',
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
        // PERBAIKAN: Memuat relasi sebelum diekspor
        $data = ImunisasiBayi::with('jenisImunisasi')->get()->groupBy('nama_posyandu');
        return Excel::download(new ImunisasiBayiExport($data), 'data_imunisasi_bayi_' . date('Y-m-d') . '.xlsx');
    }
}
