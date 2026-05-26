<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('sort_order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link_url' => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        $imageUrl = $request->image_url;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $filename);
            $imageUrl = 'uploads/banners/' . $filename;
        }

        if (!$imageUrl) {
            return back()->withErrors(['image_url' => 'يجب تزويد رابط صورة أو رفع ملف صورة.'])->withInput();
        }

        Banner::create([
            'title' => $request->title,
            'image_url' => $imageUrl,
            'link_url' => $request->link_url,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'تم إضافة البنر بنجاح.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link_url' => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        $imageUrl = $request->image_url;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $filename);
            $imageUrl = 'uploads/banners/' . $filename;
        }

        $banner->update([
            'title' => $request->title,
            'image_url' => $imageUrl ?? $banner->image_url,
            'link_url' => $request->link_url,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'تم تحديث البنر بنجاح.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return back()->with('success', 'تم حذف البنر بنجاح.');
    }
}
