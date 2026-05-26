<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $baseUrl = url('/');
        $categories = Cache::remember('api_categories_index', 300, function () use ($baseUrl) {
            return Category::query()
                ->select(['id', 'parent_id', 'name', 'name_ar', 'name_en', 'slug', 'description', 'image', 'sort_order'])
                ->withCount(['products' => fn ($query) => $query->where('is_active', true)])
                ->orderBy('sort_order')
                ->get()
                ->map(function ($category) use ($baseUrl) {
                    $raw = $category->getRawOriginal('image');
                    $category->full_image_url = $raw ? $baseUrl . '/storage/' . ltrim($raw, '/') : null;

                    return $category;
                });
        });

        return response()->json($categories)->setPublic()->setMaxAge(300);
    }

    public function show(Request $request, string $slug)
    {
        $baseUrl = url('/');
        $perPage = min(max((int) $request->integer('per_page', 20), 1), 50);
        $page = max((int) $request->integer('page', 1), 1);

        $payload = Cache::remember("api_category_{$slug}_{$page}_{$perPage}", 300, function () use ($slug, $baseUrl, $perPage) {
            $category = Category::select(['id', 'name', 'name_ar', 'name_en', 'slug', 'description', 'image'])
                ->where('slug', $slug)
                ->firstOrFail();

            $products = $category->products()
                ->select(['id', 'category_id', 'name', 'name_ar', 'name_en', 'description', 'description_ar', 'description_en', 'price', 'discount_price', 'stock', 'is_active', 'created_at'])
                ->where('is_active', true)
                ->with('images:id,product_id,image_url,is_primary')
                ->latest()
                ->paginate($perPage)
                ->through(function ($product) use ($baseUrl) {
                    $product->append(['primary_image_url', 'effective_price', 'has_discount', 'discount_percentage']);
                    $imgUrl = $product->primary_image_url;
                    if ($imgUrl && ! str_starts_with($imgUrl, 'http')) {
                        $path = ltrim($imgUrl, '/');
                        if (! str_starts_with($path, 'storage/')) $path = 'storage/' . $path;
                        $product->full_image_url = $baseUrl . '/' . $path;
                    } else {
                        $product->full_image_url = $imgUrl ? preg_replace('#https?://(?:localhost|127\.0\.0\.1)(:\d+)?#', $baseUrl, $imgUrl) : null;
                    }

                    return $product;
                });

            return [
                'category' => $category,
                'products' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                ],
            ];
        });

        return response()->json($payload)->setPublic()->setMaxAge(300);
    }
}
