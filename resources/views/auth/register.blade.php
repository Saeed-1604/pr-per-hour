<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل جديد - PR Per Hour</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .register-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 200px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus {
            outline: none;
            border-color: #C4860B;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #C4860B;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: bold;
        }
        button:hover {
            background: #8B5D00;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a {
            color: #C4860B;
            text-decoration: none;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .required:after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="PR Per Hour">
        </div>
        <h2>تسجيل حساب جديد</h2>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="required">الاسم الأول</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                </div>

                <div class="form-group">
                    <label class="required">اسم الأب</label>
                    <input type="text" name="father_name" value="{{ old('father_name') }}" required>
                </div>

                <div class="form-group">
                    <label class="required">الاسم الأخير</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="required">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="required">كلمة المرور</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label class="required">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit">تسجيل</button>
        </form>

        <div class="links">
            <a href="{{ route('login') }}">لديك حساب؟ سجل دخولك</a>
        </div>
    </div>
</body>
</html>
