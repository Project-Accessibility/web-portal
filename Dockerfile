FROM php:8.1

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get update -y && apt-get install -y --no-install-recommends openssl zip unzip git nodejs

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions @composer curl gd mbstring openssl fileinfo mysqli pdo_mysql zip

ADD ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini

COPY . /app
WORKDIR /app

RUN composer install
RUN npm i -g yarn
RUN yarn install
RUN yarn prod
RUN rm -rf node_modules/

RUN cp -f .env.dist .env
RUN --mount=type=secret,id=MAPBOX_ACCESS_TOKEN,uid=1000 \
    MAPBOX_ACCESS_TOKEN=$(cat /run/secrets/my_secret) \
    && export MAPBOX_ACCESS_TOKEN
RUN echo $MAPBOX_ACCESS_TOKEN \
RUN sed -i "s|MAPBOX_ACCESS_TOKEN=|MAPBOX_ACCESS_TOKEN=$MAPBOX_ACCESS_TOKEN|g" .env
RUN php artisan key:generate

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN chmod +x ./wait-for-it.sh ./docker-entrypoint.sh

ENTRYPOINT ["sh", "./docker-entrypoint.sh"]

CMD php artisan migrate --seed \
  & php artisan storage:link \
  & php artisan queue:work \
  & php artisan serve --host=0.0.0.0 --port=8080

EXPOSE 8080
