<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        if (!(auth()->check() && auth()->user()->id === 5)) {
            abort(403, 'غير مسموح لك بالدخول هنا');
        }
    }

    public function dashboard()
    {
        $this->checkAdmin();
        return view('admin.dashboard');
    }
}
