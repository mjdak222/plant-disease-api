<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Disease Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg: #070c17;
            --bg2: #111a2e;
            --accent: #22d3ee;
            --accent2: #a855f7;
            --text: #eaf2ff;
            --muted: #9eb0cf;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 20%, rgba(34, 211, 238, .2) 0%, transparent 35%),
                radial-gradient(circle at 85% 15%, rgba(168, 85, 247, .2) 0%, transparent 32%),
                linear-gradient(160deg, var(--bg2), var(--bg));
            color: var(--text);
        }

        .glass {
            background: linear-gradient(150deg, rgba(255,255,255,.08), rgba(255,255,255,.03));
            border: 1px solid rgba(255,255,255,.16);
            backdrop-filter: blur(8px);
            border-radius: 22px;
            box-shadow: 0 20px 50px rgba(0,0,0,.35);
        }

        .brand-pill {
            border: 1px solid rgba(34,211,238,.5);
            border-radius: 999px;
            display: inline-block;
            padding: .35rem .9rem;
            color: var(--accent);
            font-size: .85rem;
        }

        .hero-title {
            font-weight: 800;
            line-height: 1.2;
        }

        .hero-title .accent {
            background: linear-gradient(120deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .action-btn {
            border: 0;
            border-radius: 999px;
            padding: .75rem 1.4rem;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(120deg, var(--accent), var(--accent2));
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        .muted {
            color: var(--muted);
        }

        .mini-card {
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 14px;
            padding: 1rem;
            background: rgba(255,255,255,.02);
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <section class="glass p-4 p-md-5 mb-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <span class="brand-pill">PLANT DISEASE • SMART PLATFORM</span>
            <div class="d-flex gap-2">
                <a href="{{ url('/user/dashboard') }}" class="btn btn-outline-info btn-sm rounded-pill">واجهة المستخدم</a>
                <a href="{{ url('/admin/dashboard') }}" class="btn btn-outline-light btn-sm rounded-pill">واجهة الأدمن</a>
            </div>
        </div>

        <h1 class="hero-title mb-3">منصة تشخيص أمراض النبات
            <span class="accent d-block">بتصميم حديث وستايل احترافي</span>
        </h1>

        <p class="muted mb-4">الواجهة الآن أقرب لأسلوب المنصات التنافسية الداكنة: ألوان نيون، بطاقات زجاجية، وشعور dashboard حديث للمستخدم والأدمن.</p>

        <div class="d-flex flex-wrap gap-2">
            <a class="action-btn" href="{{ url('/user/dashboard') }}">ابدأ كمستخدم</a>
            <a class="action-btn" href="{{ url('/admin/login') }}" style="background: linear-gradient(120deg, #f43f5e, #8b5cf6);">دخول الأدمن</a>
        </div>
    </section>

    <section class="row g-3">
        <div class="col-md-4">
            <div class="mini-card">
                <h5>تشخيص سريع</h5>
                <p class="muted mb-0">رفع صورة النبات وإرسالها للنموذج لعرض اسم المرض ونسبة الثقة.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mini-card">
                <h5>نتائج عملية</h5>
                <p class="muted mb-0">عرض الأعراض والعلاج من قاعدة بيانات الأمراض بشكل واضح.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mini-card">
                <h5>لوحة إدارة</h5>
                <p class="muted mb-0">إدارة المحتوى والمستخدمين والأمراض من لوحة أدمن محسنة.</p>
            </div>
        </div>
    </section>
</div>
</body>
</html>
