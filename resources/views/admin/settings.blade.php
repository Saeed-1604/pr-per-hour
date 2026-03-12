<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الإعدادات - لوحة التحكم</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: #f0f2f5; }
        .container { max-width: 900px; margin: 0 auto; padding: 20px; }
        header { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h1 { color: #333; font-size: 24px; margin-bottom: 10px; }
        .back-link { color: #C4860B; text-decoration: none; font-size: 14px; }
        .back-link:hover { text-decoration: underline; }
        
        .alert { padding: 15px; border-radius: 10px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        .card { background: white; padding: 30px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .card-title { color: #333; font-size: 18px; font-weight: 600; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; color: #333; font-size: 14px; font-weight: 600; margin-bottom: 8px; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; font-family: inherit; }
        input:focus { outline: none; border-color: #C4860B; box-shadow: 0 0 0 3px rgba(196, 134, 11, 0.1); }
        
        .form-hint { color: #888; font-size: 12px; margin-top: 5px; }
        
        .btn { padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 600; transition: all 0.3s; text-decoration: none; display: inline-block; }
        .btn-primary { background: #C4860B; color: white; }
        .btn-primary:hover { background: #8B5D00; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(196, 134, 11, 0.3); }
        .btn-secondary { background: #f0f0f0; color: #333; border: 1px solid #ddd; }
        .btn-secondary:hover { background: #e9e9e9; }
        
        .error-message { color: #dc3545; font-size: 13px; margin-top: 5px; }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        
        .alert { list-style: none; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert ul { list-style: none; padding: 0; margin: 0; }
        .alert li { padding: 5px 0; }
        .alert li:before { content: "• "; margin-right: 8px; }
        
        .section-divider { height: 1px; background: #f0f0f0; margin: 30px 0; }

        .btn-group { display: flex; gap: 10px; margin-top: 20px; }
        
        @media (max-width: 768px) {
            .container { padding: 15px; }
            .form-row { grid-template-columns: 1fr; }
            .card { padding: 20px; }
            h1 { font-size: 20px; }
            .btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="{{ route('admin.dashboard') }}" class="back-link">← العودة إلى لوحة التحكم</a>
            <h1>الإعدادات الشخصية</h1>
        </header>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- بيانات الحساب -->
        <div class="card">
            <div class="card-title">معلومات الحساب</div>
            <div class="form-row">
                <div class="form-group">
                    <label>الاسم الكامل</label>
                    <input type="text" value="{{ $user->first_name }} {{ $user->father_name }} {{ $user->last_name }}" readonly style="background: #f5f5f5;">
                </div>
                <div class="form-group">
                    <label>البريد الإلكتروني الحالي</label>
                    <input type="email" value="{{ $user->email }}" readonly style="background: #f5f5f5;">
                </div>
            </div>
        </div>

        <!-- تغيير البريد الإلكتروني -->
        <div class="card">
            <div class="card-title">تغيير البريد الإلكتروني</div>
            <form action="{{ route('admin.settings.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">البريد الإلكتروني الجديد</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="أدخل البريد الإلكتروني الجديد"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email_confirmation">تأكيد البريد الإلكتروني</label>
                    <input 
                        type="email" 
                        id="email_confirmation" 
                        name="email_confirmation" 
                        placeholder="أعد إدخال البريد الإلكتروني الجديد"
                        value="{{ old('email_confirmation') }}"
                    >
                    <div class="form-hint">تأكد من تطابق البريد الإلكتروني</div>
                    @error('email_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="current_password_email">كلمة المرور الحالية</label>
                    <input 
                        type="password" 
                        id="current_password_email" 
                        name="current_password" 
                        placeholder="أدخل كلمة المرور الحالية للتأكيد"
                    >
                    <div class="form-hint">مطلوب لأسباب أمان - نحتاج للتأكد من هويتك</div>
                    @error('current_password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">تحديث البريد الإلكتروني</button>
            </form>
        </div>

        <div class="section-divider"></div>

        <!-- تغيير كلمة المرور -->
        <div class="card">
            <div class="card-title">تغيير كلمة المرور</div>
            <form action="{{ route('admin.settings.password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="current_password">كلمة المرور الحالية</label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        placeholder="أدخل كلمة المرور الحالية"
                    >
                    @error('current_password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">كلمة المرور الجديدة</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="أدخل كلمة مرور جديدة"
                    >
                    <div class="form-hint">يجب أن تكون 8 أحرف على الأقل وتحتوي على أحرف كبيرة وصغيرة وأرقام</div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">تأكيد كلمة المرور الجديدة</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="أعد إدخال كلمة المرور الجديدة"
                    >
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">تحديث كلمة المرور</button>
            </form>
        </div>
    </div>
</body>
</html>
