<?php

namespace App\Filament\Dosen\Resources\AktivitasResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Dosen\Resources\AktivitasResource;

class CreateAktivitas extends CreateRecord
{
    protected static string $resource = AktivitasResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $data = array_merge($data, [
            'waktu' => now(),
            'dosen_id' => auth('dosen')->id()
        ]);

        return static::getModel()::create($data);
    }
}
