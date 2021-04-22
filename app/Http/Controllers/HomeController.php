<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userdata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::allows('admin')) {
            $userdata = Userdata::where('id', '>', 0)->get();

            $email = Auth::user()->email;
            $name = Auth::user()->name;

            return view('home', compact('email', 'name', 'userdata'));
        }

        if (Gate::denies('admin')) {
            $email = Auth::user()->email;
            $name = Auth::user()->name;

            return view('home', compact('email', 'name'));
        }
    }
}
