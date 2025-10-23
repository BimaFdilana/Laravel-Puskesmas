<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use Illuminate\Http\Request;

class BayiController extends Controller
{
    /**
     * Menampilkan daftar nama bayi.
     */
    public function index()
    {
        $query = Bayi::latest();

        if (auth()->user()->role_id == 2) {
            $query->where('user_id', auth()->id());
        }

        $data = $query->paginate(10);
        return view('pages.apps.pustu.imunisasi.bayi.nama_bayi.index', compact('data'));
    }

    /**
     * Menampilkan form untuk membuat nama bayi baru.
     */
    public function create()
    {
        return view('pages.apps.pustu.imunisasi.bayi.nama_bayi.create');
    }

    /**
     * Menyimpan nama bayi baru ke database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_bayi' => 'required|string|max:255|unique:bayis,nama_bayi,NULL,id,user_id,' . auth()->id(),
            'nama_orang_tua' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'nik_orang_tua' => 'nullable|string|max:255',
            'nik_bayi' => 'nullable|string|max:255',
        ]);

        $data['user_id'] = auth()->id();

        Bayi::create($data);

        return redirect()->route('bayi.index')->with('success', 'Data Bayi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit nama bayi.
     */
    public function edit(Bayi $bayi)
    {
        if (auth()->user()->role_id == 2 && $bayi->user_id !== auth()->id()) {
            abort(403, 'AKSI TIDAK DIIZINKAN');
        }
        return view('pages.apps.pustu.imunisasi.bayi.nama_bayi.edit', compact('bayi'));
    }

    /**
     * Memperbarui data nama bayi di database.
     */
    public function update(Request $request, Bayi $bayi)
    {
        if (auth()->user()->role_id == 2 && $bayi->user_id !== auth()->id()) {
            abort(403, 'AKSI TIDAK DIIZINKAN');
        }

        $data = $request->validate([
            'nama_bayi' => 'required|string|max:255|unique:bayis,nama_bayi,' . $bayi->id . ',id,user_id,' . auth()->id(),
            'nama_orang_tua' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'nik_orang_tua' => 'nullable|string|max:255',
            'nik_bayi' => 'nullable|string|max:255',
        ]);

        $bayi->update($data);

        return redirect()->route('bayi.index')->with('success', 'Data Bayi berhasil diperbarui.');
    }

    /**
     * Menghapus data nama bayi dari database.
     */
    public function destroy(Bayi $bayi)
    {
        if (auth()->user()->role_id == 2 && $bayi->user_id !== auth()->id()) {
            abort(403, 'AKSI TIDAK DIIZINKAN');
        }
        $bayi->delete();
        return redirect()->route('bayi.index')->with('success', 'Data Bayi berhasil dihapus.');
    }
}
