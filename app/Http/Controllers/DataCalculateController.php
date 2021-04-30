<?php

namespace App\Http\Controllers;

use App\Models\Userinput;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DataCalculateController extends Controller
{
    //
    /**
     * caculate data then return view and data
     *
     * @return view
     */
    public function index()
    {
        $user = Auth::user();

        $cost_items = $user->item()->where('ioID', '1')->get();
        $earn_items = $user->item()->where('ioID', '2')->get();

        $cost = $this->calcAllInput($cost_items);
        $earn = $this->calcAllInput($earn_items);
        
        $ret = [
            'cost' => $cost,
            'earn' => $earn,
            'api_token' => $user->api_token,
            'user_id' => $user->id,
        ];

        return view('dataCalculate', $ret);
    }

    /**
     * Calculate all the userinput of items
     * 
     * @param Item $items
     * 
     * @return array
     */
    private function calcAllInput($items)
    {
        $ret_items = [];
        $ret_total = 0;
        foreach ($items as $item) {
            $datas = $item->userinput()->get();
            $name = $item->item;
            $item_total = 0;

            foreach ($datas as $data) {
                $item_total += $data->money;
            }
            $ret_items[$name] = $item_total;
            $ret_total += $item_total;
        }
        return [
            'items' => $ret_items,
            'total' => $ret_total,
        ];
    }

    /**
     * create api data for char
     *
     * @param int $id
     * @return json data
     */
    public function charData($id)
    {   
        $a=Auth::user()->api_token;
        $e=User::where('id', $id)->max('api_token');
        //判斷是不是請求自己的api

        $userData = Userinput::with('items')->where('userID', $id)->get();
        $items = [];
        $allspend = 0;
        $allearn = 0;
        $itemName = [
            'eat',
            'traffic',
            'play',
            'otherspend',
            'salary',
            'otherearn',
        ];
        for ($i = 0; $i < 6; $i++) {
            $items[$itemName[$i]] = $userData->where('itemID', $i + 1)->sum('money');
            if ($i <= 3) {
                $allspend += $items[$itemName[$i]];
            } else {
                $allearn += $items[$itemName[$i]];
            }
        }

        $salary = $items['salary'];
        $eat = $items['eat'];
        $traffic = $items['traffic'];
        $play = $items['play'];
        $otherspend = $items['otherspend'];
        $otherearn = $items['otherearn'];

        $result = [
            'eat' => $eat,
            'traffic' => $traffic,
            'play' => $play,
            'otherspend' => $otherspend,
            'salary' => $salary,
            'otherearn' => $otherearn,
            'allspend' => $allspend,
            'allearn' => $allearn,
        ];

        if($a==$e){
            return $result;
        } else {
            dd(123);
        }
    }
}
