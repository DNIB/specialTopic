<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //admin登入後的頁面
    public function adminLogin() {
        return view('adminLogin');
    }
}
