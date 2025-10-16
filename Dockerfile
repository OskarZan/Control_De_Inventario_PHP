FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copia los archivos del proyecto (todo el código en la raíz del repo)
COPY . /var/www/html/

EXPOSE 80