<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/check-db', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Database connected: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "❌ Error: " . $e->getMessage();
    }
});

