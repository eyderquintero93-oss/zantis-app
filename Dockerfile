FROM php:8.2-apache

# Instalar extensión mysqli
RUN docker-php-ext-install mysqli

# Copiar el proyecto
COPY . /var/www/html/

# Configurar Apache para que lea /html como la raíz
ENV APACHE_DOCUMENT_ROOT /var/www/html/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

EXPOSE 80