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
            'about_title' => 'Mengapa Harus Mempercayai Kami? Kenali Lebih Dekat Puskesmas Meskom!',
            'about_description' => 'Puskesmas Meskom merupakan pusat pelayanan kesehatan tingkat pertama yang berkomitmen memberikan layanan kesehatan yang profesional, amanah, dan berkualitas bagi seluruh lapisan masyarakat di wilayah Meskom dan sekitarnya.',
            'about_points' => "Pelayanan kesehatan berkualitas\nDokter dan tenaga medis yang profesional dan bersertifikat\nDidukung oleh tenaga ahli dan profesional di bidang penelitian medis",
            'about_image_1' => 'landing/img/about-1.jpg',
            'about_image_2' => 'landing/img/about-2.jpg',
            'feature_title' => 'Kenapa Memilih Kami',
            'feature_description' => 'Kami hadir bukan hanya untuk memberikan pelayanan pengobatan, tetapi juga aktif dalam kegiatan promotif dan preventif guna meningkatkan kesadaran masyarakat akan pentingnya hidup sehat. Dengan tenaga medis yang kompeten, fasilitas memadai, serta semangat pelayanan yang tinggi, kami terus berupaya memberikan yang terbaik demi tercapainya masyarakat yang sehat, mandiri, dan sejahtera.',
            'feature_image' => 'landing/img/feature.jpg',
            'appointment_title' => 'Buat Janji Temu untuk Berkonsultasi dengan Dokter Kami',
            'appointment_description' => 'Kami siap membantu Anda mendapatkan pelayanan kesehatan yang cepat dan tepat. Dengan sistem janji temu yang mudah, Anda dapat memilih waktu kunjungan sesuai kebutuhan tanpa harus menunggu lama di antrean. Tim dokter kami yang berpengalaman akan memberikan perhatian dan penanganan terbaik sesuai keluhan Anda. Segera jadwalkan kunjungan Anda dan rasakan pelayanan yang nyaman dan profesional di Puskesmas Meskom.',
            'contact_phone' => '+012 345 6789',
            'contact_email' => 'Uptpuskesmasmeskom@gmail.com',
            'contact_address' => 'Jl. Jenderal Sudirman No. 123, Meskom, Bengkalis, Riau',
            'google_maps_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127548.2994936015!2d101.38331584335937!3d0.510440399999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e7bcfb5635c9%3A0x1f7483a9a741e4d!2sPekanbaru%2C%20Pekanbaru%20City%2C%20Riau!5e0!3m2!1sen!2sid!4v1721505634069!5m2!1sen!2sid',
        ]);
    }
}