<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends \Filament\Pages\Dashboard
{

    public static function getNavigationLabel(): string
    {
        return 'Dashboard';
    }

    public function getTitle(): string | Htmlable
    {
        return 'Dashboard';
    }

}
