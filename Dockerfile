FROM bitnami/laravel:9

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get update -y && apt-get install -y --no-install-recommends openssl zip unzip git nodejs

COPY ./php.ini.local $PHP_INI_DIR/conf.d/
COPY . /app
WORKDIR /app

RUN composer install
RUN npm i -g yarn
RUN yarn install
RUN yarn prod
RUN rm -rf node_modules/

RUN cp -f .env.dist .env
RUN php artisan key:generate
RUN php artisan config:clear

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN chmod +x ./wait-for-it.sh ./docker-entrypoint.sh

ENTRYPOINT ["sh", "./docker-entrypoint.sh"]

CMD php artisan migrate --seed \
  & php artisan queue:work \
  & php artisan serve --host=0.0.0.0 --port=8080

EXPOSE 8080
