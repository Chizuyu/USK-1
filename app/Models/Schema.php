<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    protected $table = 'schemas';
    protected $fillable = [
        'code',
        'name',
        'type'
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
