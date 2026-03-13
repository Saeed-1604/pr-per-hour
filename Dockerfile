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

# تفعيل mod_rewrite وإلغاء تحميل MPMات متعددة
RUN a2enmod rewrite
RUN a2dismod mpm_event || true
RUN a2enmod mpm_prefork

# نسخ المشروع
COPY . /var/www/html/
COPY --chown=www-data:www-data . /var/www/html/

# تثبيت dependencies المشروع
RUN cd /var/www/html && composer install --no-interaction --optimize-autoloader --no-dev

# ضبط الصلاحيات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# نسخ ملف البيئة وتوليد المفتاح
RUN cp /var/www/html/.env.example /var/www/html/.env || true
RUN cd /var/www/html && php artisan key:generate

EXPOSE 80
