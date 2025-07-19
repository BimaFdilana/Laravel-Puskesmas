<?php

namespace Database\Seeders;

use App\Models\Beranda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BerandaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Beranda::create([
            'hero_title' => 'Web Puskesmas Meskom',
            'hero_subtitle' => 'Sistem ini mendukung pelayanan kesehatan yang optimal untuk seluruh pustu di bawah naungan Puskesmas Meskom.',
            'about_title' => 'Why You Should Trust Us? Get Know About Us!',
            'about_description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet. Stet no et lorem dolor et diam, amet duo ut dolore vero eos. No stet est diam rebum amet diam ipsum. Clita clita labore, dolor duo nonumy clita sit at, sed sit sanctus dolor eos.',
            'about_points' => "Quality health care\nOnly Qualified Doctors\nMedical Research Professionals",
            'about_image_1' => 'landing/img/about-1.jpg',
            'about_image_2' => 'landing/img/about-2.jpg',
            'feature_title' => 'Why Choose Us',
            'feature_description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo erat amet.',
            'feature_image' => 'landing/img/feature.jpg',
            'appointment_title' => 'Make An Appointment To Visit Our Doctor',
            'appointment_description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet.',
            'contact_phone' => '+012 345 6789',
            'contact_email' => 'info@example.com',
        ]);
    }
}