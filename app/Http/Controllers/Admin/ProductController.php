<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(15);
        $categories = Category::all();
        
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'يرجى إدخال اسم المنتج.',
            'category_id.required' => 'يرجى اختيار الفئة.',
            'price.required' => 'يرجى إدخال السعر.',
            'stock.required' => 'يرجى إدخال كمية المخزون.',
            'discount_price.lt' => 'سعر الخصم يجب أن يكون أقل من السعر الأصلي.',
        ]);

        $productData = [
            'name' => $request->name_ar,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en ?? $request->name_ar,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'description' => $request->description_ar,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en ?? $request->description_ar,
            'is_active' => $request->has('is_active'),
        ];

        $product = Product::create($productData);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->images()->create([
                'image_url' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'تم إضافة المنتج بنجاح!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $productData = [
            'name' => $request->name_ar,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en ?? $request->name_ar,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'description' => $request->description_ar,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en ?? $request->description_ar,
            'is_active' => $request->has('is_active'),
        ];

        $product->update($productData);

        if ($request->hasFile('image')) {
            // Delete old primary image if exists
            $product->images()->where('is_primary', true)->delete();
            
            $path = $request->file('image')->store('products', 'public');
            $product->images()->create([
                'image_url' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'تم تحديث المنتج بنجاح!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'تم حذف المنتج بنجاح!');
    }
}
