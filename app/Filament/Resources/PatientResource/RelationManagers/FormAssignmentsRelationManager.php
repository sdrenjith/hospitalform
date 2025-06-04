<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FormAssignmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignments';
    protected static ?string $title = 'Assigned Forms';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('form_id')
                ->relationship('form', 'name')
                ->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'assigned' => 'Assigned',
                    'draft' => 'Draft',
                    'completed' => 'Completed',
                ])->default('assigned')->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('form.name')->label('Form'),
            Tables\Columns\TextColumn::make('status'),
        ]);
    }
} 