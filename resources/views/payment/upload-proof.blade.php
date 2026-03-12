<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع إيصال الدفع</title>
    <style>
        body { font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; background:#f4f4f4; margin:0; padding:20px; }
        .container { max-width:700px; margin:0 auto; background:white; padding:40px; border-radius:15px; box-shadow:0 5px 15px rgba(0,0,0,0.1); }
        h1 { color:#C4860B; text-align:center; margin-bottom:30px; }
        .step-indicator { text-align:center; margin-bottom:30px; font-size:14px; color:#666; }
        .step-indicator .step { display:inline-block; margin:0 10px; }
        .step-indicator .step.active { color:#C4860B; font-weight:bold; }
        .payment-info { background:#e8f5e9; padding:20px; border-radius:10px; margin-bottom:30px; border-right:4px solid #4caf50; }
        .payment-numbers { background:white; padding:15px; border-radius:5px; margin-top:15px; }
        .payment-method { margin-bottom:15px; padding:10px; background:#f9f9f9; border-radius:5px; }
        .method-label { color:#333; font-weight:bold; }
        .method-number { color:#C4860B; font-size:18px; font-weight:bold; margin-top:5px; }
        .file-upload { margin:30px 0; }
        .file-input { display:none; }
        .file-label { display:block; padding:40px; border:2px dashed #C4860B; border-radius:10px; text-align:center; cursor:pointer; background:#f9f9f9; transition:all 0.3s; }
        .file-label:hover { background:#fff9e6; }
        .file-label i { font-size:40px; color:#C4860B; }
        .file-name { color:#666; margin-top:10px; font-size:14px; }
        button { background:#C4860B; color:white; padding:15px 40px; border:none; border-radius:5px; cursor:pointer; font-size:16px; width:100%; }
        button:hover { background:#8B5D00; }
        .info-box { background:#fff3cd; padding:15px; border-radius:5px; margin-bottom:20px; color:#856404; border-right:4px solid #C4860B; }
    </style>
</head>
<body>
    <div class="container">
        <div class="step-indicator">
            <span class="step">1. بيانات الدفع</span>
            <span class="step active">2. رفع الإيصال</span>
            <span class="step">3. تأكيد</span>
        </div>

        <h1>رفع إيصال الدفع</h1>

        <div class="info-box">
            يرجى تحويل المبلغ إلى رقم الهاتف أدناه، ثم قم برفع صورة الإيصال
        </div>

        <div class="payment-info">
            <h3>بيانات التحويل</h3>
            <div class="payment-numbers">
                @if($payment->method === 'bank')
                    <div class="payment-method">
                        <div class="method-label">بنك فلسطين</div>
                        <div class="method-number">059-1234567</div>
                    </div>
                @else
                    <div class="payment-method">
                        <div class="method-label">ريفلكت (Reflect)</div>
                        <div class="method-number">059-7654321</div>
                    </div>
                @endif
            </div>
            <p style="margin-top:15px; color:#666;">المبلغ: <strong>{{ $order->service->price }}</strong></p>
        </div>

        <form method="POST" action="{{ route('payment.upload-proof', $order) }}" enctype="multipart/form-data">
            @csrf

            <div class="file-upload">
                <label for="payment_proof" class="file-label">
                    <div>اضغط هنا أو اسحب الملف</div>
                    <div class="file-name">JPG, PNG أو PDF (الحد الأقصى 5 MB)</div>
                    <input type="file" id="payment_proof" name="payment_proof" class="file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                </label>
            </div>

            @error('payment_proof')
                <div style="color:red; margin-bottom:20px; padding:10px; background:#ffebee; border-radius:5px;">{{ $message }}</div>
            @enderror

            <button type="submit">تأكيد الدفع ورفع الإيصال</button>
        </form>
    </div>

    <script>
        const fileLabel = document.querySelector('.file-label');
        const fileInput = document.getElementById('payment_proof');

        fileLabel.addEventListener('click', () => fileInput.click());
        fileLabel.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileLabel.style.background = '#e8f5e9';
        });
        fileLabel.addEventListener('dragleave', () => {
            fileLabel.style.background = '#f9f9f9';
        });
        fileLabel.addEventListener('drop', (e) => {
            e.preventDefault();
            fileInput.files = e.dataTransfer.files;
            updateFileName();
        });

        fileInput.addEventListener('change', updateFileName);

        function updateFileName() {
            const files = fileInput.files;
            if (files.length > 0) {
                document.querySelector('.file-name').textContent = files[0].name;
            }
        }
    </script>
</body>
</html>