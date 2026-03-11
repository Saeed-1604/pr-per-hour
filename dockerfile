FROM php:8.3-apache

# تحديث الحزم وتثبيت الأدوات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev

# تثبيت إضافات PHP المطلوبة
RUN docker-php-ext-install pdo_mysql mysqli zip gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تفعيل mod_rewrite في Apache
RUN a2enmod rewrite

# نسخ ملفات المشروع إلى مجلد Apache
COPY . /var/www/html/
COPY --chown=www-data:www-data . /var/www/html/

# تثبيت dependencies المشروع باستخدام Composer
RUN cd /var/www/html && composer install --no-interaction --optimize-autoloader --no-dev

# ضبط الصلاحيات للمجلدات المهمة
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# تعيين المجلد الرئيسي لـ Apache ليكون مجلد public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# تحديث إعدادات Apache لاستخدام المجلد الصحيح
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# فتح المنفذ 80
EXPOSE 80
