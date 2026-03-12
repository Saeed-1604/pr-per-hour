<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>العملاء - لوحة التحكم</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: #f0f2f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h1 { color: #333; font-size: 24px; margin-bottom: 10px; }
        .back-link { color: #C4860B; text-decoration: none; font-size: 14px; }
        .back-link:hover { text-decoration: underline; }
        
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        th { background: #C4860B; color: white; padding: 15px; text-align: right; font-weight: 600; }
        td { padding: 15px; border-bottom: 1px solid #f0f0f0; }
        tr:hover { background: #f9f9f9; }
        
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; display: inline-block; }
        .badge-primary { background: #C4860B; color: white; }
        .badge-secondary { background: #e9ecef; color: #495057; }
        
        .empty { text-align: center; padding: 40px; color: #999; background: white; border-radius: 10px; }
        
        .pagination { margin-top: 20px; text-align: center; }
        .pagination a, .pagination span { display: inline-block; padding: 8px 12px; margin: 0 5px; border-radius: 5px; }
        .pagination a { background: #C4860B; color: white; text-decoration: none; }
        .pagination a:hover { background: #8B5D00; }
        .pagination .active { background: #333; color: white; }
        
        @media (max-width: 768px) {
            table { font-size: 12px; }
            th, td { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="{{ route('admin.dashboard') }}" class="back-link">← العودة إلى لوحة التحكم</a>
            <h1>قائمة العملاء</h1>
        </header>

        @if($customers->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>عدد الطلبات</th>
                        <th>عدد المحادثات</th>
                        <th>تاريخ الانضمام</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? '-' }}</td>
                            <td><span class="badge badge-primary">{{ $customer->orders_count }}</span></td>
                            <td><span class="badge badge-secondary">{{ $customer->chats_count }}</span></td>
                            <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $customers->links() }}
            </div>
        @else
            <div class="empty">
                <p>لا يوجد عملاء حتى الآن</p>
            </div>
        @endif
    </div>
</body>
</html>
