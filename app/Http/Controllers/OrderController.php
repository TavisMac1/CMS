<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ItemsSold;
use App\Item;
use App\Cart;
use Session;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $cart = Cart::all()->where('session_id', '==', $request->sess);
        $items = Item::all();
        return view('cart.cart')->with('items', $items)->with('cart', $cart); 
    } 

    public function store(Request $request)
    {
        //check order details for errors
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'pnum' => 'required|integer',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
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

        $sale = new ItemsSold;
        $getOrder = Order::all()->where('session_id', '==', $request->sess);
        $customerInfo = Order::all()->where('session_id', '==', $request->sess)->last();
        $getCart = Cart::all()->where('session_id', '==', $request->sess);

        foreach ($getCart as $cart) {    //loop through to check session id
            $getItems = Item::all();
            foreach ($getItems as $items) {
                if ($items->id == $cart->item_id) {
                    $sale->item_price = $items->price * $cart->quantity;
                }
            }
            $sale->item_id = $cart->item_id;
            $sale->quantity = $cart->quantity;
            foreach ($getOrder as $orders) {
                $sale->order_id = $orders->order_id;
            }
            $sale->save();
        }
        $getItems = Item::all();
        return view('thankyou')->with('cart', $getCart)->with('order', $customerInfo)->with('item', $getItems);
    }
}