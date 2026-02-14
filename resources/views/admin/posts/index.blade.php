@extends('layouts.admin')

@section('content')
<h2>البوستات</h2>
<a href="{{ route('posts.create', [], true) }}" class="btn btn-primary mb-3">إضافة بوست</a>

@push('toasts')
@if (session('success'))
<div class="toast align-items-center text-bg-success border-0" role="alert">
    <div class="d-flex">
        <div class="toast-body">{{ session('success') }}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
</div>
@endif

@if ($errors->any())
<div class="toast align-items-center text-bg-danger border-0" role="alert">
    <div class="d-flex">
        <div class="toast-body">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
</div>
@endif
@endpush

<table class="table table-bordered">
    <thead>
        <tr>
            <th>العنوان</th>
            <th>المحتوى</th>
            <th>كاتب البوست</th>
            <th>صورة</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ Str::limit($post->content, 50) }}</td>
            <td>{{ $post->user->name }}</td>
            <td>
                @if($post->image)
                    <img src="{{ url()->secure('storage/'.$post->image) }}" width="50" alt="صورة {{ $post->title }}">
                @endif
            </td>
            <td>
                <a href="{{ route('posts.edit', [$post], true) }}" class="btn btn-warning btn-sm">تعديل</a>
                <form action="{{ route('posts.destroy', [$post], true) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('هل تريد الحذف؟')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
