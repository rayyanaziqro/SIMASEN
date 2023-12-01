<?php

namespace App\Filament\Dosen\Resources\AktivitasResource\Pages;

use App\Filament\Dosen\Resources\AktivitasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAktivitas extends EditRecord
{
    protected static string $resource = AktivitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
