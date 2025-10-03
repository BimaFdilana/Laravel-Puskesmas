<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Beranda;
use App\Models\Contact;
use App\Models\ImunisasiBayi;
use App\Models\PesertaKbBaru;
use App\Models\SurveilansPenyakit;
use App\Models\AncRecord;          // <-- Tambahkan ini
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function landingPage()
    {
        // Variabel untuk Admin (role_id == 1)
        $userCount = 0;
        $messageCount = 0;

        if (auth()->user()->role_id == 1) {
            $userCount = User::where('role_id', 2)->count();
            $messageCount = Contact::count(); // Menggunakan model Contact Anda
        }

        // --- LOGIKA BARU UNTUK KARTU STATISTIK ---
        $imunisasiCount = ImunisasiBayi::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $kbCount = PesertaKbBaru::whereMonth('tanggal_pelayanan', now()->month)->whereYear('tanggal_pelayanan', now()->year)->count();
        $surveilansCount = SurveilansPenyakit::whereMonth('tanggal_kunjungan', now()->month)->whereYear('tanggal_kunjungan', now()->year)->count();
        $ancCount = AncRecord::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        // --- LOGIKA BARU UNTUK GRAFIK PENYAKIT TERATAS (BAR CHART) ---
        $topPenyakit = SurveilansPenyakit::with('penyakit')
            ->select('penyakit_id', DB::raw('count(*) as total'))
            ->whereMonth('tanggal_kunjungan', now()->month)
            ->whereYear('tanggal_kunjungan', now()->year)
            ->groupBy('penyakit_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        $penyakitLabels = $topPenyakit->map(function ($item) {
            // Pastikan relasi 'penyakit' ada untuk menghindari error
            return $item->penyakit ? $item->penyakit->nama_penyakit : 'Lainnya';
        });
        $penyakitData = $topPenyakit->pluck('total');

        // --- LOGIKA BARU UNTUK TABEL AKTIVITAS TERBARU ---
        $recentActivities = SurveilansPenyakit::with('penyakit')->latest()->limit(5)->get();

        $totalAnc = AncRecord::count();
        $totalImunisasi = ImunisasiBayi::count();
        $totalKb = PesertaKbBaru::count();
        $totalSurveilans = SurveilansPenyakit::count();

        $aktivitasLabels = ['Ibu Hamil (ANC)', 'Imunisasi Bayi', 'Peserta KB Baru', 'Surveilans'];
        $aktivitasData = [$totalAnc, $totalImunisasi, $totalKb, $totalSurveilans];

        // Mengirim semua variabel ke view
        return view('pages.apps.dashboard', compact(
            'userCount',
            'messageCount',
            'imunisasiCount',
            'kbCount',
            'surveilansCount',
            'ancCount',
            'penyakitLabels',
            'penyakitData',
            'recentActivities',
            'aktivitasLabels',
            'aktivitasData',
        ));
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