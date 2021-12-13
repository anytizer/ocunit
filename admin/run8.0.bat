@ECHO OFF
CLS
REM net start mysql
REM net start apache2.4
REM
REM Windows too supports Linux styled path names

cd ../catalog
php ../phpunit.phar ../catalog

cd admin
php ../phpunit.phar ../cases

REM PAUSE
