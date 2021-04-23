<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Userinput;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Gate;

class UserinputController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
        if (Gate::allows('admin')) {
            $userinput = Userinput::where('id', '>', 0)->with('items')->with('userSelfData')->get();

            return view('index', compact('userinput'));
        } else {
            $UserID = Auth::user()->id;
            $userinput = Userinput::where('userID', '=', $UserID)->with('items')->get();
            
            return view('index', compact('userinput'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create()
    {
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
        try {
            $validatedData = $request->validate([
                'itemID' => 'required',
                'money' => 'required|integer|max:999999|min:1',
            ]);
        } catch (\Throwable $e) {
            //throw APIException($e->getMessage(), 422);
            return redirect('/Userinput/create')->with('error', '金額輸入錯誤');
        }

        $storeDataForm = [
            'money' => $request->get('money'),
            'userID' => $userID,
            'describe' => $request->get('describe'),
            'itemID' => $request->get('itemID'),
        ];
        Userinput::create($storeDataForm);
        
        return redirect('/Userinput/create')->with('success', 'money is successfully saved');
    }

    /**
     * 編輯資料
     *
     * @param  int  $id
     * @return view
     */
    public function edit($id)
    {
        //
        $editData = Userinput::findOrFail($id);

        if (Gate::allows('admin')) {
            return view('edit', compact('editData'));
        }
        
        if (Gate::denies('admin')) {
            if (Auth::user()->id === $editData->userID) {
                return view('edit', compact('editData'));
            } else {
                abort(403);
            }
        }
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
            'itemID' => 'required',
            'money' => 'required|integer|min:1|max:999999',
            'describe' => 'nullable|string',
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
    
    public function showSearchItem(Request $request)
    {
        $searchItem = $request->get('searchItem');
        $searchUser = $request->get('searchUser');
        if (Gate::allows('admin')) {
            if ($searchUser != null && $searchItem != 0) {
                $userinput = Userinput::where('id', '>', 0)->where('itemID', $searchItem)->where('userID', $searchUser)->with('userSelfData')->get();
            }
            else if ($searchUser != null && $searchItem == 0) {
                $userinput = Userinput::where('id', '>', 0)->where('userID', $searchUser)->with('userSelfData')->get();
            }
            else {
                $userinput = Userinput::where('id', '>', 0)->where('itemID', $searchItem)->with('userSelfData')->get();
            }
        } else {
            $UserID = Auth::user()->id;
            $userinput = Userinput::where('userID', '=', $UserID)->where('itemID', $searchItem)->with('items')->get();
        }
        return view('index', compact('userinput'));
    }
}
