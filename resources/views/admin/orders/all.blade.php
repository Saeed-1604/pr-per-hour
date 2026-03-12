<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جميع الطلبات - لوحة التحكم</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: #f0f2f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h1 { color: #333; font-size: 24px; margin-bottom: 10px; }
        .back-link { color: #C4860B; text-decoration: none; font-size: 14px; }
        .back-link:hover { text-decoration: underline; }
        
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        th { background: #C4860B; color: white; padding: 15px; text-align: right; }
        td { padding: 15px; border-bottom: 1px solid #f0f0f0; }
        tbody tr:hover { background: #f9f9f9; }
        
        .customer { color: #333; font-weight: 500; }
        .meta { color: #888; font-size: 12px; margin-top: 5px; }
        
        .status-form { display: flex; gap: 5px; }
        .status-form select { padding: 5px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 12px; }
        .status-form button { background: #C4860B; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; font-size: 12px; }
        .status-form button:hover { background: #8B5D00; }
        
        .badge { display: inline-block; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-under_review { background: #e3f2fd; color: #1565c0; }
        .badge-in_progress { background: #f3e5f5; color: #6a1b9a; }
        .badge-completed { background: #e8f5e9; color: #2e7d32; }
        .badge-cancelled { background: #ffebee; color: #c62828; }
        
        .pagination { margin-top: 20px; text-align: center; }
        .pagination a, .pagination span { display: inline-block; padding: 8px 12px; margin: 0 5px; border-radius: 5px; }
        .pagination a { background: #C4860B; color: white; text-decoration: none; }
        .pagination a:hover { background: #8B5D00; }
        .pagination .active { background: #333; color: white; }
        
        .empty { text-align: center; padding: 40px; color: #999; }
        
        @media (max-width: 768px) {
            table { font-size: 12px; }
            th, td { padding: 10px; }
            .status-form { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="{{ route('admin.dashboard') }}" class="back-link">← العودة إلى لوحة التحكم</a>
            <h1>جميع الطلبات</h1>
        </header>

        @if($orders->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>العميل</th>
                        <th>الخدمة</th>
                        <th>الحالة الحالية</th>
                        <th>تغيير الحالة</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <div class="customer">{{ $order->user->first_name }} {{ $order->user->last_name }}</div>
                                <div class="meta">{{ $order->user->email }}</div>
                            </td>
                            <td>{{ $order->service->title }}</td>
                            <td><span class="badge badge-{{ $order->status }}">
                                @if($order->status === 'pending') قيد الانتظار
                                @elseif($order->status === 'under_review') تحت المراجعة
                                @elseif($order->status === 'in_progress') جاري التنفيذ
                                @elseif($order->status === 'completed') مكتمل
                                @else ملغى
                                @endif
                            </span></td>
                            <td>
                                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="status-form">
                                    @csrf
                                    <select name="status">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                        <option value="under_review" {{ $order->status === 'under_review' ? 'selected' : '' }}>تحت المراجعة</option>
                                        <option value="in_progress" {{ $order->status === 'in_progress' ? 'selected' : '' }}>جاري التنفيذ</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>مكتمل</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>ملغى</option>
                                    </select>
                                    <button type="submit">تحديث</button>
                                </form>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $orders->links() }}
            </div>
        @else
            <div class="empty">
                <p>لا توجد طلبات حتى الآن</p>
            </div>
        @endif
    </div>
</body>
</html>
