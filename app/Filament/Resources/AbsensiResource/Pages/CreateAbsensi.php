<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use Filament\Actions;
use App\Models\Matkul;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AbsensiResource;
use App\Models\Enums\StatusAbsen;

class CreateAbsensi extends CreateRecord
{
    protected static string $resource = AbsensiResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected static bool $canCreateAnother = false;

    protected static ?string $title = 'Absen';

    protected function handleRecordCreation(array $data): Model
    {
        $getMatkulData = Matkul::find($data['matkul_id']);

        if ($getMatkulData) {
            $getMatkulDataWaktuMulai = $getMatkulData->waktu_mulai;
            $waktuAbsen = now();

            $toleranceMinutes = 1;

            if ($waktuAbsen->equalTo($getMatkulDataWaktuMulai) || $waktuAbsen->diffInMinutes($getMatkulDataWaktuMulai) <= $toleranceMinutes) {
                $statusAbsen = StatusAbsen::TEPAT_WAKTU;
            } elseif ($waktuAbsen->lessThan($getMatkulDataWaktuMulai)) {
                $statusAbsen = StatusAbsen::LEBIH_AWAL;
            } else {
                $statusAbsen = StatusAbsen::TELAT;
            }

            $data = array_merge($data, [
                'status_absen' => $statusAbsen,
                'waktu_absen' => $waktuAbsen,
            ]);

            return static::getModel()::create($data);
        }
    }


    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Absen')
            ->submit('create')
            ->keyBindings(['mod+s']);
    }
}
