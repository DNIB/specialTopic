<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinput extends Model
{
    //
    protected $table = 'user_inputs';
    protected $fillable = ['userID','ioID','itemID','money'];

    public function items() 
    {
        return $this->belongsToMany('App\Item');
    }
}
