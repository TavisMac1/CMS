<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use Session;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        // if fails, defaults to create() passing errors
        $this->validate($request, ['name'=>'required|max:100|unique:categories,name']); 

        //send to DB (use ELOQUENT)
        $category = new Category;
        $category->name = $request->name;
        $category->save(); //saves to DB

        Session::flash('success','The category has been added');

        //redirect
        return redirect()->route('categories.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $category = Category::find($id);
        return view('categories.edit')->with('category',$category);
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
        //validate the data
        // if fails, defaults to create() passing errors
        $category = Category::find($id);
        $this->validate($request, ['name'=>"required|max:100|unique:categories,name,$id"]);             

        //send to DB (use ELOQUENT)
        $category->name = $request->name;

        $category->save(); //saves to DB

        Session::flash('success','The category has been updated');

        //redirect
        return redirect()->route('categories.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //delete the category by ID
        //Category => reference the model, which is DB reference for category | id is returned by view
        $cat = Category::find($id);
        $item = Item::all();
        
        foreach ($item as $it) {
        //    Session::flash('success',$it->category_id);
            if ($it->category_id == $cat->id) {
                Session::flash('success','THE CAT NOT DELETED');
            } else {
                $cat->delete();
                Session::flash('success','The category has been deleted');
            }
        } 
        /*
        $cat->delete();
        Session::flash('success','The category has been deleted'); */

        return redirect()->route('categories.index');
    }
}
