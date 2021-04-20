<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userdata extends Model
{
    //
    protected $table = 'users';

    public function userinputs()
    {
        return $this->hasMany(
            Userinput::class,
            'id',
            'userID'
        );
    }
    
}
