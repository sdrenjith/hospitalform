<?php

namespace App\Filament\Resources\FormAssignmentResource\Pages;

use App\Filament\Resources\FormAssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFormAssignment extends CreateRecord
{
    protected static string $resource = FormAssignmentResource::class;

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
