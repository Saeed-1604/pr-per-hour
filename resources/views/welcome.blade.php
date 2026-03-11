<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR Per Hour</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            color: #333;
            text-align: center;
            padding: 50px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            border-radius: 20px;
        }
        img {
            max-width: 350px;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }
        .tagline {
            font-size: 1.5em;
            color: #B8860B;
            font-weight: bold;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #555;
        }
        .buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            background: white;
            color: #B8860B;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2em;
            transition: all 0.3s;
            display: inline-block;
            min-width: 200px;
            border: 2px solid #D4AF37;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .btn:hover {
            background: #D4AF37;
            color: white;
            transform: scale(1.05);
            border-color: #B8860B;
            box-shadow: 0 4px 8px rgba(180, 130, 20, 0.3);
        }
        .btn:last-child {
            border-color: #B8860B;
        }
        .btn:last-child:hover {
            background: #B8860B;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="PR Per Hour Logo">
        <div class="tagline">Making Every Hour Count</div>
        <p>خدمات استشارية متكاملة في العلاقات العامة وإدارة السمعة<br>احجز استشارتك الآن وابدأ رحلة النجاح</p>

        <div class="buttons">
            <a href="#" class="btn">احجز استشارتك</a>
            <a href="#" class="btn">اكتشف خدماتنا</a>
        </div>
    </div>
</body>
</html>
