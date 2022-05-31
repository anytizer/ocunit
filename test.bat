@ECHO OFF
REM net start mysql
REM net start apache2.4
REM
REM Windows too supports Linux styled path names
cd admin
php ../phpunit.phar cases/admin

cd ../catalog
php ../phpunit.phar cases/catalog

PAUSE
