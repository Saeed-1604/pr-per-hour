<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم استلام طلبك - PR Per Hour</title>
    <style>
        body {font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f4f4f4;margin:0;padding:50px;text-align:center;}
        .container{background:white;padding:40px;border-radius:15px;max-width:600px;margin:0 auto;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        h1{color:#D4AF37;font-size:28px;margin-bottom:20px;}
        p{color:#333;line-height:1.6;margin-bottom:15px;}
        .phones{background:#fff9e6;padding:20px;border-radius:10px;border:1px solid #D4AF37;margin-top:20px;}
        .phones h3{color:#B8860B;margin-bottom:10px;}
        .btn{background:#D4AF37;color:white;padding:12px 25px;border:none;border-radius:5px;text-decoration:none;font-size:16px;display:inline-block;margin-top:20px;}
        .btn:hover{background:#B8860B;}
    </style>
</head>
<body>
    <div class="container">
        <h1>تم إرسال طلبك ل{{ $order->service->title }} بنجاح</h1>
        <p>سنقوم بمراجعة طلبك والرد عليك قريباً.</p>
        <p>يرجى إجراء الدفع باستخدام أحد الأرقام التالية ثم رفع الإيصال إن لم تقم بذلك أثناء الطلب.</p>
        <div class="phones">
            <h3>أرقام الدفع</h3>
            <p>بنك فلسطين: {{ $phones['bank'] }}</p>
            <p>ريفلكت: {{ $phones['reflect'] }}</p>
        </div>
        <a href="{{ route('my-orders') }}" class="btn">عرض طلباتي</a>
        <a href="{{ route('orders.show', $order) }}" class="btn" style="margin-top:10px;">عرض تفاصيل هذا الطلب</a>
    </div>
</body>
</html>