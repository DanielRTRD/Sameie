<?php

namespace Sameie;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Condo extends Model
{

    use HasUUID;

    protected $table = 'condos';

    public function residents()
    {
        return $this->belongsToMany(User::class, 'condo_user')->where('approved_at', '!=', null);
    }

    public function managers()
    {
        return $this->belongsToMany(User::class, 'condo_manager');
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'condo_unit');
    }
}
