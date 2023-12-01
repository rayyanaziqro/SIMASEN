<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Matkul;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\MatkulResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MatkulResource\RelationManagers;

class MatkulResource extends Resource
{
    protected static ?string $model = Matkul::class;

    protected static ?string $navigationGroup = 'MENU UTAMA';

    protected static ?string $pluralModelLabel = 'Mata Kuliah';




    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }



    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('nama'),
                        TextInput::make('kode_matkul')
                            ->label('Kode'),
                        DateTimePicker::make('waktu_mulai')
                    ])
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('kode_matkul')
                    ->label('Kode')
                    ->searchable(),
                TextColumn::make('waktu_mulai')


            ])
            ->filters([
                //
            ])
            ->emptyStateHeading('Tidak ada mata kuliah')
            ->paginated(true)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalSubmitActionLabel('Simpan perubahan')
                    ->modalCancelActionLabel('Kembali'),
                Tables\Actions\DeleteAction::make()
                    ->using(function ($record) {
                        $record->kelas()->detach();
                        $record->delete();
                    }),
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
            'index' => Pages\ListMatkuls::route('/'),
        ];
    }
}
