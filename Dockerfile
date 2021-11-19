FROM php:7.2-apache

RUN a2enmod rewrite

RUN docker-php-ext-install mysqli

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo pdo_mysql


