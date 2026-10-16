<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Register extends BaseRegister
{

    public function getMaxWidth(): Width | string | null
    {
        return '4xl'; 
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Akun')
                    ->description('Data ini digunakan untuk login ke sistem')
                    ->columns(2)
                    ->schema([
                        $this->getNameFormComponent()
                            ->label('Nama Lengkap')
                            ->required(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ]),

                Section::make('Data Calon Peserta')
                    ->description('Lengkapi data diri dan skema yang dipilih')
                    ->columns(2)
                    ->schema([
                        Select::make('schema_id')
                            ->label('Skema Sertifikasi')
                            ->options(fn() => \App\Models\Schema::pluck('name', 'id')->toArray())
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
                                'unique' => 'NISN ini sudah terdaftar oleh peserta lain.',
                            ]),

                        Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])
                            ->required(),

                        TextInput::make('phone_number')
                            ->label('Nomor WhatsApp / HP')
                            ->tel()
                            ->minLength(11)
                            ->maxLength(13)
                            ->required(),

                        Textarea::make('address')
                            ->label('Alamat Domisili')
                            ->columnSpanFull()
                            ->rows(2)
                            ->nullable(),
                    ]),

                Section::make('Dokumen Persyaratan')
                    ->description('Unggah scan dokumen yang dibutuhkan')
                    ->columns(3)
                    ->schema([
                        FileUpload::make('ktp')
                            ->label('Scan KTP')
                            ->image()
                            ->directory('participants/ktp')
                            ->disk('public')
                            ->nullable(),

                        FileUpload::make('ijazah')
                            ->label('Scan Ijazah')
                            ->image()
                            ->directory('participants/ijazah')
                            ->disk('public')
                            ->nullable(),

                        FileUpload::make('sertifikat')
                            ->label('Sertifikat Pendukung')
                            ->image()
                            ->directory('participants/sertifikat')
                            ->disk('public')
                            ->nullable(),
                    ]),
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
