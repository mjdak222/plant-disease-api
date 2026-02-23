<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة تحكم الأدمن')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --pg-bg: #0b1220;
            --pg-bg-soft: #111c31;
            --pg-panel: #111a2d;
            --pg-accent: #29d3ff;
            --pg-accent-2: #8f5bff;
            --pg-text: #e8efff;
            --pg-muted: #9eb1cf;
            --pg-danger: #ff5f8f;
        }

        body {
            background: radial-gradient(circle at top, #182746 0%, var(--pg-bg) 45%, #070b14 100%);
            color: var(--pg-text);
            min-height: 100vh;
        }

        .pg-shell {
            border: 1px solid rgba(143, 91, 255, 0.25);
            border-radius: 22px;
            background: linear-gradient(160deg, rgba(17, 28, 49, 0.92), rgba(12, 19, 33, 0.95));
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45);
            overflow: hidden;
        }

        .pg-navbar {
            background: linear-gradient(90deg, rgba(41, 211, 255, 0.16), rgba(143, 91, 255, 0.2));
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(6px);
        }

        .pg-brand {
            font-weight: 800;
            letter-spacing: .5px;
            color: #fff !important;
        }

        .pg-nav-btn {
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: var(--pg-text);
            background: rgba(255, 255, 255, 0.04);
            transition: .2s ease;
        }

        .pg-nav-btn:hover {
            border-color: rgba(41, 211, 255, 0.6);
            color: #fff;
            transform: translateY(-1px);
        }

        .pg-logout {
            border-radius: 999px;
            border: none;
            background: linear-gradient(120deg, #ff4b79, var(--pg-danger));
        }

        .pg-content {
            padding: 1.5rem;
        }

        .card, .table {
            border-radius: 16px;
            overflow: hidden;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(255,255,255,.03);
            --bs-table-color: var(--pg-text);
        }

        .table thead th {
            background: rgba(41, 211, 255, 0.08);
            border-bottom-color: rgba(255,255,255,.08);
        }

        .form-control, .form-select {
            background-color: rgba(255,255,255,.04);
            border-color: rgba(255,255,255,.15);
            color: var(--pg-text);
        }

        .form-control:focus, .form-select:focus {
            border-color: rgba(41,211,255,.6);
            box-shadow: 0 0 0 .2rem rgba(41,211,255,.16);
            background-color: rgba(255,255,255,.06);
            color: #fff;
        }

        .btn-primary {
            border: none;
            background: linear-gradient(120deg, var(--pg-accent), var(--pg-accent-2));
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="pg-shell">
        <nav class="navbar navbar-expand-lg pg-navbar">
            <div class="container-fluid px-4">
                <a class="navbar-brand pg-brand" href="{{ route('admin.dashboard') }}">Plant Disease • Admin</a>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('diseases.index') }}" class="btn btn-sm pg-nav-btn">الأمراض</a>
                    <a href="{{ route('posts.index') }}" class="btn btn-sm pg-nav-btn">البوستات</a>
                    <a href="{{ route('users.index') }}" class="btn btn-sm pg-nav-btn">المستخدمين</a>
                    <form action="{{ url('admin/logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm pg-logout">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </nav>

        <main class="pg-content">
            @yield('content')
        </main>
    </div>
</div>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
    @stack('toasts')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastElList = [].slice.call(document.querySelectorAll('.toast'));
        toastElList.map(function (toastEl) {
            const toast = new bootstrap.Toast(toastEl, {delay: 3000});
            toast.show();
        });
    });
</script>

</body>
</html>
