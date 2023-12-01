<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Dosen;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Rawilk\FilamentPasswordInput\Password;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\DosenResource\Pages;
use App\Filament\Resources\DosenResource\RelationManagers;
use App\Filament\Resources\MatkulResource\RelationManagers\MataKuliahRelationManager;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    protected static ?string $pluralModelLabel = 'Dosen';

    protected static ?string $navigationGroup = 'MENU UTAMA';


    protected static ?string $navigationIcon = 'iconsax-bol-teacher';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('nama')
                            ->required(),
                        TextInput::make('nidn')
                            ->required()
                            ->label('NIDN')
                            ->numeric()
                            ->length(10),
                        TextInput::make('nip')
                            ->label('NIP')
                            ->numeric()
                            ->length(18)
                            ->required(),
                        TextInput::make('pendidikan')
                            ->required(),
                        TextInput::make('pangkat')
                            ->required(),
                        Password::make('password')
                            ->label('Password'),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('nama')
                            ->searchable()
                            ->sortable()
                            ->weight('medium')
                            ->alignLeft(),


                        Tables\Columns\TextColumn::make('nip')
                            ->label('NIP')
                            ->searchable()
                            ->sortable()
                            ->color('gray')
                            ->alignLeft(),
                    ])->space(),

                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('pendidikan')
                            ->icon('zondicon-education')
                            ->label('Pendidikan')
                            ->alignLeft(),

                        Tables\Columns\TextColumn::make('pangkat')
                            ->icon('zondicon-trophy')
                            ->label('Pangkat')
                            ->alignLeft(),
                    ])->space(2)
                ])
            ])
            ->emptyStateHeading('Tida ada data dosen')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDosens::route('/'),
            'create' => Pages\CreateDosen::route('/buat'),
            'edit' => Pages\EditDosen::route('/{record}/edit'),
        ];
    }
}