<?php

namespace App\Filament\Resources\FormAssignmentResource\Pages;

use App\Filament\Resources\FormAssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormAssignments extends ListRecords
{
    protected static string $resource = FormAssignmentResource::class;
    protected static string $view = 'filament.resources.form-assignment-resource.pages.list-records';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
