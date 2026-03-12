<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خدماتنا - PR Per Hour</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .navbar {
            background: linear-gradient(135deg, #C4860B 0%, #5D3406 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-radius: 10px;
        }
        .navbar .left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .navbar .logo-image img {
            height: 60px;  /* شعار كبير */
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }
        .navbar .right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .my-orders-box {
            background: rgba(255,255,255,0.2);
            padding: 10px 15px;
            border-radius: 5px;
            min-width:120px;
        }
        .my-orders-box a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 5px 0;
            font-size: 14px;
        }
        .my-orders-box a:hover {
            text-decoration: underline;
        }
        .my-orders-label {
            font-size: 12px;
            color: rgba(255,255,255,0.8);
            margin-bottom: 5px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 40px;
            font-size: 36px;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }
        .service-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-top: 5px solid #C4860B;
            transition: transform 0.3s;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.2);
        }
        .service-card h3 {
            color: #C4860B;
            margin-top: 0;
            font-size: 24px;
            margin-bottom: 15px;
        }
        .service-card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .service-price {
            font-size: 20px;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn {
            background: #C4860B;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background: #8B5D00;
        }
        .footer {
            text-align: center;
            color: #888;
            margin-top: 50px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="left">
            <div class="logo-image">
                <img src="{{ asset('images/logo.png') }}" alt="PR Per Hour">
            </div>
        </div>
        <div class="right">
            @auth
                <div class="my-orders-box">
                    <div class="my-orders-label">طلباتي</div>
                    <a href="{{ route('my-orders') }}">عرض الطلبات</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="document.getElementById('logout-form').submit(); return false;" style="color:white;text-decoration:none;">تسجيل الخروج</a>
            @else
                <a href="{{ route('login') }}" style="color:white;text-decoration:none;">دخول</a>
                <a href="{{ route('register') }}" style="color:white;text-decoration:none;">إنشاء حساب</a>
            @endauth
        </div>
    </div>

    <div class="container">
        <h1>خدماتنا</h1>

        @if($services->isEmpty())
            <p style="text-align:center; color:#666;">لا توجد خدمات متاحة حالياً.</p>
        @else
            <div class="services-grid">
                @foreach($services as $service)
                    <div class="service-card">
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->intro }}</p>
                        <div class="service-price">{{ $service->price }}</div>
                        <a href="{{ route('service.show', $service->slug) }}" class="btn">اطلب الآن</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="footer">
        © 2026 PR Per Hour - Making Every Hour Count
    </div>
</body>
</html>
