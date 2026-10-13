<?php

namespace App\Filament\Resources\Participants\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ParticipantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('schema_id')
                    ->required()
                    ->label('Schema Name')
                    ->relationship('schema', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('nisn')
                    ->numeric()
                    ->minLength(10)
                    ->maxLength(10)
                    ->required(),
                TextInput::make('name')
                    ->regex('/^[a-zA-Z\s]+$/')
                    ->validationMessages([
                        'regex' => 'Kolom nama hanya boleh berisi huruf dan spasi.',
                    ])
                    ->required(),
                Select::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female'])
                    ->required(),
                TextInput::make('phone_number')
                    ->tel()
                    ->minLength(12)
                    ->maxLength(12)
                    ->required(),
                Textarea::make('address')
                    ->columnSpanFull(),
            ]);
    }
}
