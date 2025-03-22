<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingPage ()
    {
        return view('pages.apps.petugas.dashboard');
    }

    public function tentangKami ()
    {
        return view('pages.web.about');
    }

    public function kontak()
    {
        return view('pages.web.contact');
    }
}