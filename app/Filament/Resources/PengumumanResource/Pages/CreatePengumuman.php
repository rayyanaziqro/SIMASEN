<?php

namespace App\Filament\Resources\PengumumanResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PengumumanResource;

class CreatePengumuman extends CreateRecord
{
    protected static string $resource = PengumumanResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $dosen_id = null;

        if (isset($data['dosen_id'])) {
            $dosen_id = $data['dosen_id'];
        }

        return static::getModel()::create([
            'is_all_dosen' => $data['is_all_dosen'],
            'judul' => $data['judul'],
            'konten' => $data['konten'],
            'dosen_id' => $dosen_id
        ]);
    }
}
