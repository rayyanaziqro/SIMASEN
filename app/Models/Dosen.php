<?php

namespace App\Models;

use Filament\Panel;
use App\Models\Matkul;
use App\Models\Absensi;
use Spatie\MediaLibrary\HasMedia;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\FilamentUser;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable implements HasMedia, FilamentUser, HasName
{
    use HasFactory, InteractsWithMedia;


    protected $fillable = ['nama', 'nidn', 'nip', 'pendidikan', 'pangkat', 'password'];

    protected $cast = ['password' => 'hashed'];


    public function absensiDosen()
    {
        return $this->hasMany(Absensi::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {


        return true;
    }

    public function getFilamentName(): string
    {
        return $this->nama;
    }
}
