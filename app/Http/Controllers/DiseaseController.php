<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiseaseController extends Controller
{
    // عرض كل الأمراض
    public function index()
    {
        $diseases = Disease::all()->map(function ($disease) {
            return [
                'id'        => $disease->id,
                'name'      => $disease->name,
                'symptoms'  => $disease->symptoms,
                'treatment' => $disease->treatment,
                'image_url' => $disease->image ? asset('storage/' . $disease->image) : null,
            ];
        });

        return response()->json($diseases);
    }

    // إضافة مرض جديد مع صورة
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|unique:diseases,name',
            'symptoms' => 'required|string',
            'treatment'=> 'nullable|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('diseases', 'public');
        }

        $disease = Disease::create([
            'name'     => $request->name,
            'symptoms' => $request->symptoms,
            'treatment'=> $request->treatment,
            'image'    => $path,
        ]);

        return response()->json([
            'message' => 'Disease created successfully',
            'disease' => [
                'id'        => $disease->id,
                'name'      => $disease->name,
                'symptoms'  => $disease->symptoms,
                'treatment' => $disease->treatment,
                'image_url' => $disease->image ? asset('storage/' . $disease->image) : null,
            ]
        ], 201);
    }

    // استعلام عن مرض بالاسم
    public function showByName($name)
    {
        $disease = Disease::where('name', 'ILIKE', $name)->first();

        if (!$disease) {
            return response()->json(['message' => 'Disease not found'], 404);
        }

        return response()->json([
            'id'        => $disease->id,
            'name'      => $disease->name,
            'symptoms'  => $disease->symptoms,
            'treatment' => $disease->treatment,
            'image_url' => $disease->image ? asset('storage/' . $disease->image) : null,
        ]);
    }

    // تحديث مرض
    public function update(Request $request, Disease $disease)
    {
        $request->validate([
            'name'     => 'sometimes|string|unique:diseases,name,' . $disease->id,
            'symptoms' => 'sometimes|string',
            'treatment'=> 'nullable|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($disease->image) {
                Storage::disk('public')->delete($disease->image);
            }
            $disease->image = $request->file('image')->store('diseases', 'public');
        }

        $disease->update($request->only(['name', 'symptoms', 'treatment']));

        return response()->json([
            'message' => 'Disease updated successfully',
            'disease' => [
                'id'        => $disease->id,
                'name'      => $disease->name,
                'symptoms'  => $disease->symptoms,
                'treatment' => $disease->treatment,
                'image_url' => $disease->image ? asset('storage/' . $disease->image) : null,
            ]
        ]);
    }

    // حذف مرض
    public function destroy(Disease $disease)
    {
        if ($disease->image) {
            Storage::disk('public')->delete($disease->image);
        }

        $disease->delete();

        return response()->json(['message' => 'Disease deleted successfully']);
    }
}
