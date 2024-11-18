<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Add this import

class Pengumuman extends Model
{
    use HasFactory; // <-- Use the trait

    /**
     * The attributes that are mass assignable.
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
