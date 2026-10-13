<?php

namespace App\Filament\Resources\Participants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ParticipantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),
                TextColumn::make('schema.name')
                    ->label('Schema Name')
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Gender')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'male' => 'info',
                        'female' => 'danger',
                    }),
                TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->schema([
                        TextEntry::make('schema.name')
                            ->label('Schema Name'),
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
                    ]),
                EditAction::make()
                    ->schema([
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
                            ->maxLength(55)
                            ->regex('/^[a-zA-Z\s]+$/')
                            ->validationMessages([
                                'regex' => 'Nama hanya boleh berupa huruf dan spasi, tidak boleh ada angka atau karakter khusus!',
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
                    ]),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
