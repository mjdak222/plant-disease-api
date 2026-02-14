@extends('layouts.admin')

@section('content')
<h2>تعديل مرض</h2>

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

<form action="{{ route('diseases.update', $disease, true) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')

<div class="mb-3">
<label>الاسم</label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $disease->name) }}" required>
@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
<label>الأعراض</label>
<textarea name="symptoms" class="form-control @error('symptoms') is-invalid @enderror">{{ old('symptoms', $disease->symptoms) }}</textarea>
@error('symptoms')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
<label>العلاج</label>
<textarea name="treatment" class="form-control @error('treatment') is-invalid @enderror">{{ old('treatment', $disease->treatment) }}</textarea>
@error('treatment')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
<label>الصورة</label>
<input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
@if($disease->image)
<img src="{{ url()->secure('storage/'.$disease->image) }}" width="100" alt="صورة {{ $disease->name }}">
@endif
@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<button class="btn btn-success">تحديث</button>
</form>
@endsection
