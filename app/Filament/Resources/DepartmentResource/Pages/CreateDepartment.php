<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Resources\DepartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDepartment extends CreateRecord
{
    protected static string $resource = DepartmentResource::class;

    public static function booted(): void
    {
        static::disableCreateAnother();
    }

    protected function getCreateFormActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\CancelAction::make(),
        ];
    }
}
