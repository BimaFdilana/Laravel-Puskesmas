<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IbuHamil;

class IbuHamilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ibuHamil = IbuHamil::all();
        return view('pages.apps.pustu.ibu_hamil.ibu_hamil_page', compact('ibuHamil'));
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
        $ibuHamil = IbuHamil::find($id);
        $ibuHamil->delete();
        return redirect()->back()->with('success', 'Ibu Hamil deleted successfully');
    }
}