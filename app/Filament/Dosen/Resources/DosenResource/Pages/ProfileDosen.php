<?php

namespace App\Filament\Dosen\Resources\DosenResource\Pages;

use App\Models\Dosen;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Rawilk\FilamentPasswordInput\Password;
use App\Filament\Dosen\Resources\DosenResource;

class ProfileDosen extends Page implements HasForms
{
    protected static string $resource = DosenResource::class;

    protected static string $view = 'filament.dosen.resources.dosen-resource.pages.profile-dosen';

    public ?array $data = [];

    protected static ?string $title = '';

    public function mount(): void
    {
        $this->form->fill(auth('dosen')->user()->attributesToArray());
    }

    public function getBreadcrumbs(): array
    {


        return [

        ];
    }



    public function form(Form $form): Form
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

                    ])
                    ->columns(2)


            ])
            ->statePath('data');
    }

    public function create(): void
    {
        Dosen::where('id', auth('dosen')->id())->update($this->form->getState());

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
