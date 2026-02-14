@extends('layouts.admin')

@section('content')
<h2>المستخدمين</h2>

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
            <th>الإيميل</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form action="{{ route('users.destroy', [$user], true) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
