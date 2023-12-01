<?php

namespace App\Models;

use App\Models\Matkul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function mataKuliah()
    {
        return $this->belongsToMany(Matkul::class, 'kelas_mata_kuliah', 'matkul_id', 'kelas_id');
    }

    public function absensiDosen()
    {
        return $this->hasMany(Absensi::class);
    }



}
