FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# --- ¡CAMBIO CLAVE! ---
# Copia solo el contenido de tu subcarpeta al servidor web
COPY Control_De_Inventario_PHP/ /var/www/html/

# Le dice a Apache que busque "listado.php" como archivo principal
RUN echo "DirectoryIndex listado.php" > /var/www/html/.htaccess

EXPOSE 80