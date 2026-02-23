<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>واجهة المستخدم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(160deg, #0a1222, #050910);
            color: #ecf3ff;
        }

        .top-wrap {
            border-bottom: 1px solid rgba(255,255,255,.08);
            background: rgba(255,255,255,.03);
            backdrop-filter: blur(4px);
        }

        .panel {
            background: linear-gradient(160deg, rgba(19, 30, 52, .9), rgba(9, 14, 24, .95));
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 18px;
            padding: 1.2rem;
            box-shadow: 0 18px 40px rgba(0,0,0,.35);
            height: 100%;
        }

        .stat {
            font-size: 1.8rem;
            font-weight: 800;
            color: #22d3ee;
        }

        .muted { color: #9eb1cf; }

        .cta {
            border: 0;
            border-radius: 999px;
            padding: .7rem 1.2rem;
            color: white;
            text-decoration: none;
            font-weight: 600;
            background: linear-gradient(120deg, #22d3ee, #8b5cf6);
        }
    </style>
</head>
<body>
    <header class="top-wrap py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center gap-2 flex-wrap">
            <h4 class="mb-0">واجهة المستخدم</h4>
            <div class="d-flex gap-2">
                <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm rounded-pill">الرئيسية</a>
                <a href="{{ url('/admin/dashboard') }}" class="btn btn-outline-info btn-sm rounded-pill">لوحة الأدمن</a>
            </div>
        </div>
    </header>

    <main class="container pb-5">
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <div class="panel">
                    <div class="stat">01</div>
                    <h5>ارفع صورة النبات</h5>
                    <p class="muted mb-0">ابدأ التشخيص من خلال صورة واضحة للورقة/الثمرة.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel">
                    <div class="stat">02</div>
                    <h5>شاهد نتيجة الذكاء الاصطناعي</h5>
                    <p class="muted mb-0">اسم المرض + نسبة الثقة + بيانات العلاج المقترح.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel">
                    <div class="stat">03</div>
                    <h5>تابع المحتوى</h5>
                    <p class="muted mb-0">اقرأ البوستات والتعليقات المفيدة من المجتمع الزراعي.</p>
                </div>
            </div>
        </div>

        <div class="panel">
            <h5 class="mb-2">تجربة المستخدم (ستايل حديث)</h5>
            <p class="muted">تم تجهيز واجهة مستخدم بطابع مشابه لمنصات الألعاب الحديثة: خلفية داكنة، تباين عالي، بطاقات واضحة، وأزرار CTA بارزة.</p>
            <a href="{{ url('/api/posts') }}" class="cta">عرض API البوستات</a>
        </div>
    </main>
</body>
</html>
