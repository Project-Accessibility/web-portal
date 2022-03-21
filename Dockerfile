FROM php:8.1

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get update -y && apt-get install -y --no-install-recommends openssl zip unzip git nodejs

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions @composer curl gd mbstring openssl fileinfo mysqli pdo_mysql zip

COPY . /app
WORKDIR /app

RUN composer install
RUN npm i -g yarn
RUN yarn install
RUN yarn prod
RUN rm -rf node_modules/

RUN cp -a .env.example .env
RUN php artisan key:generate

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*



CMD php artisan queue:work \
  & php artisan serve --host=0.0.0.0 --port=8080 \
  & php artisan migrate

EXPOSE 8080
