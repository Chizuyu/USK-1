<?php

namespace App\Filament\Resources\Participants\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ParticipantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Name')
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
                ImageColumn::make('ktp')
                    ->label('KTP')
                    ->disk('public'),
                ImageColumn::make('ijazah')
                    ->label('Ijazah')
                    ->disk('public'),
                ImageColumn::make('sertifikat')
                    ->label('Sertifikat')
                    ->disk('public'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        'verified' => 'success',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Menunggu Verifikasi',
                        'rejected' => 'Pendaftaran Ditolak',
                        'verified' => 'Terverifikasi',
                        default => $state,
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->schema([
                            // Buat grid utama menjadi 2 kolom
                            Grid::make(2)
                                ->schema([
                                    // --- KOLOM KIRI (Data Teks) ---
                                    Grid::make(1)
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
                                            TextEntry::make('status')
                                                ->label('Status')
                                                ->badge()
                                                ->color(fn(string $state): string => match ($state) {
                                                    'pending' => 'warning',
                                                    'rejected' => 'danger',
                                                    'verified' => 'success',
                                                })
                                                ->formatStateUsing(fn(string $state): string => match ($state) {
                                                    'pending' => 'Menunggu Verifikasi',
                                                    'rejected' => 'Pendaftaran Ditolak',
                                                    'verified' => 'Terverifikasi',
                                                    default => $state,
                                                }),
                                            TextEntry::make('address')
                                                ->label('Address')
                                                ->placeholder('-'),
                                        ])->columnSpan(1),

                                    Grid::make(1)
                                        ->schema([
                                            ImageEntry::make('ktp')
                                                ->label('KTP')
                                                ->disk('public'),
                                            ImageEntry::make('ijazah')
                                                ->label('Ijazah')
                                                ->disk('public'),
                                            ImageEntry::make('sertifikat')
                                                ->label('Sertifikat')
                                                ->disk('public'),
                                        ])->columnSpan(1),
                                ]),
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
                                ->required()
                                ->unique(table: 'participants', column: 'nisn', ignoreRecord: true)
                                ->validationMessages([
                                    'unique' => 'NISN ini sudah terdaftar oleh Participant lain.',
                                ]),
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
                                    'rejected' => 'Tolak Pendaftaran',
                                    'verified' => 'Terverifikasi',
                                ])
                                ->default('pending')
                                ->required()
                                ->disabled(! auth()->user()?->hasRole('super_admin'))
                                ->hidden(! auth()->user()?->hasRole('super_admin')),
                            Textarea::make('address')
                                ->columnSpanFull(),
                        ]),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
