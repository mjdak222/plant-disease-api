<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول الأدمن</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="card shadow-lg border-0 rounded-4 p-4" style="width: 380px;">
    <div class="text-center mb-4">
        <i class="bi bi-shield-lock-fill text-primary" style="font-size: 3rem;"></i>
        <h4 class="mt-2 fw-bold">تسجيل دخول الأدمن</h4>
        <p class="text-muted small">أدخل بياناتك للمتابعة</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2 px-3 mb-3 rounded-3">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit', absolute: false) }}" novalidate>
        @csrf

        <!-- حقل الإيميل -->
        <div class="mb-3">
            <label class="form-label">الإيميل</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       required
                       autocomplete="username"
                       inputmode="email"
                       placeholder="example@mail.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- حقل كلمة المرور -->
        <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required
                       autocomplete="current-password"
                       minlength="8"
                       placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- زر الدخول -->
        <button class="btn btn-primary w-100 py-2 fw-semibold">
            <i class="bi bi-box-arrow-in-right me-1"></i> دخول
        </button>
    </form>
</div>

</body>
</html>
