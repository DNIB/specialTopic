<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Userinput;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Gate;
use App\User;

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
            $userinputs = Userinput::all();
            $items = Item::all();
            
        } else {
            $user = Auth::user();
            $userinputs = $user->userinputs()->get();
            $items = $user->item;
        }

        $ret = $this->divideInput($userinputs);
        $ret['items'] = $items;

        return view('index', $ret);
    }

    /**
     * Divide Userinput to Cost and Earn
     * 
     * @param Userinput $userinputs
     * 
     * @return array
     */
    private function divideInput($userinputs)
    {
        $ret = [
            'cost' => [],
            'earn' => [],
        ];
        foreach ($userinputs as $userinput) {
            if ($userinput->items->ioID == 1) {
                $ret['cost'][] = $userinput;
            } else {
                $ret['earn'][] = $userinput;
            }
        }
        return $ret;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create()
    {   
        $user = Auth::user();

        $cost_items = $user->item()->where('ioID', 1)->get();
        $earn_items = $user->item()->where('ioID', 2)->get();

        $ret = [
            'cost_items' => $cost_items,
            'earn_items' => $earn_items,
        ];

        return view('create', $ret);
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
                'describe' => 'nullable|string|',
            ]);
        } catch (\Throwable $e) {
            return redirect('/Userinput/create')->with('error', '請依照規格輸入');
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
            } elseif ($searchUser != null && $searchItem == 0) {
                $userinput = Userinput::where('id', '>', 0)->where('userID', $searchUser)->with('userSelfData')->get();
            } else {
                $userinput = Userinput::where('id', '>', 0)->where('itemID', $searchItem)->with('userSelfData')->get();
            }
        } else {
            $UserID = Auth::user()->id;
            $userinput = Userinput::where('userID', '=', $UserID)->where('itemID', $searchItem)->with('items')->get();
        }
        return view('index', compact('userinput'));
    }
}
