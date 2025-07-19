<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LandingPageController extends Controller
{
    public function landingPage()
    {
    $userCount = User::where('role_id', 2)->count();
    return view('pages.apps.dashboard', compact('userCount'));
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
