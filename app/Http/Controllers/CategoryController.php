<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['products' => function($query) {
            $query->where('is_active', true);
        }])->orderBy('sort_order')->get();
        
        return view('categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->where('is_active', true)->latest()->paginate(12);
        
        return view('categories.show', compact('category', 'products'));
    }
}
