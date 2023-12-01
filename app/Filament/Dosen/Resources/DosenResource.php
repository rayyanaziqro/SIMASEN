<?php

namespace App\Filament\Dosen\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Dosen;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Rawilk\FilamentPasswordInput\Password;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Dosen\Resources\DosenResource\Pages;
use App\Filament\Dosen\Resources\DosenResource\RelationManagers;
use App\Filament\Dosen\Resources\DosenResource\Pages\ProfileDosen;

class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class;

    protected static ?string $navigationGroup = 'Pengaturan Akun';


    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->where('id', auth('dosen')->id());
    // }

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
                TextColumn::make('nama')
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ProfileDosen::route('/'),

        ];
    }
}
