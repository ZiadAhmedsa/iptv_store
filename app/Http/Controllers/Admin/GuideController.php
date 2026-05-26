<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::orderBy('sort_order')->get();
        return view('admin.guides.index', compact('guides'));
    }

    public function create()
    {
        $categories = Guide::select('category')->whereNotNull('category')->where('category', '!=', '')->distinct()->pluck('category');
        return view('admin.guides.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'icon' => 'required|string|max:255',
            'content' => 'required|string',
            'sort_order' => 'integer',
            'steps.*.image' => 'nullable|image|max:2048',
            'steps.*.description' => 'nullable|string',
        ]);

        $guide = Guide::create([
            'title' => $request->title,
            'category' => $request->category,
            'icon' => $request->icon,
            'content' => $request->content,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($request->has('steps')) {
            foreach ($request->steps as $index => $stepData) {
                $imagePath = null;
                if (isset($stepData['image'])) {
                    $path = $stepData['image']->store('guides', 'public');
                    $imagePath = '/storage/' . $path;
                }

                if ($imagePath || !empty($stepData['description'])) {
                    $guide->steps()->create([
                        'image_path' => $imagePath ?? '',
                        'description' => $stepData['description'] ?? '',
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.guides.index')->with('success', 'تم إضافة دليل التشغيل بنجاح.');
    }

    public function edit(Guide $guide)
    {
        $categories = Guide::select('category')->whereNotNull('category')->where('category', '!=', '')->distinct()->pluck('category');
        return view('admin.guides.edit', compact('guide', 'categories'));
    }

    public function update(Request $request, Guide $guide)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'icon' => 'required|string|max:255',
            'content' => 'required|string',
            'sort_order' => 'integer',
            'steps.*.image' => 'nullable|image|max:2048',
            'steps.*.description' => 'nullable|string',
        ]);

        $guide->update([
            'title' => $request->title,
            'category' => $request->category,
            'icon' => $request->icon,
            'content' => $request->content,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($request->has('steps')) {
            // Keep old steps images if not updated
            $oldSteps = $guide->steps()->get();
            $guide->steps()->delete();

            foreach ($request->steps as $index => $stepData) {
                $imagePath = $stepData['old_image'] ?? '';
                
                if (isset($stepData['image'])) {
                    $path = $stepData['image']->store('guides', 'public');
                    $imagePath = '/storage/' . $path;
                }

                if ($imagePath || !empty($stepData['description'])) {
                    $guide->steps()->create([
                        'image_path' => $imagePath,
                        'description' => $stepData['description'] ?? '',
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.guides.index')->with('success', 'تم تحديث دليل التشغيل بنجاح.');
    }

    public function destroy(Guide $guide)
    {
        $guide->delete();
        return back()->with('success', 'تم حذف دليل التشغيل بنجاح.');
    }
}
