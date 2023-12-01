<?php

namespace App\Filament\Widgets;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Matkul;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Dosen', Dosen::count()),
            Stat::make('Mata Kuliah', Matkul::count()),
            Stat::make('Kelas', Kelas::count()),
        ];
    }
}
