<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
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
        $users = User::where('id', '!=', 1)->get(); // منع حذف الأدمن نفسه
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        $this->checkAdmin();
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح');
    }
}
