<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guide;

class GuideController extends Controller
{
    public function index()
    {
        $baseUrl = url('/');
        $guides = Guide::where('is_active', true)
            ->orderBy('sort_order')
            ->with('steps')
            ->get()
            ->map(function ($guide) use ($baseUrl) {
                $data = $guide->toArray();
                
                // Resolve guide icon
                if ($guide->icon) {
                    $data['full_icon_url'] = $this->resolveImageUrl($guide->icon, $baseUrl);
                }

                // Resolve each step image
                $data['steps'] = $guide->steps->map(function ($step) use ($baseUrl) {
                    $stepData = $step->toArray();
                    $stepData['full_image_url'] = $this->resolveImageUrl($step->image_path, $baseUrl);
                    return $stepData;
                });

                return $data;
            });

        $categories = Guide::where('is_active', true)
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->select('category')
            ->distinct()
            ->pluck('category');

        return response()->json([
            'guides' => $guides,
            'categories' => $categories,
        ]);
    }

    private function resolveImageUrl(?string $url, string $baseUrl): ?string
    {
        if (!$url) return null;
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return preg_replace('#https?://(?:localhost|127\.0\.0\.1)(:\d+)?#', $baseUrl, $url);
        }
        $path = ltrim($url, '/');
        if (!str_starts_with($path, 'storage/') && !str_starts_with($path, 'uploads/')) {
            $path = 'storage/' . $path;
        }
        return $baseUrl . '/' . $path;
    }
}
