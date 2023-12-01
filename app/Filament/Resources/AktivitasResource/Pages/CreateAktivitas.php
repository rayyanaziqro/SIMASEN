<?php

namespace App\Filament\Resources\AktivitasResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AktivitasResource;

class CreateAktivitas extends CreateRecord
{
    protected static string $resource = AktivitasResource::class;

    protected function handleRecordCreation(array $data): Model
{

    $data = array_merge($data, ['waktu' => now()]);

    return static::getModel()::create($data);
}
}
