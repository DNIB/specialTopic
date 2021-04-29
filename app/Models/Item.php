<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public function userinput()
    {
        return $this->hasMany(
            Userinput::class,
            'itemID',
            'id'
        );
    }
}
