<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدردشة مع الدعم - طلب #{{ $order->id }}</title>
    <style>
        body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f4f4f4;margin:0;padding:20px;}
        .container{max-width:800px;margin:0 auto;background:white;padding:30px;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        .header{margin-bottom:30px;padding-bottom:20px;border-bottom:2px solid #f0f0f0;}
        .header h1{color:#D4AF37;margin:0 0 10px 0;}
        .header p{color:#888;margin:0;}
        .messages{max-height:500px;overflow-y:auto;margin-bottom:20px;padding:20px 0;border-bottom:1px solid #f0f0f0;}
        .message{margin-bottom:20px;padding:15px;border-radius:8px;}
        .message.user{background:#f0f8ff;border-right:4px solid #D4AF37;}
        .message.admin{background:#fffdf0;border-right:4px solid #4CAF50;}
        .message .author{font-weight:bold;margin-bottom:5px;}
        .message.user .author{color:#333;}
        .message.admin .author{color:#4CAF50;}
        .message .text{color:#555;line-height:1.5;}
        .message .time{font-size:12px;color:#999;margin-top:8px;}
        textarea{width:100%;padding:12px;border:1px solid #ddd;border-radius:5px;resize:vertical;font-family:inherit;}
        .form-group{margin-bottom:15px;}
        button{background:#D4AF37;color:white;padding:12px 24px;border:none;border-radius:5px;cursor:pointer;font-size:15px;width:100%;}
        button:hover{background:#B8860B;}
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>الدردشة مع الدعم</h1>
            <p>طلب رقم #{{ $order->id }} - {{ $order->service->title }}</p>
        </div>

        <div class="messages">
            @if($chats->count())
                @foreach($chats as $chat)
                    <div class="message {{ $chat->user_id === $order->user_id ? 'user' : 'admin' }}">
                        <div class="author">{{ $chat->user->full_name }}</div>
                        <div class="text">{{ $chat->message }}</div>
                        <div class="time">{{ $chat->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                @endforeach
            @else
                <p style="text-align:center;color:#999;padding:20px;">لا توجد رسالة بعد، ابدأ الدردشة بأدناه.</p>
            @endif
        </div>

        <form method="POST" action="{{ route('orders.chat.store', $order) }}">
            @csrf
            <div class="form-group">
                <textarea name="message" rows="4" placeholder="اكتب رسالتك هنا..." required></textarea>
            </div>
            <button type="submit">إرسال الرسالة</button>
        </form>
    </div>
</body>
</html>