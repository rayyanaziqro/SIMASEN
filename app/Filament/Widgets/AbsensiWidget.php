<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Tables;
use App\Models\Absensi;
use Filament\Tables\Table;
use App\Models\Enums\StatusAbsen;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class AbsensiWidget extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Absensi::query()->whereDate('waktu_absen', '=', Carbon::now()->toDateString())
            )
            ->emptyStateHeading('Tidak ada absen hari ini')
            ->paginated(false)
            ->columns([
                TextColumn::make('dosen.nama')
                    ->label('Dosen')
                    ->searchable(),
                TextColumn::make('kelas.name')
                    ->label('Kelas'),
                TextColumn::make('waktu_absen')
                    ->label('Waktu Absen'),
                TextColumn::make('matakuliah.waktu_mulai')
                    ->label('Kelas Dimulai'),
                TextColumn::make('status_absen')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        StatusAbsen::TEPAT_WAKTU => 'success',
                        StatusAbsen::LEBIH_AWAL => 'primary',
                        StatusAbsen::TELAT => 'danger'
                    })
            ]);
    }
}
