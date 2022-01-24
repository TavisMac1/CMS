<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use Session;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
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
        $categories = Category::orderBy('name','ASC')->paginate(10);
        return view('products.index')->with('categories',$categories);
    }
}