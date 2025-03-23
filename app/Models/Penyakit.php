<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakit';

    protected $fillable = [
        'id',
        'nama',
        'umur',
        'jenis_kelamin',
        'penyakit',
        'gejala',
        'created_at',
        'updated_at',
    ];
}