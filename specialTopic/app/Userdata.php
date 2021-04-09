<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userdata extends Model
{
    //
    protected $table = 'users';

    public function userinput()
    {
        return $this->belongsToMany('App\Userinput');
    }
}
