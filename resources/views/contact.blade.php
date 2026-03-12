<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتصل بنا - PR Per Hour</title>
    <style>
        body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f4f4f4;margin:0;padding:20px;}
        .container{max-width:900px;margin:0 auto;background:white;padding:40px;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        h1{color:#C4860B;margin-bottom:30px;text-align:center;font-size:36px;}
        h2{color:#333;margin-top:30px;margin-bottom:15px;border-bottom:2px solid #C4860B;padding-bottom:10px;}
        .contact-info{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin:30px 0;}
        .info-box{background:#f9f9f9;padding:20px;border-radius:10px;border-right:4px solid #C4860B;}
        .info-box h3{color:#333;margin:0 0 10px 0;}
        .info-box p{margin:5px 0;color:#555;}
        .form-group{margin:20px 0;}
        .form-group label{display:block;margin-bottom:8px;color:#333;font-weight:bold;}
        .form-group input,.form-group textarea{width:100%;padding:12px;border:1px solid #ddd;border-radius:5px;font-family:inherit;}
        .form-group textarea{resize:vertical;min-height:150px;}
        button{background:linear-gradient(135deg,#C4860B 0%,#8B5D00 100%);color:white;padding:15px 30px;border:none;border-radius:5px;cursor:pointer;font-size:16px;width:100%;}
        button:hover{opacity:0.9;}
        @media(max-width:600px){.contact-info{grid-template-columns:1fr;}}
    </style>
</head>
<body>
    <div class="container">
        <h1>اتصل بنا</h1>

        <p style="text-align:center;color:#666;margin-bottom:40px;font-size:18px;">
            نحن هنا لنساعدك. لا تتردد في التواصل معنا لأي استفسار أو اقتراح.
        </p>

        <div class="contact-info">
            <div class="info-box">
                <h3>البريد الإلكتروني</h3>
                <p><a href="mailto:f.maali@prperhour.com" style="color:#C4860B;text-decoration:none;">f.maali@prperhour.com</a></p>
            </div>
            <div class="info-box">
                <h3>الهاتف</h3>
                <p style="direction:ltr;">+966 XX XXX XXXX</p>
            </div>
            <div class="info-box">
                <h3>ساعات العمل</h3>
                <p>السبت - الخميس<br>9:00 صباحاً - 6:00 مساءً</p>
            </div>
            <div class="info-box">
                <h3>وسائل التواصل</h3>
                <p>تابعونا على وسائل التواصل الاجتماعي</p>
            </div>
        </div>

        <h2>أرسل لنا رسالة</h2>
        <form method="POST" action="{{ route('contact.store') }}" style="margin-top:30px;">
            @csrf
            
            <div class="form-group">
                <label for="name">الاسم *</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني *</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="tel" id="phone" name="phone" placeholder="+966...">
            </div>

            <div class="form-group">
                <label for="subject">الموضوع *</label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="message">الرسالة *</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit">إرسال الرسالة</button>
        </form>

        @if($errors->any())
            <div style="color:red;margin-top:20px;padding:15px;background:#ffebee;border-radius:5px;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div style="color:green;margin-top:20px;padding:15px;background:#e8f5e9;border-radius:5px;">
                شكراً لتواصلك معنا. سنرد على رسالتك في أقرب وقت.
            </div>
        @endif
    </div>
</body>
</html>