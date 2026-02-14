@extends('layouts.admin')

@section('content')
<h1 class="mb-4">مرحباً أدمن!</h1>

<div class="row g-3">
    <div class="col-md-4">
        <a href="{{ route('diseases.index', [], true) }}" class="btn btn-primary w-100">إدارة الأمراض</a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('posts.index', [], true) }}" class="btn btn-success w-100">إدارة البوستات</a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('users.index', [], true) }}" class="btn btn-warning w-100">إدارة المستخدمين</a>
    </div>
</div>
@endsection
