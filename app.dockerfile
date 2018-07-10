# FROM php:7.1.19-fpm

# RUN apt-get update && apt-get install -y git && apt-get install -y libmcrypt-dev \
#     mysql-client libmagickwand-dev --no-install-recommends \
#     && pecl install imagick \
#     && docker-php-ext-enable imagick \
#     && docker-php-ext-install mcrypt pdo_mysql

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

FROM php:7.2.6-apache-stretch

WORKDIR /var/www

RUN apt-get update 
RUN apt-get install mc nano -y
RUN apt-get install -y zlib1g-dev && docker-php-ext-install zip pdo mysqli pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

RUN useradd -m -d /home/forus forus
RUN a2enmod rewrite

RUN rm -rf /var/www/html

COPY ./ ./
COPY ./_docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R forus:www-data /var/www
RUN chown -R www-data:www-data /var/www/storage
RUN chown -R www-data:www-data /var/www/bootstrap/cache

RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 /var/www/bootstrap/cache

USER forus
RUN composer install --no-dev --no-interaction -o

COPY ./.env.example ./.env
USER root
RUN php artisan key:generate

EXPOSE 80

CMD ["apache2-foreground"]