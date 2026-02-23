<?php

// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\FastApiController;

Route::post('/predict-disease', [FastApiController::class, 'predict']);



Route::get('/diseases', [DiseaseController::class, 'index']);
Route::get('/diseases/name/{name}', [DiseaseController::class, 'showByName']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
 Route::get('/posts',        [PostController::class, 'index']);   // عرض المقالات

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me',        [AuthController::class, 'me']);
    Route::post('/logout',   [AuthController::class, 'logout']);
    Route::post('/logout-all',[AuthController::class, 'logoutAll']);



    
    // 📝 المقالات
   
    Route::post('/posts',       [PostController::class, 'store']);   // إضافة مقال

    // إدارة الأمراض (محمي)
    Route::post('/diseases', [DiseaseController::class, 'store']);
    Route::put('/diseases/{disease}', [DiseaseController::class, 'update']);
    Route::delete('/diseases/{disease}', [DiseaseController::class, 'destroy']);

    // لايكات
    Route::post('/posts/{post}/like',   [LikeController::class, 'store']);
    Route::delete('/posts/{post}/like', [LikeController::class, 'destroy']);

    // تعليقات
    Route::post('/posts/{post}/comment', [CommentController::class, 'store']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);

    // هون لاحقاً بتحط روتات رفع الصور وتشخيص المرض… إلخ
});
