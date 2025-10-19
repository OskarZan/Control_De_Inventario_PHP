FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# --- ¡LÍNEA CORREGIDA! ---
# Copia todo desde la raíz del repo ('.') al servidor web
COPY . /var/www/html/

# Le dice a Apache que busque "listado.php" como archivo principal
RUN echo "DirectoryIndex listado.php" > /var/www/html/.htaccess

EXPOSE 80