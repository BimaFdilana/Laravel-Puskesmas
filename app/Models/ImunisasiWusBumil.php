<?php
// app/Models/ImunisasiWusBumil.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImunisasiWusBumil extends Model
{
    use HasFactory;

    protected $table = 'imunisasi_wus_bumil';
    protected $guarded = ['id'];
}