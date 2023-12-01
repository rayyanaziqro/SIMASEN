<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matkul extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode_matkul', 'waktu_mulai', 'dosen_id'];

    protected $cast = ['waktu_mulai' => 'datetime'];


    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mata_kuliah', 'matkul_id', 'kelas_id');
    }
}
