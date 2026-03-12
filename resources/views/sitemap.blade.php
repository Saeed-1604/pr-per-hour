<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خريطة الموقع - PR Per Hour</title>
    <style>
        body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f4f4f4;margin:0;padding:20px;direction:rtl;}
        .container{max-width:900px;margin:0 auto;background:white;padding:40px;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        h1{color:#C4860B;margin-bottom:30px;text-align:center;font-size:36px;}
        .sitemap-section{margin-bottom:30px;}
        .sitemap-section h2{color:#333;margin-bottom:15px;padding-bottom:10px;border-bottom:2px solid #C4860B;}
        .sitemap-section ul{list-style:none;padding:0;margin:0;}
        .sitemap-section li{margin:8px 0;}
        .sitemap-section a{color:#C4860B;text-decoration:none;font-weight:500;}
        .sitemap-section a:hover{text-decoration:underline;}
    </style>
</head>
<body>
    <div class="container">
        <h1>خريطة الموقع</h1>

        <div class="sitemap-section">
            <h2>الصفحات الرئيسية</h2>
            <ul>
                <li><a href="{{ route('home') }}">الصفحة الرئيسية</a></li>
                <li><a href="{{ route('about') }}">من نحن</a></li>
                <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
                <li><a href="{{ route('faq') }}">الأسئلة الشائعة</a></li>
            </ul>
        </div>

        <div class="sitemap-section">
            <h2>الخدمات</h2>
            <ul>
                <li><a href="{{ route('service.show', 'consultation') }}">استشارة سريعة</a></li>
                <li><a href="{{ route('service.show', 'starter-content-package') }}">حزمة المحتوى الأساسية</a></li>
                <li><a href="{{ route('service.show', 'growth-content-strategy') }}">استراتيجية النمو</a></li>
                <li><a href="{{ route('service.show', 'pr-core') }}">PR Core™</a></li>
                <li><a href="{{ route('service.show', 'celebrity-builder') }}">Celebrity Builder™</a></li>
                <li><a href="{{ route('service.show', 'ad-account-rescue') }}">Ad Account Rescue™</a></li>
                <li><a href="{{ route('service.show', 'creative-advertising') }}">الحلول الإعلانية الإبداعية</a></li>
            </ul>
        </div>

        <div class="sitemap-section">
            <h2>حساب العضو</h2>
            <ul>
                <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
                <li><a href="{{ route('register') }}">إنشاء حساب جديد</a></li>
            </ul>
        </div>

        <div class="sitemap-section">
            <h2>السياسات والشروط</h2>
            <ul>
                <li><a href="{{ route('terms') }}">الشروط والأحكام</a></li>
                <li><a href="{{ route('privacy') }}">سياسة الخصوصية</a></li>
            </ul>
        </div>

        <div style="margin-top:40px;padding:20px;background:#f0f0f0;border-radius:10px;text-align:center;">
            <p style="color:#666;">خريطة الموقع تساعدك في العثور على ما تبحث عنه بسهولة</p>
        </div>
    </div>
</body>
</html>