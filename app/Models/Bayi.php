<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bayi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bayi',
        'user_id',
        'nama_orang_tua',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat_lengkap',
        'nik_orang_tua',
        'nik_bayi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}