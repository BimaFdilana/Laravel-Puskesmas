<?php

namespace App\Http\Controllers;

use App\Models\KeluargaBerencana;
use Illuminate\Http\Request;

class KeluargaBerencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kb = KeluargaBerencana::all();
        return view('pages.apps.pustu.keluarga_berencana.keluarga_berencana_page', compact('kb'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.apps.pustu.keluarga_berencana.keluarga_berencana_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kb = [
            'nama' => 'required|string',
            'umur' => 'required|integer',
            'type' => 'required|string',
        ];

        $validatedData = $request->validate($kb);

        try {
            KeluargaBerencana::create([
                'nama' => $validatedData['nama'],
                'umur' => $validatedData['umur'],
                'type' => $validatedData['type'],
            ]);
            return redirect()->route('keluarga-berencana.index');
        } catch (\Exception $e) {
            return redirect()->route('keluarga-berencana.create')->with('error', $e->getMessage());
        }
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
        $kbDeleted = KeluargaBerencana::find($id);
        $kbDeleted->delete();
        return redirect()->back()->with('success', 'Keluarga Berencana deleted successfully');
    }
}