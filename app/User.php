<?php

namespace App;

use App\Models\Item;
use App\Models\Userinput;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';
    const ROLE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roll',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Create items of user when creating a new User
     * 
     * @return void 
     */
    public function save(array $options = [])
    {
        $isNewUser = ($this->id) == null;
        parent::save();
        if ($isNewUser) {
            $this->initItem();
        }
    }

    /**
     * Delete items of user when delete User
     * 
     * @return void
     */
    public function delete()
    {
        $items = $this->item();
        $items->delete();
        parent::delete();
    }

    /**
     * Initial Data of a User
     * 
     * @return void
     */
    private function initItem()
    {
        $user_id = $this->id;
        Item::create([
            'item' => '餐費',
            'ioID' => '1',
            'user_id' => $user_id,
        ]);

        Item::create([
            'item' => '交通',
            'ioID' => '1',
            'user_id' => $user_id,
        ]);

        Item::create([
            'item' => '娛樂',
            'ioID' => '1',
            'user_id' => $user_id,
        ]);

        Item::create([
            'item' => '其他支出',
            'ioID' => '1',
            'user_id' => $user_id,
        ]);

        Item::create([
            'item' => '薪水',
            'ioID' => '2',
            'user_id' => $user_id,
        ]);

        Item::create([
            'item' => '其他收入',
            'ioID' => '2',
            'user_id' => $user_id,
        ]);
    }

    /**
     * Define the relation of User to Item
     */
    public function item()
    {
        return $this->hasMany(
            Item::class,
            'user_id',
            'id'
        );
    }

    public function userinputs()
    {
        return $this->hasMany(
            Userinput::class,
            'userID',
            'id',
        );
    }
}
