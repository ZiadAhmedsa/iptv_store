<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $baseUrl = url('/');
        $perPage = min(max((int) $request->integer('per_page', 20), 1), 50);
        $page = max((int) $request->integer('page', 1), 1);

        $products = Cache::remember("api_products_page_{$page}_{$perPage}", 300, function () use ($baseUrl, $perPage) {
            return Product::query()
                ->select([
                    'id',
                    'category_id',
                    'name',
                    'name_ar',
                    'name_en',
                    'description',
                    'description_ar',
                    'description_en',
                    'price',
                    'discount_price',
                    'stock',
                    'is_active',
                    'created_at',
                ])
                ->with([
                    'category:id,name,name_ar,name_en,slug',
                    'images:id,product_id,image_url,is_primary',
                ])
                ->active()
                ->latest()
                ->paginate($perPage)
                ->through(fn ($product) => $this->transformProduct($product, $baseUrl));
        });

        return response()->json($products)->setPublic()->setMaxAge(300);
    }

    public function show($id)
    {
        $baseUrl = url('/');
        $product = Cache::remember("api_product_{$id}", 300, function () use ($id, $baseUrl) {
            $product = Product::with([
                'category:id,name,name_ar,name_en,slug',
                'images:id,product_id,image_url,is_primary',
            ])->findOrFail($id);

            return $this->transformProduct($product, $baseUrl);
        });
        
        return response()->json($product)->setPublic()->setMaxAge(300);
    }

    private function transformProduct(Product $product, string $baseUrl): Product
    {
        $product->append(['primary_image_url', 'effective_price', 'has_discount', 'discount_percentage']);
        $product->full_image_url = $this->resolveImageUrl($product->primary_image_url, $baseUrl);

        return $product;
    }

    private function resolveImageUrl(?string $url, string $baseUrl): ?string
    {
        if (!$url) return null;
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return preg_replace('#https?://(?:localhost|127\.0\.0\.1)(:\d+)?#', $baseUrl, $url);
        }
        $path = ltrim($url, '/');
        if (!str_starts_with($path, 'storage/')) $path = 'storage/' . $path;
        return $baseUrl . '/' . $path;
    }
}
