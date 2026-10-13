<?php

namespace App\Filament\Resources\Schemas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SchemaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->maxLength(15)
                    ->required(),
                TextInput::make('name')
                    ->maxLength(55)
                    ->required(),
                TextInput::make('type')
                    ->maxLength(10)
                    ->required(),
            ]);
    }
}
