<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلباتي - PR Per Hour</title>
    <style>
        body {font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f4f4f4;margin:0;padding:20px;}
        .navbar {background:linear-gradient(135deg,#C4860B 0%,#5D3406 100%);color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center;margin-bottom:40px;border-radius:10px;}
        .navbar .left {display:flex;align-items:center;gap:20px;}
        .navbar .logo {font-size:24px;font-weight:bold;}
        .navbar .logo-image {width:50px;height:50px;background:white;border-radius:5px;display:flex;align-items:center;justify-content:center;font-weight:bold;color:#C4860B;}
        .navbar a {color:white;text-decoration:none;margin-left:20px;}
        .navbar a:hover {text-decoration:underline;}
        .container {max-width:1200px;margin:0 auto;}
        h1 {color:#C4860B;margin-bottom:30px;}
        .orders-table {width:100%;background:white;border-collapse:collapse;border-radius:10px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,0.1);}
        .orders-table th {background:#C4860B;color:white;padding:15px;text-align:right;border-bottom:2px solid #f0f0f0;}
        .orders-table td {padding:15px;text-align:right;border-bottom:1px solid #f0f0f0;}
        .orders-table tbody tr:hover {background:#f9f9f9;}
        .badge {padding:5px 10px;border-radius:5px;font-size:12px;font-weight:bold;}
        .badge-pending {background:#fff3cd;color:#856404;}
        .badge-under_review {background:#e3f2fd;color:#1565c0;}
        .badge-in_progress {background:#f3e5f5;color:#6a1b9a;}
        .badge-completed {background:#e8f5e9;color:#2e7d32;}
        .badge-cancelled {background:#ffebee;color:#c62828;}
        a {color:#C4860B;text-decoration:none;font-weight:bold;margin:0 5px;}
        a:hover {text-decoration:underline;}
        .empty-state {background:white;padding:40px;border-radius:10px;text-align:center;box-shadow:0 2px 10px rgba(0,0,0,0.1);}
        .btn {background:#C4860B;color:white;padding:10px 30px;border-radius:5px;text-decoration:none;display:inline-block;}
    </style>
</head>
<body>
    <div class="navbar">
        <div class="left">
            <div class="logo-image">PR</div>
            <div class="logo">PR Per Hour</div>
        </div>
        <div>
            <a href="{{ route('services') }}">الخدمات</a>
            <a href="#" onclick="document.getElementById('logout-form').submit(); return false;">تسجيل الخروج</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="container">
        <h1>طلباتي</h1>

        @if($orders->count() > 0)
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>الخدمة</th>
                        <th>المبلغ</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->service->title }}</td>
                            <td>${{ $order->service->price }}</td>
                            <td>
                                <span class="badge badge-{{ $order->status }}">
                                    @if($order->status === 'pending') قيد الانتظار
                                    @elseif($order->status === 'under_review') تحت المراجعة
                                    @elseif($order->status === 'in_progress') جاري العمل
                                    @elseif($order->status === 'completed') مكتمل
                                    @else ملغى
                                    @endif
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order) }}">عرض</a>
                                @if($order->status !== 'completed' && !$order->payment)
                                    <a href="{{ route('payment.form', $order) }}" style="color:#2e7d32;">دفع</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <p style="color:#666;margin-bottom:20px;">لا توجد طلبات حتى الآن</p>
                <a href="{{ route('services') }}" class="btn">استكشف خدماتنا</a>
            </div>
        @endif
    </div>
</body>
</html>