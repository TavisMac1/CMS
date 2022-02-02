<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{  
     public function __construct()
    {   //secure the controller (everything function) by auth
        $this->middleware('auth');
    }

    public function index() {
        echo('on cart index');
        /*()
        dump($id, $ip, $sess);
        $cart = new Cart;
        $cart->item_id = $id;
        $cart->session_id = $sess;
        $cart->ip_address = $ip;
        $cart->quantity = 1;

        $cart->save(); //saves to DB
        $items = Item::orderBy('title','ASC')->paginate(10)->where('id','==', $id);
         return view('shopping.cart')->with('items', $items);  */
        Session::flash('success','Items added to cart');
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
        $empty = false;
        Session::flash('success','Items added to cart');

        //get data from the cart DB where the session id is equal to current 
        $getCart = Cart::all()->where('session_id','==', $request->sess);
        foreach($getCart as $cart) {    //loop through to check session id
            if ($cart->session_id == $request->sess) {
                $empty = true;
            }  else {
                echo("session expired");
            }
        }

        if ($empty == true) { //session matches proceed to cart viewing
            $cart = Cart::all()->where('session_id','==', $request->sess);
            $items = Item::orderBy('title','ASC')->paginate(10)->where('id','==', $request->id);
            return view('cart.cart')->with('items', $items)->with('cart', $cart);
        }
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
        $quantity = Cart::find($id);
        $quantity->quantity = $request->input('quantity');
        $quantity->save();

        $cart = Cart::all()->where('session_id','==', $request->sess);
        $items = Item::orderBy('title','ASC')->paginate(10)->where('id','==', $request->id);
        return view('cart.cart')->with(Session::flash('success','quantity updated'))->with('items', $items)->with('cart', $cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $cart = Cart::find($id);
        $cart->delete();
    }
}
