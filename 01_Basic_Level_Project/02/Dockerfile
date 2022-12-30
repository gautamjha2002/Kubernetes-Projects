FROM php:8.2.0-apache
COPY ./To-Do-APP/ /var/www/html
# install required php extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
WORKDIR /var/www/html
# Expose port 80 and start the Apache web server
EXPOSE 80
CMD ["apache2-foreground"]