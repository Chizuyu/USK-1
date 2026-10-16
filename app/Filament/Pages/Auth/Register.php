<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema as SchemaModel;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Register extends BaseRegister
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent()
                    ->label('Nama Lengkap')
                    ->required(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),

                Select::make('schema_id')
                    ->label('Skema Sertifikasi')
                    ->options(fn() => SchemaModel::pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('nisn')
                    ->label('NISN')
                    ->numeric()
                    ->minLength(10)
                    ->maxLength(10)
                    ->required()
                    ->unique(table: 'participants', column: 'nisn')
                    ->validationMessages([
                        'unique' => 'NISN ini sudah terdaftar oleh Participant lain.',
                    ]),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),

                TextInput::make('phone_number')
                    ->label('Nomor Telepon/WA')
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

                Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }
    protected function handleRegistration(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $user = $this->getUserModel()::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => $data['password'],
            ]);

            if (method_exists($user, 'assignRole')) {
                $user->assignRole('Participant');
            }

            $user->participant()->create([
                'schema_id'    => $data['schema_id'],
                'nisn'         => $data['nisn'],
                'name'         => $data['name'],
                'gender'       => $data['gender'],
                'phone_number' => $data['phone_number'],
                'address'      => $data['address'] ?? null,
                'ktp'          => $data['ktp'] ?? null,
                'ijazah'       => $data['ijazah'] ?? null,
                'sertifikat'   => $data['sertifikat'] ?? null,
                'status'       => 'pending',
            ]);

            return $user;
        });
    }
}
