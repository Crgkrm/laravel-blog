<?php

namespace App\Filament\Resources\UserResource\Pages;

use Carbon\Carbon;
use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data):array
    {
        $data['email_verified_at'] = Carbon::now();
        return $data;
    }
    
    protected function handleRecordCreation(array $data): Model
    {
        /** @var \App\Models\User $user */
        $user = parent::handleRecordCreation($data);
        $user->assignRole('admin');
        return $user;
    }


}
