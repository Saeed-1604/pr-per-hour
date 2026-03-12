<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - PR Per Hour</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
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
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="PR Per Hour">
        </div>
        <h2>تسجيل الدخول</h2>

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" required autofocus>
            </div>
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">دخول</button>
        </form>

        <div class="links">
            <a href="{{ route('register') }}">ليس لديك حساب؟ سجل الآن</a>
        </div>
    </div>
</body>
</html>
