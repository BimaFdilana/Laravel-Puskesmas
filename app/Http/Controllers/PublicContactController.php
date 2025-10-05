<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class PublicContactController extends Controller
{
    /**
     * Menyimpan pesan dari formulir kontak publik.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->route('contact')->with('success', 'Pesan Anda telah berhasil terkirim. Terima kasih!');
    }
}
