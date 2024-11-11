<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  // Pastikan trait ini diimpor

class Pengumuman extends Model
{
    use HasFactory; // Gunakan trait HasFactory di sini
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'foto',
        'judul',
        'isi',
        'tanggal',
    ];
}
