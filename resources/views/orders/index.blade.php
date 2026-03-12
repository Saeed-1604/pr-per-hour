<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلباتي</title>
    <style>
        body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f4f4f4;margin:0;padding:20px;}
        .container{max-width:900px;margin:0 auto;background:white;padding:30px;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        table{width:100%;border-collapse:collapse;}
        th,td{padding:12px;border-bottom:1px solid #f0f0f0;text-align:right;}
        th{background:#fafafa;color:#888;}
        .badge{padding:5px 12px;border-radius:20px;font-size:12px;font-weight:500;display:inline-block;}
        .badge-pending{background:#fff3cd;color:#856404;}
        .badge-under_review{background:#ffeeba;color:#856404;}
        .badge-paid{background:#d4edda;color:#155724;}
        .badge-in_progress{background:#cce5ff;color:#004085;}
        .badge-completed{background:#d4edda;color:#155724;}
        a.btn{background:#C4860B;color:white;padding:6px 12px;border-radius:5px;text-decoration:none;font-size:13px;}
        a.btn:hover{background:#B8860B;}
    </style>
</head>
<body>
    <div class="container">
        <h1>طلباتي</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الخدمة</th>
                    <th>الحالة</th>
                    <th>تاريخ الطلب</th>
                    <th>إجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->service->title }}</td>
                        <td><span class="badge badge-{{ str_replace(' ', '_', $order->status) }}">{{ ucfirst(str_replace('_',' ',$order->status)) }}</span></td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td><a class="btn" href="{{ route('orders.show', $order) }}">عرض</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>