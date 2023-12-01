<?php

namespace App\Filament\Dosen\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Absensi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Enums\StatusAbsen;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Dosen\Resources\AbsensiResource\Pages;
use App\Filament\Dosen\Resources\AbsensiResource\RelationManagers;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationGroup = 'Menu Umum';




    protected static ?string $navigationIcon = 'heroicon-m-pencil-square';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        Select::make('kelas_id')
                            ->placeholder('Pilih nama kelas')
                            ->relationship('kelas', 'name')
                            ->label('Kelas')
                            ->native(false)
                            ->required(),
                        Select::make('matkul_id')
                            ->placeholder('Pilih Mata Kuliah')
                            ->relationship('matakuliah', 'nama')
                            ->label('Mata Kuliah')
                            ->native(false)
                            ->required()
                    ])
                    ->columnSpan(1 / 2)
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(static::getModel()::query()->whereDate('waktu_absen', '=', Carbon::now()->toDateString()))
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
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->emptyStateHeading('Anda belum absen hari ini')
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
        ];
    }
}
