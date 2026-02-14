@extends('layouts.admin')

@section('content')
<h2>إضافة بوست</h2>

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

<form action="{{ route('posts.store', [], true) }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
<label>العنوان</label>
<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
<label>المحتوى</label>
<textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content') }}</textarea>
@error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
<label>الصورة</label>
<input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<button class="btn btn-success">إضافة</button>
</form>
@endsection
