<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table = 'items';

    public function userinput()
    {
        return $this->belongsToMany('App\Userinput');
    }
}
