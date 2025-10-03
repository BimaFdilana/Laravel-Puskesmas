<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveilansPenyakit extends Model
{
    use HasFactory;
    protected $table = 'surveilans_penyakit';
    protected $fillable = [
        'penyakit_id',
        'nama_pasien',
        'tanggal_lahir',
        'jenis_kelamin',
        'tanggal_kunjungan',
    ];

    // Relasi ke model Penyakit
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
