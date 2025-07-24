<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    public function index()
    {
        $data = Posyandu::latest()->paginate(10);
        return view('pages.apps.pustu.imunisasi.posyandu.index', compact('data'));
    }

    public function create()
    {
        return view('pages.apps.pustu.imunisasi.posyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_posyandu' => 'required|string|max:255|unique:posyandus,nama_posyandu']);
        Posyandu::create($request->all());
        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu berhasil ditambahkan.');
    }

    public function edit(Posyandu $posyandu)
    {
        return view('pages.apps.pustu.imunisasi.posyandu.edit', compact('posyandu'));
    }

    public function update(Request $request, Posyandu $posyandu)
    {
        $request->validate(['nama_posyandu' => 'required|string|max:255|unique:posyandus,nama_posyandu,' . $posyandu->id]);
        $posyandu->update($request->all());
        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu berhasil diperbarui.');
    }

    public function destroy(Posyandu $posyandu)
    {
        $posyandu->delete();
        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu berhasil dihapus.');
    }
}