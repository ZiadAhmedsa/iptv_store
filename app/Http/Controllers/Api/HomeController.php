<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $baseUrl = url('/');

        $categoriesWithProducts = Cache::remember('api_home_categories', 300, function () use ($baseUrl) {
            return Category::query()
                ->select(['id', 'name', 'name_ar', 'name_en', 'slug', 'image', 'sort_order'])
                ->orderBy('sort_order')
                ->with(['products' => function ($query) {
                    $query->select(['id', 'category_id', 'name', 'name_ar', 'name_en', 'description', 'description_ar', 'description_en', 'price', 'discount_price', 'stock', 'is_active', 'created_at'])
                        ->where('is_active', true)
                        ->latest()
                        ->limit(10)
                        ->with('images:id,product_id,image_url,is_primary');
                }])
                ->get()
                ->map(function ($category) use ($baseUrl) {
                    $rawImage = $category->getRawOriginal('image');
                    $category->full_image_url = $rawImage ? $baseUrl . '/storage/' . ltrim($rawImage, '/') : null;

                $category->products->each(function ($product) use ($baseUrl) {
                    $product->append(['primary_image_url', 'effective_price', 'has_discount', 'discount_percentage']);
                    $product->full_image_url = $this->resolveImageUrl($product->primary_image_url, $baseUrl);
                });

                return $category;
            }) ?: collect();
        });

        $featuredProducts = Cache::remember('api_featured_products', 300, function () use ($baseUrl) {
            return Product::query()
                ->where('is_active', true)
                ->latest()
                ->take(8)
                ->with('images:id,product_id,image_url,is_primary')
                ->get()
                ->each(function ($product) use ($baseUrl) {
                    $product->append(['primary_image_url', 'effective_price', 'has_discount', 'discount_percentage']);
                    $product->full_image_url = $this->resolveImageUrl($product->primary_image_url, $baseUrl);
                }) ?: collect();
        });

        $bestSellingProducts = Cache::remember('api_best_selling_products', 300, function () use ($baseUrl) {
            return Product::query()
                ->where('is_active', true)
                ->withCount('orderItems')
                ->orderByDesc('order_items_count')
                ->take(4)
                ->with('images:id,product_id,image_url,is_primary')
                ->get()
                ->each(function ($product) use ($baseUrl) {
                    $product->append(['primary_image_url', 'effective_price', 'has_discount', 'discount_percentage']);
                    $product->full_image_url = $this->resolveImageUrl($product->primary_image_url, $baseUrl);
                }) ?: collect();
        });

        $banners = Cache::remember('api_home_banners', 300, function () {
            return Banner::query()
                ->select(['id', 'title', 'image_url', 'link_url', 'sort_order'])
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();
        });

        return response()->json([
            'categories_with_products' => $categoriesWithProducts,
            'featured_products' => $featuredProducts,
            'best_selling_products' => $bestSellingProducts,
            'banners' => $banners,
        ])->setPublic()->setMaxAge(300);
    }

    public function settings()
    {
        $settings = Cache::remember('api_settings_public', 600, fn () => [
            'site_name' => Setting::get('site_name', 'INZO STORE'),
            'site_description' => Setting::get('site_description', ''),
            'theme_color' => Setting::get('theme_color', '#6366f1'),
            'whatsapp' => Setting::get('whatsapp', ''),
            'logo_path' => Setting::get('logo_path', 'logo.svg'),
            'payment_bank_name' => Setting::get('payment_bank_name', ''),
            'payment_bank_account' => Setting::get('payment_bank_account', ''),
            'payment_bank_iban' => Setting::get('payment_bank_iban', ''),
            'contact_email' => Setting::get('contact_email', ''),
            'contact_phone' => Setting::get('contact_phone', ''),
            'contact_address' => Setting::get('contact_address', ''),
            'social_twitter' => Setting::get('social_twitter', ''),
            'social_instagram' => Setting::get('social_instagram', ''),
            'social_telegram' => Setting::get('social_telegram', ''),
        ]);

        return response()->json($settings)->setPublic()->setMaxAge(600);
    }

    private function resolveImageUrl(?string $url, string $baseUrl): ?string
    {
        if (!$url) return null;
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            // Replace localhost/127.0.0.1 with actual server URL for mobile access
            $url = preg_replace('#https?://(?:localhost|127\.0\.0\.1)(:\d+)?#', $baseUrl, $url);
            return $url;
        }
        $path = ltrim($url, '/');
        if (!str_starts_with($path, 'storage/')) {
            $path = 'storage/' . $path;
        }
        return $baseUrl . '/' . $path;
    }
}
