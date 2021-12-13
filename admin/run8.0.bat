@ECHO OFF

cd admin

REM ../vendor/bin/phpstan analyse ./
php ../phpunit.phar cases

pause
