<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    protected $fillable = [
        'user_id',
        'schema_id',
        'nisn',
        'name',
        'gender',
        'phone_number',
        'address',
        'ktp',
        'ijazah',
        'sertifikat',
        'status'
    ];

    protected static function booted(): void
    {
        static::updated(function ($participant) {
            if ($participant->wasChanged('name') && $participant->user) {
                $participant->user->update([
                    'name' => $participant->name,
                ]);
            }
        });
    }

    public function schema()
    {
        return $this->belongsTo(Schema::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
