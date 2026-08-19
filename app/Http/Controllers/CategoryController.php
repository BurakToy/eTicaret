<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->with('children')->firstOrFail();
        $children = $category->children;


    return view('category.index',compact('category','children'));
    }
}


