<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR Per Hour - Making Every Hour Count</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            color: #333;
            direction: rtl;
        }
        
        /* Navigation */
        nav {
            background: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #C4860B;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo-image {
            width: 40px;
            height: 40px;
            background: #C4860B;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        nav a {
            color: #333;
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s;
        }
        
        nav a:hover {
            color: #C4860B;
        }
        
        .nav-buttons {
            display: flex;
            gap: 15px;
        }
        
        .nav-btn {
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.3s;
            border: 2px solid #C4860B;
            color: #C4860B;
        }
        
        .nav-btn.primary {
            background: #C4860B;
            color: white;
        }
        
        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(196, 134, 11, 0.3);
        }
        
        /* Hero Section */
        .hero {
            text-align: center;
            padding: 100px 40px;
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
        }
        
        .hero img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        
        .hero h1 {
            font-size: 48px;
            color: #C4860B;
            margin: 20px 0;
            font-weight: bold;
        }
        
        .tagline {
            font-size: 24px;
            color: #996515;
            margin-bottom: 20px;
        }
        
        .hero-description {
            font-size: 18px;
            line-height: 1.8;
            color: #555;
            max-width: 600px;
            margin: 0 auto 40px;
        }
        
        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .hero-btn {
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s;
            display: inline-block;
            border: 2px solid #C4860B;
        }
        
        .hero-btn.primary {
            background: #C4860B;
            color: white;
        }
        
        .hero-btn.secondary {
            color: #C4860B;
            background: white;
        }
        
        .hero-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(196, 134, 11, 0.3);
        }
        
        /* Features Section */
        .features {
            padding: 60px 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .features h2 {
            text-align: center;
            font-size: 36px;
            color: #C4860B;
            margin-bottom: 50px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .feature-card {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s;
            border-top: 4px solid #C4860B;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .feature-card h3 {
            color: #333;
            margin: 15px 0 10px;
            font-size: 20px;
        }
        
        .feature-card p {
            color: #666;
            line-height: 1.6;
        }
        
        /* Footer */
        footer {
            background: #333;
            color: white;
            padding: 40px;
            text-align: center;
            margin-top: 60px;
        }
        
        footer a {
            color: #C4860B;
            text-decoration: none;
        }
        
        footer a:hover {
            text-decoration: underline;
        }
        
        .footer-links {
            margin-bottom: 20px;
        }
        
        .footer-links a {
            margin: 0 20px;
            display: inline-block;
        }
        
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 20px;
            }
            
            .nav-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .hero {
                padding: 60px 20px;
            }
            
            .hero h1 {
                font-size: 32px;
            }
            
            .tagline {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">
            <div class="logo-image">PR</div>
            PR Per Hour
        </div>
        <div>
            @auth
                <a href="{{ route('services') }}">الخدمات</a>
                <a href="{{ route('my-orders') }}">طلباتي</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل خروج</a>
            @endauth
        </div>
        @guest
            <div class="nav-buttons">
                <a href="{{ route('login') }}" class="nav-btn">تسجيل دخول</a>
                <a href="{{ route('register') }}" class="nav-btn primary">تسجيل جديد</a>
            </div>
        @endguest
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Hero Section -->
    <div class="hero">
        <img src="{{ asset('images/logo.png') }}" alt="PR Per Hour Logo">
        <h1>PR Per Hour</h1>
        <div class="tagline">Making Every Hour Count</div>
        <p class="hero-description">
            خدمات استشارية متكاملة في العلاقات العامة وإدارة السمعة الرقمية. 
            نحن هنا لجعل كل ساعة تستحق القيمة الحقيقية.
        </p>
        <div class="hero-buttons">
            @guest
                <a href="{{ route('register') }}" class="hero-btn primary">ابدأ الآن</a>
                <a href="#features" class="hero-btn secondary">اكتشف خدماتنا</a>
            @else
                <a href="{{ route('services') }}" class="hero-btn primary">احجز خدمتك</a>
                <a href="{{ route('my-orders') }}" class="hero-btn secondary">طلباتي</a>
            @endauth
        </div>
    </div>

    <!-- Features Section -->
    <div class="features" id="features">
        <h2>لماذا تختار PR Per Hour؟</h2>
        <div class="features-grid">
            <div class="feature-card">
                <h3>سرعة</h3>
                <p>نلتزم بمواعيد واضحة وسريعة. وقتك ثمين والمواعيد التي نحددها ملزمة.</p>
            </div>
            <div class="feature-card">
                <h3>احترافية</h3>
                <p>كل عضو في فريقنا متخصص وذو خبرة عميقة في مجاله.</p>
            </div>
            <div class="feature-card">
                <h3>نتائج مثبتة</h3>
                <p>عملنا مع عشرات العملاء وحققنا نتائج حقيقية وملموسة.</p>
            </div>
            <div class="feature-card">
                <h3>أسعار منطقية</h3>
                <p>نقدم أفضل قيمة مقابل أسعار منطقية وشفافة.</p>
            </div>
            <div class="feature-card">
                <h3>ابتكار</h3>
                <p>لا نتبع الطرق التقليدية. نبحث دائماً عن حلول إبداعية فعالة.</p>
            </div>
            <div class="feature-card">
                <h3>شفافية</h3>
                <p>نتواصل باستمرار مع عملائنا ونشرح كل خطوة من خطوات العمل.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="{{ route('about') }}">من نحن</a>
            <a href="{{ route('contact') }}">اتصل بنا</a>
            <a href="{{ route('faq') }}">الأسئلة الشائعة</a>
            <a href="{{ route('terms') }}">الشروط والأحكام</a>
        </div>
        <p>&copy; 2024 PR Per Hour by Dr. Fatana Maali. All rights reserved.</p>
        <p style="margin-top: 10px; font-size: 14px; color: #999;">Making Every Hour Count</p>
    </footer>
</body>
</html>
