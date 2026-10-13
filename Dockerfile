FROM php:8.2-apache

# Instalar extensión mysqli
RUN docker-php-ext-install mysqli

# Copiar todo el proyecto al contenedor
COPY . /var/www/html/

# Configurar Apache para que busque index.html dentro de /html/ por defecto
RUN echo "DirectoryIndex html/index.html html/index.php index.php index.html" >> /etc/apache2/apache2.conf

EXPOSE 80