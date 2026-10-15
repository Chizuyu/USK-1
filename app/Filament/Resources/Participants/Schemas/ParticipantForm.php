<?php

namespace App\Filament\Resources\Participants\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                FileUpload::make('ktp')
                    ->label('KTP')
                    ->image()
                    ->directory('participants/ktp')
                    ->disk('public')
                    ->nullable(),

                FileUpload::make('ijazah')
                    ->label('Ijazah')
                    ->image()
                    ->directory('participants/ijazah')
                    ->disk('public')
                    ->nullable(),
                FileUpload::make('sertifikat')
                    ->label('Sertifikat')
                    ->image()
                    ->directory('participants/sertifikat')
                    ->disk('public')
                    ->nullable(),
                Select::make('status')
                    ->options([
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Terverifikasi',
                    ])
                    ->default('pending')
                    ->required()
                    ->disabled(! auth()->user()?->hasRole('super_admin')),
                Textarea::make('address')
                    ->columnSpanFull(),
            ]);
    }
}
