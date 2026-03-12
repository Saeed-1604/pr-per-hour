<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم استلام الدفع</title>
    <style>
        body { font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; background:#f4f4f4; margin:0; padding:20px; }
        .container { max-width:700px; margin:0 auto; background:white; padding:40px; border-radius:15px; box-shadow:0 5px 15px rgba(0,0,0,0.1); text-align:center; }
        .success-icon { width:100px; height:100px; margin:0 auto 30px; }
        .success-icon svg { fill:#4caf50; }
        h1 { color:#4caf50; margin-bottom:10px; }
        .subtitle { color:#666; margin-bottom:30px; font-size:16px; }
        .order-details { background:#f9f9f9; padding:20px; border-radius:10px; margin:30px 0; text-align:right; }
        .detail-row { display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #e0e0e0; }
        .detail-row:last-child { border-bottom:none; }
        .detail-label { color:#666; }
        .detail-value { color:#333; font-weight:bold; }
        .next-steps { background:#e8f5e9; padding:20px; border-radius:10px; margin:30px 0; border-right:4px solid #4caf50; text-align:right; }
        .next-steps h3 { color:#2e7d32; margin-top:0; }
        .next-steps ol { text-align:right; }
        .next-steps li { margin:10px 0; color:#333; }
        .info-message { background:#fff3cd; padding:15px; border-radius:10px; margin:20px 0; color:#856404; border-right:4px solid #C4860B; text-align:right; }
        .buttons { display:flex; gap:15px; margin-top:30px; }
        .btn { padding:12px 30px; border:none; border-radius:5px; cursor:pointer; font-size:16px; flex:1; }
        .btn-primary { background:#C4860B; color:white; }
        .btn-primary:hover { background:#8B5D00; }
        .btn-secondary { background:#f0f0f0; color:#333; border:1px solid #ddd; }
        .btn-secondary:hover { background:#e0e0e0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">
            <svg width="100" height="100" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" fill="none" stroke="#4caf50" stroke-width="2"/>
                <path d="M 30 50 L 45 65 L 70 35" stroke="#4caf50" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h1>تم استقبال طلبك بنجاح</h1>
        <p class="subtitle">شكراً لتعاملك معنا. سيتم مراجعة طلبك في أقرب وقت</p>

        <div class="order-details">
            <div class="detail-row">
                <span class="detail-value">{{ $order->id }}</span>
                <span class="detail-label">رقم الطلب:</span>
            </div>
            <div class="detail-row">
                <span class="detail-value">{{ $order->service->title }}</span>
                <span class="detail-label">الخدمة:</span>
            </div>
            <div class="detail-row">
                <span class="detail-value">${{ $order->service->price }}</span>
                <span class="detail-label">المبلغ:</span>
            </div>
            <div class="detail-row">
                <span class="detail-value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                <span class="detail-label">تاريخ الطلب:</span>
            </div>
        </div>

        <div class="info-message">
            تم استقبال إيصال الدفع الخاص بك. سيقوم فريقنا بمراجعة التحويل وتأكيد الدفع خلال 24 ساعة
        </div>

        <div class="next-steps">
            <h3>الخطوات التالية</h3>
            <ol>
                <li>سيتم التحقق من الدفع في أقرب وقت</li>
                <li>سيتم إرسال تفاصيل العمل إلى بريدك الإلكتروني</li>
                <li>يمكنك متابعة حالة طلبك من خلال حسابك</li>
                <li>سيتواصل معك فريقنا عند الحاجة</li>
            </ol>
        </div>

        <div class="buttons">
            <a href="{{ route('my-orders') }}" class="btn btn-primary">عرض طلباتي</a>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">الرجوع للخدمات</a>
        </div>
    </div>
</body>
</html>