<?php

namespace App\Filament\Resources\FormAssignmentResource\Pages;

use App\Filament\Resources\FormAssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormAssignment extends EditRecord
{
    protected static string $resource = FormAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
