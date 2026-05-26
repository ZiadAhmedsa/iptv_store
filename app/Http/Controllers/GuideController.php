<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::with('steps')->where('is_active', true)->orderBy('sort_order')->get();
        $categories = Guide::where('is_active', true)->whereNotNull('category')->where('category', '!=', '')->select('category')->distinct()->pluck('category');
        return view('guides.index', compact('guides', 'categories'));
    }
}
