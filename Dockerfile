FROM php:8.3-apache

# تثبيت الإضافات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev

RUN docker-php-ext-install pdo_mysql mysqli zip gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ المشروع أولاً
COPY . /var/www/html/
COPY --chown=www-data:www-data . /var/www/html/

# تثبيت dependencies المشروع
RUN cd /var/www/html && composer install --no-interaction --optimize-autoloader --no-dev

# تفعيل mod_rewrite وإصلاح مشكلة MPM
RUN a2enmod rewrite

# إلغاء تحميل جميع MPMs أولاً ثم تفعيل prefork فقط
RUN a2dismod mpm_worker || true
RUN a2dismod mpm_event || true
RUN a2dismod mpm_prefork || true
RUN a2enmod mpm_prefork

# إنشاء ملف تكوين Apache مخصص لضمان عدم تحميل MPMs متعددة
RUN echo '<IfModule mpm_prefork_module>\n    StartServers 2\n    MinSpareServers 2\n    MaxSpareServers 5\n    MaxRequestWorkers 20\n    MaxConnectionsPerChild 0\n</IfModule>' > /etc/apache2/mods-available/mpm_prefork.conf

# إعداد Apache للمشروع
RUN echo '<VirtualHost *:80>\n    DocumentRoot /var/www/html/public\n    <Directory /var/www/html/public>\n        AllowOverride All\n        Require all granted\n    </Directory>\n    ErrorLog ${APACHE_LOG_DIR}/error.log\n    CustomLog ${APACHE_LOG_DIR}/access.log combined\n</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# إزالة أي ملفات تكوين قد تسبب تعارضات
RUN rm -f /etc/apache2/sites-enabled/000-default.conf
RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# التأكد من أن Apache يعمل بشكل صحيح
RUN apache2ctl configtest || true

# توليد المفتاح وإعداد .env
RUN cp /var/www/html/.env.example /var/www/html/.env || true
RUN cd /var/www/html && php artisan key:generate

# ضبط الصلاحيات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# تشغيل Apache في النهاية
CMD ["apache2-foreground"]
