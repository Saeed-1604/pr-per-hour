<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جميع الرسائل - لوحة التحكم</title>
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
        
        .status-unread { background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 5px; font-size: 12px; display: inline-block; }
        .status-read { background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 5px; font-size: 12px; display: inline-block; }
        
        .message-preview { color: #666; font-size: 13px; max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        .actions { display: flex; gap: 10px; }
        .btn { padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 12px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #C4860B; color: white; }
        .btn-primary:hover { background: #8B5D00; }
        .btn-secondary { background: #f0f0f0; color: #333; }
        .btn-secondary:hover { background: #e0e0e0; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-danger:hover { background: #c82333; }
        
        .empty { text-align: center; padding: 40px; color: #999; background: white; border-radius: 10px; }
        
        .pagination { margin-top: 20px; text-align: center; }
        .pagination a, .pagination span { display: inline-block; padding: 8px 12px; margin: 0 5px; border-radius: 5px; }
        .pagination a { background: #C4860B; color: white; text-decoration: none; }
        .pagination a:hover { background: #8B5D00; }
        .pagination .active { background: #333; color: white; }
        
        @media (max-width: 768px) {
            .message-preview { max-width: 200px; }
            .actions { flex-direction: column; }
            table { font-size: 12px; }
            th, td { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="{{ route('admin.dashboard') }}" class="back-link">← العودة إلى لوحة التحكم</a>
            <h1>جميع الرسائل</h1>
        </header>

        @if($messages->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الموضوع</th>
                        <th>الرسالة</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td class="message-preview">{{ $message->message }}</td>
                            <td>
                                @if($message->status === 'unread')
                                    <span class="status-unread">غير مقروءة</span>
                                @else
                                    <span class="status-read">مقروءة</span>
                                @endif
                            </td>
                            <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="actions">
                                    @if($message->status === 'unread')
                                        <form action="{{ route('admin.messages.read', $message) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">تعليم كمقروءة</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.messages.unread', $message) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">تعليم كغير مقروءة</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.messages.delete', $message) }}" method="POST" style="display: inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $messages->links() }}
            </div>
        @else
            <div class="empty">
                <p>لا توجد رسائل حتى الآن</p>
            </div>
        @endif
    </div>
</body>
</html>
