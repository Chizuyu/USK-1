<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    protected $fillable = [
        'schema_id',
        'nisn',
        'name',
        'gender',
        'phone_number',
        'address'
    ];

    public function schema()
    {
        return $this->belongsTo(Schema::class);
    }
}
