FROM php:8.3.8-fpm

COPY php.ini /usr/local/etc/php/
# COPY docker/php/php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www

# # クーロンジョブファイルのコピー
# COPY my_cron_job /etc/cron.d/my_cron_job

# # クーロンジョブに実行権限を付与
# RUN chmod 0644 /etc/cron.d/my_cron_job

# # クーロンジョブを登録
# RUN crontab /etc/cron.d/my_cron_job

# # クーロンと PHP-FPM を並行して実行
# CMD ["sh", "-c", "cron && php-fpm"]
