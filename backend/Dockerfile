FROM php:8.2-apache

# Extensión para conectar con MySQL
RUN docker-php-ext-install mysqli

# Copiamos backend y frontend dentro del servidor web
COPY backend/ /var/www/html/backend/
COPY frontend/ /var/www/html/frontend/

# Carpeta de subida de archivos con permisos de escritura
RUN mkdir -p /var/www/html/backend/uploads && chmod -R 777 /var/www/html/backend/uploads

# Al entrar a la raíz del sitio, redirige automáticamente al frontend
RUN echo '<?php header("Location: frontend/index.html"); ?>' > /var/www/html/index.php

EXPOSE 80
