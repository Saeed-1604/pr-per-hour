<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جميع المحادثات - لوحة التحكم</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: #f0f2f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h1 { color: #333; font-size: 24px; margin-bottom: 10px; }
        .back-link { color: #C4860B; text-decoration: none; font-size: 14px; }
        .back-link:hover { text-decoration: underline; }
        
        .chat-item { background: white; padding: 20px; border-radius: 10px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-right: 4px solid #C4860B; }
        .chat-header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px; }
        .chat-user { font-weight: bold; color: #333; font-size: 16px; }
        .chat-meta { display: flex; gap: 15px; }
        .chat-service { background: #C4860B; color: white; padding: 3px 10px; border-radius: 5px; font-size: 12px; }
        .chat-time { color: #888; font-size: 12px; }
        .chat-message { color: #666; line-height: 1.6; font-size: 14px; margin-bottom: 10px; background: #f9f9f9; padding: 15px; border-radius: 5px; }
        .chat-footer { display: flex; gap: 10px; padding-top: 15px; border-top: 1px solid #f0f0f0; }
        .btn { padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; font-size: 12px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #C4860B; color: white; }
        .btn-primary:hover { background: #8B5D00; }
        .btn-secondary { background: #f0f0f0; color: #333; }
        .btn-secondary:hover { background: #e0e0e0; }
        
        .empty { text-align: center; padding: 40px; color: #999; }
        
        .pagination { margin-top: 20px; text-align: center; }
        .pagination a, .pagination span { display: inline-block; padding: 8px 12px; margin: 0 5px; border-radius: 5px; }
        .pagination a { background: #C4860B; color: white; text-decoration: none; }
        .pagination a:hover { background: #8B5D00; }
        .pagination .active { background: #333; color: white; }
        
        @media (max-width: 768px) {
            .chat-header { flex-direction: column; }
            .chat-meta { flex-direction: column; gap: 5px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="{{ route('admin.dashboard') }}" class="back-link">← العودة إلى لوحة التحكم</a>
            <h1>جميع المحادثات</h1>
        </header>

        @if($chats->count() > 0)
            @foreach($chats as $chat)
                <div class="chat-item">
                    <div class="chat-header">
                        <div class="chat-user">{{ $chat->user->first_name }} {{ $chat->user->last_name }}</div>
                        <div class="chat-meta">
                            <span class="chat-service">{{ $chat->order->service->title }}</span>
                            <span class="chat-time">{{ $chat->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="chat-message">{{ $chat->message }}</div>
                    <div class="chat-footer">
                        <a href="{{ route('orders.chat.show', $chat->order) }}" class="btn btn-primary">عرض المحادثة كاملة</a>
                    </div>
                </div>
            @endforeach

            <div class="pagination">
                {{ $chats->links() }}
            </div>
        @else
            <div class="empty">
                <p>لا توجد محادثات حتى الآن</p>
            </div>
        @endif
    </div>
</body>
</html>
