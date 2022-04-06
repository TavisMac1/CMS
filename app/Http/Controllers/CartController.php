<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use App\Category;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{   
    public function index(Request $request) {
        echo('on cart index');
        return redirect()->action([OrderController::class, 'store'])->with('request', $request->all());
    } 

    public function show($id) {
        $items = Item::orderBy('title','ASC')->paginate(10)->where('id','==', $id);
        return view('cart.cart')->with('items', $items);
    }

    public function store(Request $request)
    {
        //gather data from form, submit to DB
        $cart = new Cart;
        $cart->item_id = $request->id;
        $cart->session_id = $request->sess;
        $cart->ip_address = $request->ip;
        $cart->quantity = 1;

        $cart->save(); //saves to DB
        Session::flash('success','Items added to cart');

        //$cart = Cart::all()->where('session_id', '==', $request->sess)->last();
        //$items = Item::all()->where('id', '==', $request->id);
        $cart = Cart::all()->where('session_id', '==', $request->sess);
        $items = Item::all();
        //dd($items);
        return view('cart.cart')->with('items', $items)->with('cart', $cart);     
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
        $cart = Cart::find($id);
        $cart->quantity = $request->input('quantity');
        $cart->save();

        $cart = Cart::all()->where('session_id', '==', $request->sess);
        $items = Item::all();
        return view('cart.cart')->with(Session::flash('success','quantity updated'))->with('items', $items)->with('cart', $cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   $cart = Cart::find($id);
        $cart->delete();
        $cart = Cart::all()->where('session_id', '==', $request->sess);
        $items = Item::all();
        return view('cart.cart')->with(Session::flash('success', 'Item deleted from cart'))->with('items', $items)->with('cart', $cart);
    }
}
