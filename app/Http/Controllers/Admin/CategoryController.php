<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('sort_order', 'asc')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'customization_enabled' => 'nullable|boolean',
            'description' => 'nullable|string',
            'name_en' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
        ], [
            'name_ar.required' => 'يرجى إدخال اسم الفئة بالعربية.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'category_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/categories'), $filename);
            $imagePath = 'uploads/categories/' . $filename;
        }

        Category::create([
            'name' => $request->name ?? $request->name_ar,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en ?? $request->name_ar,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name_en ?? $request->name_ar),
            'description' => $request->description ?? null,
            'image' => $imagePath,
            'customization_enabled' => $request->has('customization_enabled') ? boolval($request->customization_enabled) : false,
            'sort_order' => $request->sort_order ?? 999,
        ]);

        \Illuminate\Support\Facades\Cache::forget('home_categories_with_products');

        return back()->with('success', 'تم إضافة الفئة بنجاح!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['description'] = $request->description ?? $category->description;
        $data['name'] = $request->name_ar;
        $data['sort_order'] = $request->sort_order ?? 999;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'category_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/categories'), $filename);
            $data['image'] = 'uploads/categories/' . $filename;
        }

        $category->update($data);

        \Illuminate\Support\Facades\Cache::forget('home_categories_with_products');

        return back()->with('success', 'تم تحديث الفئة بنجاح!');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف الفئة لأنها تحتوي على منتجات.');
        }
        
        $category->delete();
        \Illuminate\Support\Facades\Cache::forget('home_categories_with_products');
        
        return back()->with('success', 'تم حذف الفئة بنجاح!');
    }
}
