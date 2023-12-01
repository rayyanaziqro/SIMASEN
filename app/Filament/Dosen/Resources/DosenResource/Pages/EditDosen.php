<?php

namespace App\Filament\Dosen\Resources\DosenResource\Pages;

use App\Filament\Dosen\Resources\DosenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDosen extends EditRecord
{
    protected static string $resource = DosenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
