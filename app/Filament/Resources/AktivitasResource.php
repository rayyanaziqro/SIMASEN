<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Aktivitas;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AktivitasResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\AktivitasResource\RelationManagers;

class AktivitasResource extends Resource
{
    protected static ?string $model = Aktivitas::class;

    protected static ?string $navigationGroup = "MENU UTAMA";


    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        Select::make('dosen_id')
                            ->relationship('dosen', 'nama')
                            ->required()
                            ->native(false),
                        TextInput::make('jenis_aktivitas')
                            ->required(),
                        Textarea::make('deskripsi'),
                        SpatieMediaLibraryFileUpload::make('dokumentasi')
                            ->image()
                            ->placeholder('Uploud foto dokumentasi'),

                    ])
                    ->columns(1)


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('dosen.nama'),
                TextColumn::make('jenis_aktivitas'),
                SpatieMediaLibraryImageColumn::make('dokumentasi')
                    ->circular(),
                ToggleColumn::make('status_verifikasi')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalWidth('xl'),
                ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),

                    Tables\Actions\EditAction::make(),

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
            'index' => Pages\ListAktivitas::route('/'),
            'create' => Pages\CreateAktivitas::route('/create'),
            'edit' => Pages\EditAktivitas::route('/{record}/edit'),
        ];
    }
}
