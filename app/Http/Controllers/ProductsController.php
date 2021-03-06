<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use Session;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $items = Item::all();
        $categories = Category::orderBy('name','ASC')->paginate(10);
        return view('products.index')->with('categories',$categories)->with('items', $items);
    }

    public function show($id)
    {   
        $categories = Category::orderBy('name','ASC')->paginate(10);
        $items = Item::orderBy('title','ASC')->paginate(10)->where('category_id','==', $id);
        return view('products.publicindex')->with('categories',$categories)->with('items', $items);
    }

    public function display($id)
    {
        $items = Item::orderBy('title','ASC')->paginate(10)->where('id','==', $id);
        return view('products.publicDetails')->with('items', $items);
    }
}
