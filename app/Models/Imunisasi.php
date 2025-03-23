<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;

    protected $table = 'imunisasi';

    protected $fillable = [
        'id',
        'nama',
        'umur',
        'jenis_kelamin',
        'nama_ayah',
        'nama_ibu',
    ];
}