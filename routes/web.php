<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome'); // أو أي view عندك
});


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDiseaseController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminLoginController;

// لوحة التحكم
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Users (عرض وحذف)
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('users.index');
Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

// Diseases CRUD
Route::resource('/admin/diseases', AdminDiseaseController::class);

// Posts CRUD
Route::resource('/admin/posts', AdminPostController::class);


Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
