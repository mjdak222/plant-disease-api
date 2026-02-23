@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h1 class="fw-bold mb-1">لوحة تحكم الأدمن</h1>
        <p class="text-info-emphasis mb-0">واجهة حديثة بنمط لعبي مشابه لأسلوب المنصات التنافسية.</p>
    </div>
    <span class="badge text-bg-info px-3 py-2">LIVE CONTROL PANEL</span>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 h-100" style="background:linear-gradient(130deg, rgba(41,211,255,.22), rgba(0,0,0,.1));">
            <div class="card-body">
                <h5 class="card-title">إدارة الأمراض</h5>
                <p class="card-text text-secondary">إضافة وتحديث قاعدة الأمراض وخطط العلاج.</p>
                <a href="{{ route('diseases.index') }}" class="btn btn-primary">الدخول للقسم</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 h-100" style="background:linear-gradient(130deg, rgba(143,91,255,.22), rgba(0,0,0,.1));">
            <div class="card-body">
                <h5 class="card-title">إدارة البوستات</h5>
                <p class="card-text text-secondary">مراجعة المحتوى المنشور والتحكم فيه.</p>
                <a href="{{ route('posts.index') }}" class="btn btn-primary">الدخول للقسم</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 h-100" style="background:linear-gradient(130deg, rgba(255,95,143,.22), rgba(0,0,0,.1));">
            <div class="card-body">
                <h5 class="card-title">إدارة المستخدمين</h5>
                <p class="card-text text-secondary">متابعة الحسابات والحذف عند الحاجة.</p>
                <a href="{{ route('users.index') }}" class="btn btn-primary">الدخول للقسم</a>
            </div>
        </div>
    </div>
</div>

<div class="card border-0" style="background: rgba(255,255,255,.03)">
    <div class="card-body">
        <h5 class="mb-3">ملاحظات تشغيل سريعة</h5>
        <ul class="mb-0 text-secondary">
            <li>استخدم لوحة الأمراض لإدارة بيانات التشخيص التي تظهر للمستخدم النهائي.</li>
            <li>راجع المحتوى في قسم البوستات قبل ظهوره داخل التطبيق.</li>
            <li>تابع المستخدمين غير النشطين أو المسيئين من قسم المستخدمين.</li>
        </ul>
    </div>
</div>
@endsection
