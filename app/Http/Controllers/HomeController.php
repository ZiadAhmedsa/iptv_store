<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $categoriesWithProducts = Cache::remember('home_categories_with_products', 600, function () {
            return Category::orderBy('sort_order')->with(['products' => function ($query) {
                $query->where('is_active', true)->latest();
            }])->get();
        });

        // Keep featured for other potential uses or just pass categories
        $featuredProducts = Cache::remember('home_featured_products', 600, function () {
            return Product::where('is_active', true)->latest()->take(6)->get();
        });

        $bestSellingProducts = Cache::remember('home_best_selling_products', 600, function () {
            return Product::where('is_active', true)->withCount('orderItems')->orderByDesc('order_items_count')->take(4)->get();
        });

        $banners = \App\Models\Banner::where('is_active', true)->orderBy('sort_order')->get();

        return view('home', compact('categoriesWithProducts', 'featuredProducts', 'bestSellingProducts', 'banners'));
    }
}
