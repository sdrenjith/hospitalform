<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormSubmissionResource\Pages;
use App\Filament\Resources\FormSubmissionResource\RelationManagers;
use App\Models\FormSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormSubmissionResource extends Resource
{
    protected static ?string $model = FormSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('form_assignment_id')
                    ->relationship('formAssignment', 'id')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'submitted' => 'Submitted',
                    ])->default('draft')->required(),
                Forms\Components\DateTimePicker::make('submitted_at')->nullable(),
                Forms\Components\Textarea::make('data')->rows(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('assignment.patient.user.name')
                    ->label('Submitted By')
                    ->formatStateUsing(fn($state, $record) => $record->assignment && $record->assignment->patient && $record->assignment->patient->user ? $record->assignment->patient->user->name : '-')
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignment.form.name')->label('Form Name'),
                Tables\Columns\TextColumn::make('status')->label('Status')->badge()->color(fn($record) => $record->status === 'submitted' ? 'success' : 'warning'),
            ])
            ->actions([
                Tables\Actions\Action::make('view_patient_form')
                    ->label('View')
                    ->color('gray')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => url('/admin/submissions/' . $record->id))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn($record) => route('admin.submissions.export', $record->id))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('edit_patient_form')
                    ->label('Edit')
                    ->color('primary')
                    ->icon('heroicon-o-pencil')
                    ->url(fn($record) => url('/admin/submissions/' . $record->id . '/edit')),
                Tables\Actions\DeleteAction::make(),
            ])
            ->striped()
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListFormSubmissions::route('/'),
            'edit' => Pages\EditFormSubmission::route('/{record}/edit'),
        ];
    }
}
