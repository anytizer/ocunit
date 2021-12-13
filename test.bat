@ECHO OFF
CLS
REM net start mysql
REM net start apache2.4
REM
REM Windows too supports Linux styled path names
php phpunit.phar admin/cases/admin
php phpunit.phar catalog/cases/catalog
REM PAUSE
