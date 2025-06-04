<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Support\Str;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

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

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'patient',
            'remember_token' => Str::random(10),
        ]);
        $data['user_id'] = $user->id;
        unset($data['name'], $data['email'], $data['password']);
        return static::getModel()::create($data);
    }
}
