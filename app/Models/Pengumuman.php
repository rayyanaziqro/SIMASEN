<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'konten', 'dosen_id', 'is_all_dosen'];


    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
