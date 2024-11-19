<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seleksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftar_id', // Relasi ke Pendaftar
        'status',       // Status seleksi (diterima, tidak diterima, lihat)
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
