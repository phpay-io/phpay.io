FROM php:8.2-cli-alpine

RUN apk add --no-cache \
    curl \
    bash \
    nodejs \
    npm

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update


WORKDIR /usr/src/app
COPY . .

RUN composer install --prefer-dist