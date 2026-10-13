<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister; 
use Filament\Schemas\Components\Component;  

class Register extends BaseRegister
{
    protected function getNameFormComponent(): Component
    {
        return parent::getNameFormComponent()
            ->maxLength(50)
            ->regex('/^[a-zA-Z\s]+$/')
            ->validationMessages([
                'regex' => 'Nama hanya boleh berupa huruf dan spasi, tidak boleh ada angka atau karakter khusus!',
            ]);
    }
}