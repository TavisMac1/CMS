<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{   
    public function show($id) {
        $items = Item::orderBy('title','ASC')->paginate(10)->where('id','==', $id);
        return view('cart.cart')->with('items', $items);
    }

    public function store($id,$sess,$ip )
    { 
        //send to DB (use ELOQUENT)
        $cart = new Cart;
        $cart->item_id = $id;
        $cart->session_id = $sess;
        $cart->ip_address = $ip;
        $cart->quantity = 1;

        $cart->save(); //saves to DB

        Session::flash('success','Items added to cart');

        //redirect
        return redirect()->route('cart.cart');
    }

    public function edit($id)
    {   

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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        return redirect()->route('categories.index');
    }
}
