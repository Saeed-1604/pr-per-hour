FROM php:8.3-apache

# تثبيت الإضافات المطلوبة
RUN docker-php-ext-install pdo_mysql mysqli

# تفعيل mod_rewrite في Apache
RUN a2enmod rewrite

# نسخ ملفات المشروع إلى مجلد Apache
COPY . /var/www/html/
COPY --chown=www-data:www-data . /var/www/html/

# ضبط الصلاحيات للمجلدات المهمة
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# تعيين المجلد الرئيسي لـ Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80
