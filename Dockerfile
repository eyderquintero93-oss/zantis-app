FROM php:8.2-apache

# Instalar extensión mysqli para la conexión a la base de datos MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copiar todo el proyecto al contenedor
COPY . /var/www/html/

# Configurar Apache para que lea los archivos de la carpeta /html como raíz principal
ENV APACHE_DOCUMENT_ROOT /var/www/html/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

EXPOSE 80