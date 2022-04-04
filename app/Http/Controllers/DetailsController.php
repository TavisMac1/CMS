<?php

namespace App\Http\Controllers;
use App\Item;
use Illuminate\Http\Request;

class DetailsController extends Controller
{   
    public function show($id) {
        echo($id);
        $items = Item::orderBy('title','ASC')->paginate(10)->where('id','==', $id);
        return view('products.publicDetails')->with('items', $items);
    }
}
