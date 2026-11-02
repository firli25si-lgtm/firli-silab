<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // CRUD - Read (Eloquent)
    public function index()
    {
        $categories = Category::with('items')->get();
        return view('categories.index', compact('categories'));
    }

    // CRUD - Create (Eloquent)
    public function store(Request $request)
    {
        Category::create($request->only(['name', 'description']));
        return redirect()->back();
    }
}