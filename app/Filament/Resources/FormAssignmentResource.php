<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormAssignmentResource\Pages;
use App\Filament\Resources\FormAssignmentResource\RelationManagers;
use App\Models\FormAssignment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormAssignmentResource extends Resource
{
    protected static ?string $model = FormAssignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'id')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->user ? $record->user->name : 'Unknown')
                    ->required(),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.user.name')->label('Patient'),
                Tables\Columns\TextColumn::make('form.name')->label('Form'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListFormAssignments::route('/'),
            'create' => Pages\CreateFormAssignment::route('/create'),
            'edit' => Pages\EditFormAssignment::route('/{record}/edit'),
        ];
    }
}
