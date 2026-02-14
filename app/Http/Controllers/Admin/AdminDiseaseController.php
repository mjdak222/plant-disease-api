<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class AdminDiseaseController extends Controller
{
    private function checkAdmin()
    {
        if (!(auth()->check() && auth()->user()->id === 5)) {
            abort(403, 'غير مسموح لك بالدخول هنا');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $diseases = Disease::all();
        return view('admin.diseases.index', compact('diseases'));
    }

    public function create()
    {
        $this->checkAdmin();
        return view('admin.diseases.create');
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'symptoms' => 'nullable|string',
            'treatment' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('diseases', 'public');
        }

        Disease::create($data);
        return redirect()->route('diseases.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Disease $disease)
    {
        $this->checkAdmin();
        return view('admin.diseases.edit', compact('disease'));
    }

    public function update(Request $request, Disease $disease)
    {
        $this->checkAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'symptoms' => 'nullable|string',
            'treatment' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('diseases', 'public');
        }

        $disease->update($data);
        return redirect()->route('diseases.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(Disease $disease)
    {
        $this->checkAdmin();
        $disease->delete();
        return redirect()->route('diseases.index')->with('success', 'تم الحذف بنجاح');
    }
}
