<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Enums\StatusAbsen;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['dosen_id', 'kelas_id', 'matkul_id', 'waktu_absen', 'status_absen'];

    protected $cast =
    [
        'waktu_absen' => 'datetime',
        'status_absen' => StatusAbsen::class,
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matkul::class, 'matkul_id');
    }
}
