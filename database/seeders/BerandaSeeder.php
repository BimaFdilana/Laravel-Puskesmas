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
            'google_maps_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3396310348953!2d102.0189699756446!3d1.5599581608630708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d3dfb82227d1c7%3A0x95766c85ee259fe2!2sUPT%20PUSKESMAS%20MESKOM%20KEC.%20BENGKALIS%20KAB.%20BENGKALIS!5e0!3m2!1sid!2sid!4v1759383048049!5m2!1sid!2sid',
        ]);
    }
}
