@extends('layouts.admin')

@section('content')
<h2>الأمراض</h2>
<a href="{{ route('diseases.create', [], true) }}" class="btn btn-primary mb-3">إضافة مرض</a>

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
            <th>الاسم</th>
            <th>الأعراض</th>
            <th>العلاج</th>
            <th>صورة</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($diseases as $disease)
        <tr>
            <td>{{ $disease->name }}</td>
            <td>{{ $disease->symptoms }}</td>
            <td>{{ $disease->treatment }}</td>
            <td>
                @if($disease->image)
                    <img src="{{ url()->secure('storage/'.$disease->image) }}" width="50" alt="صورة {{ $disease->name }}">
                @endif
            </td>
            <td>
                <a href="{{ route('diseases.edit', [$disease], true) }}" class="btn btn-warning btn-sm">تعديل</a>
                <form action="{{ route('diseases.destroy', [$disease], true) }}" method="POST" style="display:inline-block;">
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
