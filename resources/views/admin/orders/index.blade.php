<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلباتي - لوحة التحكم</title>
    <style>
        body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f0f2f5;margin:0;padding:20px;}
        .container{max-width:1200px;margin:0 auto;}
        table{width:100%;border-collapse:collapse;background:white;}
        th,td{padding:12px;border-bottom:1px solid #f0f0f0;text-align:right;}
        th{background:#fafafa;color:#888;font-weight:500;}
        .badge{padding:5px 12px;border-radius:20px;font-size:12px;font-weight:500;display:inline-block;}
        .badge-pending{background:#fff3cd;color:#856404;}
        .badge-under_review{background:#ffeeba;color:#856404;}
        .badge-paid{background:#d4edda;color:#155724;}
        .badge-in_progress{background:#cce5ff;color:#004085;}
        .badge-completed{background:#d4edda;color:#155724;}
        .status-form{display:inline;}
        .status-form select{padding:4px 8px;border:1px solid #ddd;border-radius:4px;}
        .status-form button{background:#C4860B;color:white;padding:4px 8px;border:none;border-radius:4px;cursor:pointer;}
        .status-form button:hover{background:#B8860B;}
    </style>
</head>
<body>
    <div class="container">
        <h1>جميع الطلبات</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العميل</th>
                    <th>الخدمة</th>
                    <th>الحالة</th>
                    <th>تاريخ</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>
                            <strong>{{ $order->user->full_name }}</strong><br>
                            <small>{{ $order->user->email }}</small>
                        </td>
                        <td>{{ $order->service->title }}</td>
                        <td><span class="badge badge-{{ str_replace(' ', '_', $order->status) }}">{{ ucfirst(str_replace('_',' ',$order->status)) }}</span></td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" target="_blank">عرض</a>
                            <form class="status-form" method="POST" action="{{ route('admin.orders.status', $order) }}">
                                @csrf
                                <select name="status" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status=='pending'?'selected':'' }}>قيد المراجعة</option>
                                    <option value="under_review" {{ $order->status=='under_review'?'selected':'' }}>تحت المراجعة</option>
                                    <option value="paid" {{ $order->status=='paid'?'selected':'' }}>تم الدفع</option>
                                    <option value="in_progress" {{ $order->status=='in_progress'?'selected':'' }}>جاري التنفيذ</option>
                                    <option value="completed" {{ $order->status=='completed'?'selected':'' }}>مكتمل</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>