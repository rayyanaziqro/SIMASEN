<?php

namespace App\Models;

use App\Models\Dosen;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aktivitas extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['dosen_id', 'waktu', 'jenis_aktivitas', 'deskripsi', 'status_verifikasi'];

    public function dosen ()
    {
        return $this->belongsTo(Dosen::class);
    }

}
