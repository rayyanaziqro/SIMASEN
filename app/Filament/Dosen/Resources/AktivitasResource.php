<?php

namespace App\Filament\Dosen\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Aktivitas;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Dosen\Resources\AktivitasResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Dosen\Resources\AktivitasResource\RelationManagers;

class AktivitasResource extends Resource
{
    protected static ?string $model = Aktivitas::class;


    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Menu Umum';

    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->where('dosen_id', auth('dosen')->id());
}



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        TextInput::make('jenis_aktivitas')
                            ->required(),
                        Textarea::make('deskripsi'),
                        SpatieMediaLibraryFileUpload::make('dokumentasi')
                            ->image()
                            ->placeholder('Uploud foto dokumentasi')
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
                IconColumn::make('status_verifikasi')
                    ->boolean(),
                TextColumn::make('waktu')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
