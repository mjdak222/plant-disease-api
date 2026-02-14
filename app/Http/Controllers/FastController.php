<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use Illuminate\Support\Facades\Http;

class FastController extends Controller
{
    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $image = $request->file('image');

        // إرسال الصورة إلى FastAPI
        $response = Http::timeout(30)->attach(
            'image', file_get_contents($image), $image->getClientOriginalName()
        )->post('https://honor-speaks-ddr-suppliers.trycloudflare.com/predict');

        if (!$response->successful()) {
            return response()->json([
                'status' => 'error',
                'message' => 'فشل الاتصال بالـ FastAPI'
            ], 500);
        }

        $fastapiData = $response->json(); // يحتوي على 'disease_name' و 'confidence'
        $diseaseName = $fastapiData['disease_name'];

        // البحث في قاعدة البيانات عن المرض
        $disease = Disease::where('name', $diseaseName)->first();

        $result = [
            'disease_name' => $diseaseName,
            'confidence' => $fastapiData['confidence'] ?? null,
            'symptoms' => $disease?->symptoms ?? 'غير متوفر',
            'treatment' => $disease?->treatment ?? 'غير متوفر',
            'image' => $disease?->image ?? null,
        ];

        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }
}
