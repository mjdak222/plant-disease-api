<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">لوحة التحكم</a>
        <div class="d-flex">
            <a href="{{ route('diseases.index') }}" class="btn btn-outline-light btn-sm me-2">الأمراض</a>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-light btn-sm me-2">البوستات</a>
            <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm me-2">المستخدمين</a>
            <form action="{{ url()->secure('admin/logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-danger btn-sm">تسجيل الخروج</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<!-- Toast Container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
    @stack('toasts')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    toastElList.map(function(toastEl) {
        var toast = new bootstrap.Toast(toastEl, { delay: 3000 })
        toast.show()
    })
});
</script>

</body>
</html>
