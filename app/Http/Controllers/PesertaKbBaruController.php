<?php

namespace App\Http\Controllers;

use App\Models\PesertaKbBaru;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class PesertaKbBaruController extends Controller
{
    public function index()
    {
        $records = PesertaKbBaru::with('posyandu')->latest()->paginate(10);
        return view('pages.apps.pustu.keluarga_berencana.index', compact('records'));
    }

    public function create()
{
    if (Posyandu::count() === 0) {
        return redirect()->route('peserta-kb.index')
                         ->with('error_posyandu', 'Data Posyandu kosong. Silakan isi terlebih dahulu.');
    }
    $posyanduList = Posyandu::orderBy('nama_posyandu')->get();
    return view('pages.apps.pustu.keluarga_berencana.create', compact('posyanduList'));
}

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,id',
            'nama_pasien' => 'required|string|max:255',
            'tanggal_pelayanan' => 'required|date',
            'jenis_kontrasepsi' => 'required|in:PIL,SUNTIK,KONDOM,IUD,IMPLAN,MOW,MOP',
            'jalur_layanan' => 'required|in:UMUM,BPJS/K,PASCA SALIN',
        ]);

        PesertaKbBaru::create($request->all());

        return redirect()->route('peserta-kb.index')->with('success', 'Data Peserta KB Baru berhasil ditambahkan.');
    }

    public function show(PesertaKbBaru $peserta_kb)
    {
        // Tidak digunakan untuk CRUD dasar, bisa dikosongkan.
    }

    public function edit(PesertaKbBaru $peserta_kb)
    {
        $posyanduList = Posyandu::orderBy('nama_posyandu')->get();
        return view('pages.apps.pustu.keluarga_berencana..edit', compact('peserta_kb', 'posyanduList'));
    }

    public function update(Request $request, PesertaKbBaru $peserta_kb)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandus,id',
            'nama_pasien' => 'required|string|max:255',
            'tanggal_pelayanan' => 'required|date',
            'jenis_kontrasepsi' => 'required|in:PIL,SUNTIK,KONDOM,IUD,IMPLAN,MOW,MOP',
            'jalur_layanan' => 'required|in:UMUM,BPJS/K,PASCA SALIN',
        ]);

        $peserta_kb->update($request->all());

        return redirect()->route('peserta-kb.index')->with('success', 'Data Peserta KB Baru berhasil diperbarui.');
    }

    public function destroy(PesertaKbBaru $peserta_kb)
    {
        $peserta_kb->delete();
        return redirect()->route('peserta-kb.index')->with('success', 'Data Peserta KB Baru berhasil dihapus.');
    }
}