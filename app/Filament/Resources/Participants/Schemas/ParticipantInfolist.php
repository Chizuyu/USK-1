<?php

namespace App\Filament\Resources\Participants\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ParticipantInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('schema.name')
                    ->label('Scheme Name'),
                TextEntry::make('nisn')
                    ->label('NISN'),
                TextEntry::make('name')
                    ->label('Name'),
                TextEntry::make('gender')
                    ->label('Gender')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'male' => 'info',
                        'female' => 'danger',
                    }),
                TextEntry::make('phone_number')
                    ->label('Phone Number'),
                TextEntry::make('address')
                    ->label('Address')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
