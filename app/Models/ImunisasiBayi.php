<?php
// app/Models/ImunisasiBayi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImunisasiBayi extends Model
{
    use HasFactory;

    protected $table = 'imunisasi_bayi';
    protected $guarded = ['id'];
}
