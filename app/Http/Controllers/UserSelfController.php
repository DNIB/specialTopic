<?php

namespace App\Http\Controllers;

use App\Models\Userdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Userinput;

class UserSelfController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function edit($id)
    {
        //
        $editData = Userdata::findOrFail($id);
        return view('userSelfDataEdit', compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return redirect
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        Userdata::whereId($id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );
        
        return redirect('/home')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return redirect
     */
    public function destroy($id)
    {
        //
        $deleteData = Userdata::findOrFail($id);
        Userinput::where('userID', $id)->delete();
        $deleteData->delete();
        
        return back();
    }
}
