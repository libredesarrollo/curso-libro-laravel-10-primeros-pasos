<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('editor.category.index')){
            return abort(403);
        }

        $categories = Category::paginate(2);
        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(!Auth::user()->hasPermissionTo('editor.category.create')){
            return abort(403);
        }

        $category = new Category();
        echo view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        
        if(!Auth::user()->hasPermissionTo('editor.category.create')){
            return abort(403);
        }

        Category::create($request->validated());
        return to_route("category.index")->with('status',"Registro creado.");;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        if(!Auth::user()->hasPermissionTo('editor.category.index')){
            return abort(403);
        }

        return view("dashboard.category.show",compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(!Auth::user()->hasPermissionTo('editor.category.update')){
            return abort(403);
        }

        echo view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(PutRequest $request, Category $category){
        
        if(!Auth::user()->hasPermissionTo('editor.category.update')){
            return abort(403);
        }

        $category->update($request->validated());
        return to_route("category.index")->with('status',"Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(!Auth::user()->hasPermissionTo('editor.category.destroy')){
            return abort(403);
        }

        $category->delete();
        return to_route("category.index")->with('status',"Registro eliminado.");
    }
}
