<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ItemsSold;
use App\Item;
use App\Cart;
use Session;

class AllOrdersController extends Controller
{

    public function __construct()
    {   //secure the controller (everything function) by auth
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $item = Item::all();
        $sold=ItemsSold::all();
        return view('allorders')->with('sold',$sold);
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
}
