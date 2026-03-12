<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR Per Hour | لوحة التحكم</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Tahoma', system-ui, sans-serif;
        }

        body {
            background: #f0f2f5;
            min-height: 100vh;
        }

        /* الحاوية الرئيسية */
        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* القائمة الجانبية */
        .sidebar {
            width: 220px;
            background: #1a1a1a;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        }

        /* منطقة الشعار */
        .logo-section {
            padding: 40px 20px;
            text-align: center;
            border-bottom: 1px solid #333;
            background: #0f0f0f;
        }

        .logo-section img {
            width: 160px;
            height: auto;
            margin-bottom: 15px;
            filter: drop-shadow(0 4px 8px rgba(212, 175, 55, 0.3));
        }

        .logo-section h1 {
            color: #C4860B;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 2px;
            margin: 10px 0 5px;
        }

        .logo-section p {
            color: #888;
            font-size: 12px;
            letter-spacing: 1px;
        }

        /* عناصر القائمة */
        .nav-menu {
            flex: 1;
            padding: 20px 0;
        }

        .nav-item {
            display: block;
            padding: 14px 25px;
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            border-right: 3px solid transparent;
            margin: 5px 0;
        }

        .nav-item:hover {
            background: #2a2a2a;
            color: #C4860B;
            border-right-color: #C4860B;
        }

        .nav-item.active {
            background: #2a2a2a;
            color: #C4860B;
            border-right-color: #C4860B;
        }

        /* معلومات المدير */
        .admin-footer {
            padding: 20px;
            border-top: 1px solid #333;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #0f0f0f;
        }

        .admin-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #C4860B, #8B5D00);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .admin-info h4 {
            color: white;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .admin-info span {
            color: #C4860B;
            font-size: 12px;
        }

        /* المحتوى الرئيسي */
        .main-content {
            flex: 1;
            margin-right: 220px;
            padding: 30px;
        }

        /* شريط العلوي */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .page-title h2 {
            color: #333;
            font-size: 22px;
            font-weight: 600;
        }

        .page-title p {
            color: #888;
            font-size: 13px;
            margin-top: 5px;
        }

        .date-badge {
            background: #fff9e6;
            color: #8B5D00;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            border: 1px solid #C4860B;
        }

        /* أيقونة الإعدادات */
        .settings-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #C4860B, #8B5D00);
            border-radius: 8px;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 20px;
        }

        .settings-icon:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(196, 134, 11, 0.3);
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* بطاقات الإحصائيات */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(196, 134, 11, 0.2);
        }

        .stat-label {
            color: #888;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-number {
            color: #333;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .stat-trend {
            color: #28a745;
            font-size: 13px;
        }

        .stat-trend.down {
            color: #dc3545;
        }

        /* شبكة المحتوى */
        .content-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 25px;
        }

        /* بطاقات */
        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header h3 {
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }

        .card-header a {
            color: #8B5D00;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }

        .card-header a:hover {
            text-decoration: underline;
        }

        /* جدول الطلبات */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            text-align: right;
            padding: 12px 0;
            color: #888;
            font-size: 13px;
            font-weight: 500;
            border-bottom: 2px solid #f0f0f0;
        }

        .orders-table td {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .customer-info h4 {
            color: #333;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .customer-info p {
            color: #888;
            font-size: 12px;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-active {
            background: #d4edda;
            color: #155724;
        }

        .badge-completed {
            background: #e2e3e5;
            color: #383d41;
        }

        .action-link {
            color: #8B5D00;
            text-decoration: none;
            font-size: 13px;
        }

        /* قائمة المحادثات */
        .chat-list {
            list-style: none;
        }

        .chat-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .chat-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #C4860B;
            font-weight: bold;
            font-size: 18px;
        }

        .chat-details {
            flex: 1;
        }

        .chat-details h4 {
            color: #333;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .chat-details p {
            color: #888;
            font-size: 12px;
        }

        .chat-meta {
            text-align: left;
        }

        .chat-badge {
            background: #C4860B;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            display: inline-block;
        }

        .chat-time {
            color: #888;
            font-size: 11px;
            display: block;
            margin-top: 5px;
        }

        @media (max-width: 1200px) {
            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }
            .settings-icon {
                width: 36px;
                height: 36px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-right: 200px;
            }
            .content-grid {
                grid-template-columns: 1fr;
            }
            .settings-icon svg {
                width: 18px;
                height: 18px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(100%);
                z-index: 1000;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-right: 0;
            }
            .stats-cards {
                grid-template-columns: 1fr;
            }
            .top-bar {
                flex-direction: column;
                gap: 15px;
            }
            .top-bar-right {
                justify-content: space-between;
                width: 100%;
            }
            .settings-icon {
                width: 38px;
                height: 38px;
            }
        }
    </style>
