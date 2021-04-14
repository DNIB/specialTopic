<?php

namespace App\Http\Controllers;

use App\Item;
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
        $UserID = Auth::user()->id;

        $userinput = Userinput::where('userID', '=', $UserID)->get();

        $items = Item::All()->keyBy('id')->toArray();
        
        return view('index', compact('userinput','items'));
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
            'itemID' => 'required',
            'money' => 'required',
        ]);
        $storeDataForm = [
            'money' => $request->get('money'),
            'userID' => $userID,
            'describe' => $request->get('describe'),
            'itemID' => $request->get('itemID'),
        ];
        $show = Userinput::create($storeDataForm);
        
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
        $editData = Userinput::findOrFail($id);
        return view('edit', compact('editData'));
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
        $validatedData = $request->validate([
            'describe' => 'nullable',
            'itemID' => 'required',
            'money' => 'required',
        ]);
        Userinput::whereId($id)->update($validatedData);
        return redirect('/Userinput')->with('success', 'Data is successfully updated');
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
        $deleteData = Userinput::findOrFail($id);
        $deleteData->delete();
        
        return redirect()->back()->with('success', 'Data is successfully deleted');
    }
}
