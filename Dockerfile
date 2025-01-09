FROM php:8.2-fpm

# Instalar extensiones necesarias para PostgreSQL y otras dependencias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    zip \
    build-essential \  
    python3 \          
    && docker-php-ext-install pdo_pgsql zip

# Instalar Node.js y npm (versión 18)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Configuración del directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto, excluyendo node_modules
COPY . .

# Instalar dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar dependencias de Node.js
RUN npm install

# Construir estilos con Vite
RUN npm run build

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer el puerto 9000 y ejecutar PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
