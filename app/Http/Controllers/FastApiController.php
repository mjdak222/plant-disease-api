<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use Illuminate\Support\Facades\Http;

class FastApiController extends Controller
{
    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $image = $request->file('image');

        try {
            // إرسال الصورة إلى FastAPI مع اسم الحقل 'file'
            $response = Http::timeout(3000)
                ->withoutVerifying()
                ->attach('file', file_get_contents($image), $image->getClientOriginalName())
                ->post('https://desktops-segment-humanitarian-np.trycloudflare.com/predict');

            if (!$response->successful()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'فشل الاتصال بالـ FastAPI',
                    'details' => $response->body(),
                ], 500);
            }

            $fastapiData = $response->json();
            $diseaseName = $fastapiData['disease_name'] ?? null;

            if (!$diseaseName) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'لم يتم التعرف على اسم المرض من FastAPI',
                ], 500);
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
            return response()->json([
                'status' => 'error',
                'message' => 'خطأ في الاتصال بالـ FastAPI',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
