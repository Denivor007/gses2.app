# Используем образ PHP в качестве базового образа
FROM php:8.1-apache
RUN apt-get update
COPY . /var/www/html
RUN curl -sS https://getcomposer.org/installer | php  --filename=composer
WORKDIR /var/www/html
RUN composer install --no-interaction
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN echo "ServerName gses2.app" >> /etc/apache2/apache2.conf
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
EXPOSE 80
CMD ["apache2-foreground"]
