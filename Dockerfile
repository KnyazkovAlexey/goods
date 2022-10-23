FROM yiisoftware/yii2-php:8.1-apache

CMD composer install
CMD chmod 777 /app/web/assets
