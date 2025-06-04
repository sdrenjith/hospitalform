<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $view = 'filament.pages.dashboard';
    
    public function getTitle(): string
    {
        return 'TBI Admin Dashboard';
    }
    
    public function getHeading(): string
    {
        return 'Texas Brain Institute';
    }
    
    public function getSubheading(): string
    {
        return 'Advanced Brain Research Portal';
    }
} 