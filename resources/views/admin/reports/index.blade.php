<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التقارير - لوحة التحكم</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: #f0f2f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h1 { color: #333; font-size: 24px; margin-bottom: 10px; }
        .back-link { color: #C4860B; text-decoration: none; font-size: 14px; }
        .back-link:hover { text-decoration: underline; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .stat-label { color: #888; font-size: 13px; margin-bottom: 10px; text-transform: uppercase; }
        .stat-value { color: #C4860B; font-size: 28px; font-weight: bold; }
        
        .report-section { background: white; padding: 25px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .section-title { color: #333; font-size: 18px; font-weight: 600; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0; }
        
        table { width: 100%; border-collapse: collapse; }
        th { text-align: right; padding: 12px 0; color: #888; font-size: 13px; font-weight: 500; border-bottom: 2px solid #f0f0f0; }
        td { padding: 15px 0; border-bottom: 1px solid #f0f0f0; }
        
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; display: inline-block; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-completed { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .badge-in-progress { background: #cfe2ff; color: #084298; }
        
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            table { font-size: 12px; }
            th, td { padding: 8px 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="{{ route('admin.dashboard') }}" class="back-link">← العودة إلى لوحة التحكم</a>
            <h1>التقارير والإحصائيات</h1>
        </header>

        <!-- بطاقات الإحصائيات -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">إجمالي الإيرادات</div>
                <div class="stat-value">${{ number_format($totalRevenue, 2) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">متوسط سعر الطلب</div>
                <div class="stat-value">${{ number_format($averageOrderPrice, 2) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">الطلبات هذا الشهر</div>
                <div class="stat-value">{{ $ordersThisMonth }}</div>
            </div>
        </div>

        <!-- توزيع الطلبات حسب الحالة -->
        <div class="report-section">
            <h2 class="section-title">توزيع الطلبات حسب الحالة</h2>
            <table>
                <thead>
                    <tr>
                        <th>الحالة</th>
                        <th>عدد الطلبات</th>
                        <th>النسبة المئوية</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalOrders = $ordersByStatus->sum('count');
                    @endphp
                    @foreach($ordersByStatus as $status)
                        @php
                            $percentage = $totalOrders > 0 ? ($status->count / $totalOrders * 100) : 0;
                            $statuses = [
                                'pending' => 'قيد الانتظار',
                                'under_review' => 'تحت المراجعة',
                                'in_progress' => 'قيد التنفيذ',
                                'completed' => 'مكتمل',
                                'cancelled' => 'ملغى'
                            ];
                            $statusName = $statuses[$status->status] ?? ucfirst(str_replace('_', ' ', $status->status));
                            $badgeClass = 'badge-' . str_replace('_', '-', $status->status);
                        @endphp
                        <tr>
                            <td><span class="badge {{ $badgeClass }}">{{ $statusName }}</span></td>
                            <td><strong>{{ $status->count }}</strong></td>
                            <td>{{ number_format($percentage, 1) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- أعلى العملاء -->
        <div class="report-section">
            <h2 class="section-title">أعلى 10 عملاء بعدد الطلبات</h2>
            @if($topCustomers->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>اسم العميل</th>
                            <th>البريد الإلكتروني</th>
                            <th>عدد الطلبات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topCustomers as $customer)
                            <tr>
                                <td>{{ $customer->user->first_name }} {{ $customer->user->last_name }}</td>
                                <td>{{ $customer->user->email }}</td>
                                <td><strong>{{ $customer->order_count }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; color: #999; padding: 20px;">لا توجد بيانات</p>
            @endif
        </div>

        <!-- أعلى الخدمات المطلوبة -->
        <div class="report-section">
            <h2 class="section-title">أعلى 10 خدمات مطلوبة</h2>
            @if($topServices->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>اسم الخدمة</th>
                            <th>عدد الطلبات</th>
                            <th>النسبة المئوية</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalServiceOrders = $topServices->sum('order_count');
                        @endphp
                        @foreach($topServices as $service)
                            @php
                                $percentage = $totalServiceOrders > 0 ? ($service->order_count / $totalServiceOrders * 100) : 0;
                            @endphp
                            <tr>
                                <td><strong>{{ $service->service->title }}</strong></td>
                                <td>{{ $service->order_count }}</td>
                                <td>{{ number_format($percentage, 1) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; color: #999; padding: 20px;">لا توجد بيانات</p>
            @endif
        </div>
    </div>
</body>
</html>
