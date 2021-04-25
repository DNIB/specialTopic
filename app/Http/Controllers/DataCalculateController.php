<?php

namespace App\Http\Controllers;

use App\Userinput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;

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
        $UserID = Auth::user()->id;
        $userData = Userinput::with('items')->where('userID', $UserID)->get();

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
        $finalmoney = $allearn - $allspend;

        $salary = $items['salary'];
        $eat = $items['eat'];
        $traffic = $items['traffic'];
        $play = $items['play'];
        $otherspend = $items['otherspend'];
        $otherearn = $items['otherearn'];

        return view('dataCalculate', compact(
            'eat',
            'traffic',
            'play',
            'otherspend',
            'salary',
            'otherearn',
            'allspend',
            'allearn',
            'finalmoney',
        ));
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
