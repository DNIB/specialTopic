<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinput extends Model
{
    //
    protected $table = 'user_inputs';
    protected $fillable = ['userID','describe','itemID','money'];

    public function items()
    {
        return $this->belongsTo(
            Item::class,
            'itemID',
            'id'
        );
    }

    public function userSelfData()
    {
        return $this->belongsTo(
            Userdata::class,
            'userID',
            'id'
        );
    }
}
