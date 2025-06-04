<?php

namespace App\Filament\Resources\FormResource\Pages;

use App\Filament\Resources\FormResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateForm extends CreateRecord
{
    protected static string $resource = FormResource::class;

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
