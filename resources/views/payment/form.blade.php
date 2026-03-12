<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بيانات الدفع - {{ $order->service->title }}</title>
    <style>
        body { font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; background:#f4f4f4; margin:0; padding:20px; }
        .container { max-width:700px; margin:0 auto; background:white; padding:40px; border-radius:15px; box-shadow:0 5px 15px rgba(0,0,0,0.1); }
        h1 { color:#C4860B; text-align:center; margin-bottom:30px; }
        .step-indicator { text-align:center; margin-bottom:30px; font-size:14px; color:#666; }
        .step-indicator .step { display:inline-block; margin:0 10px; }
        .step-indicator .step.active { color:#C4860B; font-weight:bold; }
        .form-group { margin-bottom:20px; }
        label { display:block; margin-bottom:8px; color:#333; font-weight:500; }
        input, select { width:100%; padding:12px; border:1px solid #ddd; border-radius:5px; font-size:16px; }
        input:focus, select:focus { outline:none; border-color:#C4860B; }
        .service-info { background:#f9f9f9; padding:20px; border-radius:10px; margin-bottom:30px; border-right:4px solid #C4860B; }
        .service-info h3 { color:#333; margin:0 0 10px 0; }
        .service-price { font-size:24px; color:#C4860B; font-weight:bold; }
        button { background:#C4860B; color:white; padding:15px 40px; border:none; border-radius:5px; cursor:pointer; font-size:16px; width:100%; }
        button:hover { background:#8B5D00; }
        .info-box { background:#fff3cd; padding:15px; border-radius:5px; margin-bottom:20px; color:#856404; border-right:4px solid #C4860B; }
    </style>
</head>
<body>
    <div class="container">
        <div class="step-indicator">
            <span class="step active">1. بيانات الدفع</span>
            <span class="step active">2. رفع الإيصال</span>
            <span class="step">3. تأكيد</span>
        </div>

        <h1>بيانات الدفع</h1>

        <div class="service-info">
            <h3>{{ $order->service->title }}</h3>
            <p>في هذه الخطوة، يرجى تحديد طريقة الدفع ورقم الهاتف المستخدم.</p>
            <div class="service-price">{{ $order->service->price }}</div>
        </div>

        <div class="info-box">
            الخطوة التالية: ستتمكن من رفع إيصال الدفع بعد تعبئة البيانات
        </div>

        <form method="POST" action="{{ route('payment.process', $order) }}">
            @csrf

            <div class="form-group">
                <label>طريقة الدفع *</label>
                <select name="payment_method" required>
                    <option value="">-- اختر طريقة الدفع --</option>
                    <option value="bank">بنك فلسطين</option>
                    <option value="reflect">ريفلكت</option>
                </select>
                @error('payment_method')
                    <span style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>رقم الهاتف المستخدم في الدفع *</label>
                <input type="text" name="payment_phone" placeholder="مثال: 0599999999" required>
                @error('payment_phone')
                    <span style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">المتابعة لرفع الإيصال</button>
        </form>
    </div>
</body>
</html>