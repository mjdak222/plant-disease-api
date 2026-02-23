<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الأدمن</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            background:
                radial-gradient(circle at 20% 20%, rgba(41, 211, 255, .2), transparent 35%),
                radial-gradient(circle at 80% 10%, rgba(143, 91, 255, .2), transparent 35%),
                linear-gradient(150deg, #0c1424, #060a12);
            color: #e8efff;
        }

        .panel {
            width: min(92vw, 420px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,.15);
            background: linear-gradient(160deg, rgba(20,31,53,.9), rgba(11,17,30,.95));
            box-shadow: 0 24px 55px rgba(0,0,0,.45);
            padding: 1.5rem;
        }

        .form-control {
            background: rgba(255,255,255,.04);
            border-color: rgba(255,255,255,.15);
            color: #fff;
        }

        .form-control:focus {
            background: rgba(255,255,255,.07);
            border-color: rgba(41,211,255,.6);
            box-shadow: 0 0 0 .2rem rgba(41,211,255,.2);
            color: #fff;
        }

        .btn-login {
            width: 100%;
            border: 0;
            border-radius: 999px;
            padding: .7rem;
            color: #fff;
            font-weight: 700;
            background: linear-gradient(120deg, #22d3ee, #8b5cf6);
        }
    </style>
</head>
<body>
<div class="panel">
    <div class="text-center mb-4">
        <h4 class="fw-bold mb-1">Admin Access</h4>
        <p class="text-secondary mb-0">سجّل دخولك للوصول للوحة التحكم</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit', absolute: false) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">الإيميل</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn-login">دخول</button>
    </form>

    <a href="{{ url('/') }}" class="btn btn-link text-info w-100 mt-2 text-decoration-none">العودة للرئيسية</a>
</div>
</body>
</html>
