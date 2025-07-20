<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Beranda;
use App\Models\Contact;

class LandingPageController extends Controller
{
    public function landingPage()
    {
        $userCount = User::where('role_id', 2)->count();
        $messageCount = Contact::count();

        return view('pages.apps.dashboard', compact('userCount', 'messageCount'));
    }

    public function tentangKami()
    {
        $beranda = Beranda::first();
        return view('pages.web.about', compact('beranda'));
    }

    public function kontak()
    {
        $beranda = Beranda::first();
        return view('pages.web.contact', compact('beranda'));
    }
}
