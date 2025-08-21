# صورة PHP رسمية
FROM php:8.2-cli

# تثبيت الحزم المطلوبة وامتدادات PHP (منها PostgreSQL)
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libonig-dev \
    libicu-dev libpng-dev libjpeg-dev libfreetype6-dev \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install pdo pdo_pgsql zip gd intl \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# مسار العمل داخل الكونتينر
WORKDIR /var/www

# تثبيت باكجات PHP أولاً للاستفادة من cache
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# نسخ بقية المشروع
COPY . .

# صلاحيات التخزين والكاش
RUN mkdir -p storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Render يمرّر PORT كمتغيّر بيئة
ENV PORT=10000
EXPOSE 10000

# تشغيل السيرفر
CMD ["sh","-c","php artisan serve --host=0.0.0.0 --port=${PORT}"]
