<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الطلب #{{ $order->id }}</title>
    <style>
        body {font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f4f4f4;margin:0;padding:20px;}
        .navbar {background:linear-gradient(135deg,#C4860B 0%,#5D3406 100%);color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center;margin-bottom:40px;border-radius:10px;}
        .navbar .left {display:flex;align-items:center;gap:20px;}
        .navbar .logo {font-size:24px;font-weight:bold;}
        .navbar .logo-image {width:50px;height:50px;background:white;border-radius:5px;display:flex;align-items:center;justify-content:center;font-weight:bold;color:#C4860B;}
        .navbar a {color:white;text-decoration:none;margin-left:20px;}
        .navbar a:hover {text-decoration:underline;}
        .container{max-width:800px;margin:0 auto;background:white;padding:30px;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        h1{color:#C4860B;font-size:28px;margin-bottom:20px;text-align:center;}
        .section{margin-bottom:20px;}
        .section h2{color:#333;font-size:20px;margin-bottom:10px;}
        .section p{color:#555;line-height:1.6;}
        .badge{padding:5px 12px;border-radius:20px;font-size:12px;font-weight:500;display:inline-block;}
        .badge-pending{background:#fff3cd;color:#856404;}
        .badge-under_review{background:#ffeeba;color:#856404;}
        .badge-paid{background:#d4edda;color:#155724;}
        .badge-in_progress{background:#cce5ff;color:#004085;}
        .badge-completed{background:#d4edda;color:#155724;}
        .btn {background:#C4860B;color:white;padding:10px 20px;border-radius:5px;text-decoration:none;display:inline-block;}
    </style>
</head>
<body>
    <div class="navbar">
        <div class="left">
            <div class="logo-image">PR</div>
            <div class="logo">PR Per Hour</div>
        </div>
        <div>
            <a href="{{ route('my-orders') }}">طلباتي</a>
            <a href="{{ route('services') }}">الخدمات</a>
            <a href="#" onclick="document.getElementById('logout-form').submit(); return false;">تسجيل الخروج</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="container">
        <h1>تفاصيل الطلب #{{ $order->id }}</h1>
        <div class="section">
            <h2>الخدمة</h2>
            <p>{{ $order->service->title }}</p>
        </div>
        <div class="section">
            <h2>الحالة</h2>
            <p><span class="badge badge-{{ str_replace(' ', '_', $order->status) }}">{{ ucfirst(str_replace('_',' ',$order->status)) }}</span></p>
        </div>
        <div class="section">
            <h2>التفاصيل</h2>
            <p>{{ $order->details }}</p>
        </div>
        @if($order->meta)
            <div class="section">
                <h2>معلومات إضافية</h2>
                <pre>{{ json_encode($order->meta, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
            </div>
        @endif
        <div class="section">
            <a href="{{ route('orders.chat.show', $order) }}" class="btn" style="margin-bottom:20px;display:inline-block;">الدردشة مع الدعم</a>
        </div>
        @if($order->payment)
            <div class="section">
                <h2>الدفع</h2>
                <p>الطريقة: {{ $order->payment->method }}</p>
                <p>رقم الهاتف: {{ $order->payment->phone }}</p>
                <p>الحالة: {{ $order->payment->status }}</p>
                @if($order->payment->proof_path)
                    <p>الإيصال: <a href="{{ asset('storage/' . $order->payment->proof_path) }}" target="_blank">فتح</a></p>
                @endif
            </div>
        @endif
        @if($order->uploads->count())
            <div class="section">
                <h2>ملفات إضافية</h2>
                <ul>
                    @foreach($order->uploads as $upload)
                        <li><a href="{{ asset('storage/' . $upload->path) }}" target="_blank">{{ basename($upload->path) }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>