# PR Per Hour - نظام إدارة الخدمات المهنية

نظام شامل لإدارة الخدمات المهنية في مجال العلاقات العامة والتسويق الرقمي.

## المميزات

- 🏢 **لوحة تحكم إدارية** - إدارة شاملة للطلبات والعملاء والخدمات
- 👥 **إدارة العملاء** - نظام متكامل لإدارة بيانات العملاء
- 📋 **إدارة الطلبات** - تتبع وإدارة طلبات الخدمات
- 💬 **نظام المحادثات** - تواصل مباشر مع العملاء
- 📊 **التقارير والإحصائيات** - تحليلات مفصلة للأداء
- 🔐 **نظام أمان متقدم** - حماية كاملة للبيانات
- 📱 **تصميم متجاوب** - يعمل على جميع الأجهزة

## متطلبات النظام

- PHP 8.2 أو أحدث
- MySQL 8.0 أو MariaDB
- Composer
- Node.js & NPM (للتطوير)
- Docker (اختياري)

## التثبيت والتشغيل

### الطريقة الأولى: Docker (موصى بها)

```bash
# استنساخ المشروع
git clone <repository-url>
cd prperhour

# تشغيل النظام
docker-compose up -d

# الدخول إلى الحاوية
docker-compose exec app bash

# تشغيل migrations
php artisan migrate

# إنشاء مستخدم إداري
php artisan tinker
# ثم في tinker:
# User::create(['email' => 'admin@prperhour.com', 'password' => Hash::make('password'), 'is_admin' => true]);
```

### الطريقة الثانية: التثبيت المحلي

```bash
# استنساخ المشروع
git clone <repository-url>
cd prperhour

# تثبيت dependencies
composer install
npm install

# إعداد قاعدة البيانات
cp .env.example .env
php artisan key:generate

# تحديث إعدادات قاعدة البيانات في .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=prperhour
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# تشغيل migrations
php artisan migrate

# تشغيل seeders (اختياري)
php artisan db:seed

# بناء الأصول
npm run build

# تشغيل الخادم
php artisan serve
```

## الوصول للنظام

- **الموقع الرئيسي**: http://localhost:8000
- **لوحة التحكم**: http://localhost:8000/admin/dashboard
- **البريد الإلكتروني الافتراضي للإدارة**: admin@prperhour.com
- **كلمة المرور الافتراضية**: password

## هيكل المشروع

```
prperhour/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Controllers الإدارية
│   │   └── Auth/           # Controllers المصادقة
│   ├── Models/             # نماذج قاعدة البيانات
│   └── Providers/          # Service Providers
├── database/
│   ├── migrations/         # ملفات الهجرة
│   └── seeders/            # Seeders
├── public/                 # الملفات العامة
├── resources/
│   ├── views/              # ملفات Blade
│   └── css/js/             # الأصول
├── routes/                 # ملفات التوجيه
└── docker/                 # ملفات Docker
```

## الأوامر المفيدة

```bash
# مسح cache التكوين
php artisan config:clear

# مسح cache التوجيه
php artisan route:clear

# مسح cache العرض
php artisan view:clear

# إعادة تحميل cache التكوين
php artisan config:cache

# فحص التوجيهات
php artisan route:list

# تشغيل migrations
php artisan migrate

# إنشاء migration جديد
php artisan make:migration create_table_name

# إنشاء controller جديد
php artisan make:controller NameController

# إنشاء model جديد
php artisan make:model Name
```

## نشر النظام

### على Railway

1. ارفع المشروع إلى GitHub
2. اربط المشروع بـ Railway
3. أضف متغيرات البيئة:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `DB_CONNECTION=mysql`
   - إعدادات قاعدة البيانات من Railway

### على خادم آخر

```bash
# تحديث dependencies للإنتاج
composer install --optimize-autoloader --no-dev

# تحديث الأصول
npm run build

# ضبط الصلاحيات
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/

# تشغيل migrations
php artisan migrate --force
```

## استكشاف الأخطاء

### خطأ Apache MPM
إذا واجهت خطأ "More than one MPM loaded":
- تأكد من أن Dockerfile محدث
- أعد بناء الصورة: `docker-compose build --no-cache`

### مشاكل قاعدة البيانات
```bash
# فحص اتصال قاعدة البيانات
php artisan tinker
# ثم: DB::connection()->getPdo();

# إعادة تشغيل migrations
php artisan migrate:fresh
```

### مشاكل الأذونات
```bash
# إصلاح أذونات Laravel
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

## المساهمة

نرحب بالمساهمات! يرجى اتباع الخطوات التالية:

1. Fork المشروع
2. إنشاء branch جديد: `git checkout -b feature-name`
3. Commit التغييرات: `git commit -am 'Add feature'`
4. Push للbranch: `git push origin feature-name`
5. إنشاء Pull Request

## الترخيص

هذا المشروع مرخص تحت رخصة MIT.

## الدعم

للدعم الفني، يرجى التواصل عبر:
- البريد الإلكتروني: support@prperhour.com
- الموقع: https://prperhour.com

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
