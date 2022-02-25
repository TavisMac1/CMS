<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ItemsSold;
use App\Item;
use Session;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        //check order details for errors
        $this->validate($request, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|min:0',
            'pnum' => 'required|integer',
            'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
        ]);

        //send to DB (use ELOQUENT)
        $customer = new Order;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->pnum = $request->pnum;
        $customer->email = $request->email;
        $customer->session_id = $request->sess;

        $customer->save(); //saves to DB

        Session::flash('success', 'Order complete');

        //redirect
        return redirect()->route('items.index');
    }
}
