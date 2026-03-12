<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->title }} - PR Per Hour</title>
    <style>
        body {font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f4f4f4; margin:0;padding:20px;}
        .navbar{background:linear-gradient(135deg,#C4860B 0%,#5D3406 100%);color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center;margin-bottom:40px;border-radius:10px;}
        .navbar .left{display:flex;align-items:center;gap:20px;}
        .navbar .logo{font-size:24px;font-weight:bold;}
        .navbar .logo-image{width:50px;height:50px;background:white;border-radius:5px;display:flex;align-items:center;justify-content:center;font-weight:bold;color:#C4860B;}
        .navbar .right{display:flex;align-items:center;gap:20px;}
        .my-orders-box{background:rgba(255,255,255,0.2);padding:10px 15px;border-radius:5px;}
        .my-orders-box a{color:white;text-decoration:none;display:block;margin:5px 0;font-size:14px;}
        .my-orders-box a:hover{text-decoration:underline;}
        .my-orders-label{font-size:12px;color:rgba(255,255,255,0.8);margin-bottom:5px;}
        .navbar a{color:white;text-decoration:none;margin-left:20px;}
        .navbar a:hover{text-decoration:underline;}
        .container{max-width:900px;margin:0 auto;background:white;padding:30px;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        h1{color:#C4860B;font-size:32px;margin-bottom:20px;text-align:center;}
        .section{margin-bottom:25px;}
        .section h2{color:#333;font-size:22px;margin-bottom:10px;}
        .section p{color:#555;line-height:1.6;}
        .btn{background:#C4860B;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;font-size:16px;text-decoration:none;}
        .btn:hover{background:#8B5D00;}
        .form-group{margin-bottom:15px;}
        label{display:block;margin-bottom:5px;color:#555;font-weight:500;}
        input, textarea, select{width:100%;padding:10px;border:1px solid #ddd;border-radius:5px;font-size:16px;}
        input:focus, textarea:focus, select:focus{outline:none;border-color:#C4860B;}
        .required:after{content:" *";color:red;}
    </style>
</head>
<body>
    <div class="navbar">
        <div class="left">
            <div class="logo-image">PR</div>
            <div class="logo">PR Per Hour</div>
        </div>
        <div class="right">
            @auth
                <div class="my-orders-box">
                    <div class="my-orders-label">طلباتي</div>
                    <a href="{{ route('my-orders') }}">عرض الطلبات</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="document.getElementById('logout-form').submit(); return false;" style="color:white;text-decoration:none;">تسجيل الخروج</a>
            @else
                <a href="{{ route('login') }}" style="color:white;text-decoration:none;">دخول</a>
                <a href="{{ route('register') }}" style="color:white;text-decoration:none;">إنشاء حساب</a>
            @endauth
        </div>
    </div>

    <div class="container">
        <h1>{{ $service->title }}</h1>
        <div class="section">
            <h2>الوصف</h2>
            <p>{{ $service->intro }}</p>
        </div>
        <div class="section">
            <h2>المخرجات</h2>
            <p>{{ $service->outputs }}</p>
        </div>
        <div class="section">
            <h2>السعر</h2>
            <p>{{ $service->price }}</p>
        </div>
        <div class="section">
            <h2>سياسة التنفيذ</h2>
            <p>{{ $service->execution_policy }}</p>
        </div>
        <div class="section">
            <h2>مدة التنفيذ</h2>
            <p>{{ $service->duration }}</p>
        </div>

        <div class="section">
            <h2>اطلب هذه الخدمة</h2>
            @if($errors->any())
                <div style="background:#f8d7da;color:#721c24;padding:10px;border-radius:5px;margin-bottom:20px;">
                    <ul style="list-style:none;padding:0;margin:0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">

                {{-- specific consultation fields example --}}
                @if($service->slug == 'consultation')
                    <div class="form-group">
                        <label class="required">نوع المشكلة</label>
                        <select name="problem_type" required>
                            <option value="">-- اختر --</option>
                            <option value="page_issues">مشاكل الصفحات</option>
                            <option value="meta_ads">مشاكل إعلانات Meta</option>
                            <option value="project_build">مشاكل بناء المشاريع</option>
                            <option value="personal_identity">الهوية الشخصية</option>
                            <option value="product_issues">مشاكل المنتج</option>
                            <option value="content_ideas">أفكار المحتوى</option>
                            <option value="other">أخرى</option>
                        </select>
                    </div>
                    <div class="form-group" id="other-problem-container" style="display:none;">
                        <label>توضيح المشكلة الأخرى</label>
                        <input type="text" name="other_problem">
                    </div>
                @endif

                <div class="form-group">
                    <label class="required">شرح المشكلة بالتفصيل</label>
                    <textarea name="details" rows="6" required>{{ old('details') }}</textarea>
                </div>

                <div class="section">
                    <h2>بيانات الدفع</h2>
                    <div class="form-group">
                        <label class="required">طريقة الدفع</label>
                        <select name="payment_method" required>
                            <option value="bank">بنك فلسطين</option>
                            <option value="reflect">ريفلكت</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="required">رقم الهاتف (المستخدم في الدفع)</label>
                        <input type="text" name="payment_phone" value="{{ old('payment_phone') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="required">
                        <input type="checkbox" name="agree" value="1" required> 
                        أوافق على <a href="{{ route('terms') }}" target="_blank" style="color:#C4860B;">شروط الخدمة</a>
                    </label>
                </div>

                <button type="submit" class="btn">إرسال الطلب</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('select[name="problem_type"]').addEventListener('change', function() {
            var otherContainer = document.getElementById('other-problem-container');
            otherContainer.style.display = this.value === 'other' ? 'block' : 'none';
        });
    </script>
</body>
</html>