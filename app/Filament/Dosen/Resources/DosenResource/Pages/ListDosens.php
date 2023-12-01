<?php

namespace App\Filament\Dosen\Resources\DosenResource\Pages;

use App\Filament\Dosen\Resources\DosenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDosens extends ListRecords
{
    protected static string $resource = DosenResource::class;

    public function getBreadcrumb(): ?string
    {
        return 'My Account';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
