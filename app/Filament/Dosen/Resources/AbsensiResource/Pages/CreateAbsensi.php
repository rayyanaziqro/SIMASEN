<?php

namespace App\Filament\Dosen\Resources\AbsensiResource\Pages;

use App\Models\Matkul;
use Filament\Actions\Action;
use App\Models\Enums\StatusAbsen;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Dosen\Resources\AbsensiResource;

class CreateAbsensi extends CreateRecord
{
    protected static string $resource = AbsensiResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

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
                'dosen_id' => auth('dosen')->id(),
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
