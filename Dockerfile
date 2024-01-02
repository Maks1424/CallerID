
FROM php:apache

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY . /var/www/html

RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]





