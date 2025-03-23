<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imunisasi;

class ImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imun = Imunisasi::all();
        return view('pages.apps.pustu.imunisasi.imunisasi_page', compact('imun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imun = Imunisasi::find($id);
        $imun->delete();
        return redirect()->back()->with('success', 'Imunisasi deleted successfully');
    }
}