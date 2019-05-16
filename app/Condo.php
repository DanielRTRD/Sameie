<?php

namespace Sameie;

use Illuminate\Database\Eloquent\Model;

class Condo extends Model
{

    protected $table = 'condos';

    public function residents()
    {
        return $this->belongsToMany(User::class, 'condo_user')->where('approved_at', '!=', null);
    }

    public function managers()
    {
        return $this->belongsToMany(User::class, 'condo_manager');
    }
}
