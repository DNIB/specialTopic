<?php

namespace App\Http\Controllers;

use Auth;

use App\Userinput;

use Illuminate\Http\Request;

class DataCalculateController extends Controller
{
    //
    public function index() {
        
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
            }
            else {
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

    public function charData($id)
    {   
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
            }
            else {
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

        return $result;
    }

    public function showChar()
    {
        $id = Auth::user()->id;

        return view('showChar', compact('id'));
    }

    public function showSpendChar()
    {
        $id = Auth::user()->id;

        return view('showSpendChar', compact('id'));
    }

}
