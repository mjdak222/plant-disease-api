<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FastApiController extends Controller
{
    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $image = $request->file('image');

        try {
            $baseUrl = rtrim(config('services.fastapi.base_url'), '/');
            $response = Http::timeout(config('services.fastapi.timeout_seconds'))
                ->retry(
                    config('services.fastapi.retry_times'),
                    config('services.fastapi.retry_sleep_ms')
                )
                ->withOptions(['verify' => config('services.fastapi.verify_ssl')])
                ->attach('file', file_get_contents($image), $image->getClientOriginalName())
                ->post("{$baseUrl}/predict");

            if (!$response->successful()) {
                Log::error('FastAPI request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'فشل الاتصال بخدمة التشخيص',
                ], 502);
            }

            $fastapiData = $response->json();
            $diseaseName = $fastapiData['disease_name'] ?? null;

            if (!$diseaseName) {
                Log::warning('FastAPI response missing disease_name', ['response' => $fastapiData]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'لم يتم التعرف على المرض من خدمة التشخيص',
                ], 502);
            }

            $disease = Disease::where('name', $diseaseName)->first();

            // تحويل الصورة المرسلة إلى Base64
            $imageBase64 = base64_encode(file_get_contents($image));
            $imageMime = $image->getMimeType();
            $imageDataUri = "data:$imageMime;base64,$imageBase64";

            $result = [
                'disease_name' => $diseaseName,
                'confidence' => $fastapiData['confidence'] ?? null,
                'symptoms' => $disease?->symptoms ?? 'غير متوفر',
                'treatment' => $disease?->treatment ?? 'غير متوفر',
                'sent_image' => $imageDataUri, // الصورة اللي أرسلها المستخدم
            ];

            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);

        } catch (\Exception $e) {
            Log::error('FastAPI integration exception', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'تعذر الوصول لخدمة التشخيص حالياً',
            ], 502);
        }
    }
}
