@extends('layouts.admin')

@section('content')
<h2>تعديل بوست</h2>

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

<form action="{{ route('posts.update', $post, true) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')

<div class="mb-3">
<label>العنوان</label>
<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}" required>
@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
<label>المحتوى</label>
<textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content', $post->content) }}</textarea>
@error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
<label>الصورة</label>
<input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
@if($post->image)
<img src="{{ url()->secure('storage/'.$post->image) }}" width="100" alt="صورة {{ $post->title }}">
@endif
@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<button class="btn btn-success">تحديث</button>
</form>
@endsection
