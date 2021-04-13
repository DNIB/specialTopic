<?php

namespace App\Http\Controllers;

use Auth;

use App\Userinput;

use Illuminate\Http\Request;

class DataCalculateController extends Controller
{
    //
    public function index() {

        //$sum = Userinput::user()->sum('price');
        $UserID = Auth::user()->id;
        $test = Userinput::where('userID', '=', $UserID)->sum('money');
        $data = Userinput::where('userID', '=', $UserID)->get();
        $eat = Userinput::where('userID', '=', $UserID)->where('itemID', '=', 1)->sum('money');
        $traffic = Userinput::where('userID', '=', $UserID)->where('itemID', '=', 2)->sum('money');
        $play = Userinput::where('userID', '=', $UserID)->where('itemID', '=', 3)->sum('money');
        $otherspend = Userinput::where('userID', '=', $UserID)->where('itemID', '=', 4)->sum('money');
        $salary = Userinput::where('userID', '=', $UserID)->where('itemID', '=', 5)->sum('money');
        $otherearn = Userinput::where('userID', '=', $UserID)->where('itemID', '=', 6)->sum('money');
        $allspend = Userinput::where('userID', '=', $UserID)->where('itemID', '<=', 4)->sum('money');
        $allearn = Userinput::where('userID', '=', $UserID)->where('itemID', '>=', 5)->sum('money');
        $finalmoney = $allearn - $allspend;


        return view('dataCalculate', compact(
            'test',
            'data', 
            'eat', 
            'allspend', 
            'allearn', 
            'traffic', 
            'play', 
            'otherspend', 
            'salary', 
            'otherearn', 
            'finalmoney'
        ));

    }

}
