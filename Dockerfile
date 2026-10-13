FROM php:8.2-apache

# Instalar extensión mysqli para la conexión a la base de datos
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copiar el código del proyecto al servidor Apache
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 80