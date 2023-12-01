<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use Filament\Actions;
use App\Models\Enums\StatusAbsen;


use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AbsensiResource;
use App\Models\Absensi;

class ListAbsensis extends ListRecords
{
    protected static string $resource = AbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Absen'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Lebih Awal' => Tab::make()
                ->badge(Absensi::query()->where('status_absen', StatusAbsen::LEBIH_AWAL)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_absen', StatusAbsen::LEBIH_AWAL)),

            'Tepat Waktu' => Tab::make()
                ->badge(Absensi::query()->where('status_absen', StatusAbsen::TEPAT_WAKTU)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_absen', StatusAbsen::TEPAT_WAKTU)),
            'Telat' => Tab::make()
                ->badge(Absensi::query()->where('status_absen', StatusAbsen::TELAT)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status_absen', StatusAbsen::TELAT)),
        ];
    }
}
