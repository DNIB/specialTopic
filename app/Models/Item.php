<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item',
        'ioID',
        'user_id',
    ];

    public function userinput()
    {
        return $this->hasMany(
            Userinput::class,
            'itemID',
            'id'
        );
    }
}
