<?php

namespace App\Filament\Resources\DosenResource\Pages;

use App\Filament\Resources\DosenResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateDosen extends CreateRecord
{
    protected static string $resource = DosenResource::class;

    protected static bool $canCreateAnother = false;

    protected static ?string $title = 'Buat Data';


    public function getBreadcrumb(): string
    {
        return 'Data dosen';
    }

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Tambah data')
            ->submit('create')
            ->keyBindings(['mod+s']);
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label(__('Kembali'))
            ->url($this->previousUrl ?? static::getResource()::getUrl())
            ->color('gray');
    }
}
