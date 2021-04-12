<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Userinput;

class UserinputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // print_r($userId);
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userID = Auth::user()->id;
        //
        $validatedData = $request->validate([
            
            'money' => 'required',
        ]);
        $storeDataForm = [
            'money' => $request->get('money'),
            'userID' => $userID,
            'ioID' => '1',
            'itemID' => $request->get('itemID'),
        ];
        $show = Userinput::create($storeDataForm);
        
        //return redirect('/Userinputs')->with('success', 'money is successfully saved');
        return redirect('/Userinput/create')->with('success', 'money is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