</head>
<body>
    @php use Illuminate\Support\Str; @endphp
    <div class="dashboard">
        <!-- القائمة الجانبية -->
        <div class="sidebar">
            <div class="logo-section">
                <img src="{{ asset('images/logo.png') }}" alt="PR Per Hour">
                <h1>PR PER HOUR</h1>
                <p>Making Every Hour Count</p>
            </div>

            <div class="nav-menu">
                <a href="{{ route('admin.dashboard') }}" class="nav-item active">الرئيسية</a>
                <a href="{{ route('admin.orders') }}" class="nav-item">الطلبات</a>
                <a href="{{ route('admin.customers') }}" class="nav-item">العملاء</a>
                <a href="{{ route('admin.services') }}" class="nav-item">الخدمات</a>
                <a href="{{ route('admin.chats') }}" class="nav-item">المحادثات</a>
                <a href="{{ route('admin.reports') }}" class="nav-item">التقارير</a>
                <a href="{{ route('admin.settings') }}" class="nav-item">الإعدادات</a>
            </div>

            <div class="admin-footer">
                <div class="admin-avatar">PR</div>
                <div class="admin-info">
                    <h4>إدارة النظام</h4>
                    <span>مشرف</span>
                </div>
            </div>
        </div>

        <!-- المحتوى الرئيسي -->
        <div class="main-content">
            <!-- الشريط العلوي -->
            <div class="top-bar">
                <div class="page-title">
                    <h2>مرحباً بك في لوحة التحكم</h2>
                    <p>آخر تحديث: {{ $arabicDate }}</p>
                </div>
                <div class="top-bar-right">
                    <div class="date-badge">
                        {{ $now->format('d/m/Y') }}
                    </div>
                    <a href="{{ route('admin.settings') }}" class="settings-icon" title="الإعدادات">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m3.08 3.08l4.24 4.24M1 12h6m6 0h6m-17.78 7.78l4.24-4.24m3.08-3.08l4.24-4.24"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- بطاقات الإحصائيات -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-label">إجمالي الطلبات</div>
                    <div class="stat-number">{{ $totalOrders }}</div>
                    <div class="stat-trend">{{ $newOrders }} جديدة</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">العملاء</div>
                    <div class="stat-number">{{ $customers }}</div>
                    <div class="stat-trend">عدد العملاء</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">محادثات</div>
                    <div class="stat-number">{{ $activeChats }}</div>
                    <div class="stat-trend">نشطة حالياً</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">رسائل جديدة</div>
                    <div class="stat-number">{{ $unreadMessages }}</div>
                    <div class="stat-trend">رسائل لم تُقرأ</div>
                </div>
            </div>

            <!-- شبكة المحتوى -->
            <div class="content-grid">
                <!-- الطلبات الأخيرة -->
                <div class="card">
                    <div class="card-header">
                        <h3>أحدث الطلبات</h3>
                        <a href="{{ route('admin.orders') }}">عرض جميع الطلبات</a>
                    </div>

                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>العميل</th>
                                <th>الخدمة</th>
                                <th>الحالة</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                @foreach($latestOrders as $order)
                    <tr>
                        <td>
                            <div class="customer-info">
                                <h4>{{ $order->user->first_name }} {{ $order->user->last_name }}</h4>
                                <p>{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                        </td>
                        <td>{{ $order->service->title }}</td>
                        <td><span class="badge badge-{{ str_replace(' ', '_', $order->status) }}">{{ ucfirst(str_replace('_',' ',$order->status)) }}</span></td>
                        <td><a href="{{ route('orders.show', $order) }}" class="action-link" target="_blank">عرض</a></td>
                    </tr>
                @endforeach
            </tbody>
                    </table>
                </div>

                <!-- المحادثات النشطة -->
                <div class="card">
                    <div class="card-header">
                        <h3>المحادثات النشطة</h3>
                        <a href="{{ route('admin.chats') }}">عرض الكل</a>
                    </div>

                    <ul class="chat-list">
                    @foreach($latestChats as $chat)
                        <li class="chat-item">
                            <a href="{{ route('orders.chat.show', $chat->order) }}" style="display:flex;align-items:center;text-decoration:none;color:inherit;">
                                <div class="chat-avatar">{{ strtoupper(substr($chat->user->first_name,0,1)) }}</div>
                                <div class="chat-details">
                                    <h4>{{ $chat->user->first_name }} {{ $chat->user->last_name }}</h4>
                                    <p>{{ Str::limit($chat->message, 40) }}</p>
                                </div>
                                <div class="chat-meta">
                                    <span class="chat-badge">{{ $chat->order->service->title }}</span>
                                    <span class="chat-time">{{ $chat->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>

                <!-- التقارير (رسائل الاتصال) -->
                <div class="card">
                    <div class="card-header">
                        <h3>التقارير (رسائل الاتصال)</h3>
                        <a href="{{ route('admin.messages') }}">عرض جميع الرسائل</a>
                    </div>

                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>المرسل</th>
                                <th>الموضوع</th>
                                <th>البريد الإلكتروني</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestMessages as $message)
                                <tr>
                                    <td>
                                        <div class="customer-info">
                                            <h4>{{ $message->name }}</h4>
                                            <p>{{ $message->created_at->diffForHumans() }}</p>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($message->subject, 30) }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>
                                        <span class="badge" style="background: {{ $message->status === 'unread' ? '#fff3cd' : '#e8f5e9' }}; color: {{ $message->status === 'unread' ? '#856404' : '#2e7d32' }};">
                                            {{ $message->status === 'unread' ? 'لم تُقرأ' : 'مقروءة' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 20px; color: #999;">لا توجد رسائل حتى الآن</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
