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
                    ->required()
                    ->unique(table: 'participants', column: 'nisn', ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'NISN ini sudah terdaftar oleh Participant lain.',
                    ]),
                Select::make('name')
                    ->label('Name')
                    ->relationship('user', 'name', fn($query) => $query->role('Participant'))
                    ->preload()
                    ->required(),
                Select::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female'])
                    ->required(),
                TextInput::make('phone_number')
                    ->tel()
                    ->minLength(11)
                    ->maxLength(13)
                    ->required(),
                Textarea::make('address')
                    ->columnSpanFull(),
            ]);
    }
}
