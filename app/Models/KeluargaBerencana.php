<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaBerencana extends Model
{
    use HasFactory;

    protected $table = 'keluarga_berencana';

    protected $fillable = [
        'id',
        'nama',
        'umur',
        'type',
        'created_at',
        'updated_at',
    ];
}