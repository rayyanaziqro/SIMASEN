<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Matkul;
use App\Models\Absensi;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Enums\StatusAbsen;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AbsensiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AbsensiResource\RelationManagers;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-m-pencil-square';

    protected static ?string $navigationGroup = 'MENU UTAMA';


    protected static ?string $pluralModelLabel = 'Absensi';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        Select::make('dosen_id')
                            ->relationship('dosen', 'nama')
                            ->label('Dosen')
                            ->native(false)
                            ->required()
                            ->placeholder('Pilih nama dosen'),
                        Select::make('kelas_id')
                            ->placeholder('Pilih nama kelas')
                            ->relationship('kelas', 'name')
                            ->label('Kelas')
                            ->native(false)
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                            ]),
                        Select::make('matkul_id')
                            ->placeholder('Pilih Mata Kuliah')
                            ->relationship('matakuliah', 'nama')
                            ->label('Mata Kuliah')
                            ->native(false)
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                            ])

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
            ->emptyStateHeading('Tidak ada absen saat ini')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
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
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}
