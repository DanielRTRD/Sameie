<?php

namespace Sameie;

use Illuminate\Database\Eloquent\Model;
use BinaryCabin\LaravelUUID\Traits\HasUUID;

class Unit extends Model
{
    use HasUUID;

    protected $table = 'unit';

    public function resident()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function condo()
    {
        return $this->belongsTo(Condo::class);
    }
}
