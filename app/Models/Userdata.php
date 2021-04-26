<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userdata extends Model
{
    //
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'roll',
    ];
    
    public function userinputs()
    {
        return $this->hasMany(
            Userinput::class,
            'id',
            'userID'
        );
    }
}
