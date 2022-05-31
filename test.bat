@ECHO OFF
REM net start mysql
REM net start apache2.4
REM
REM Windows too supports Linux styled path names
php phpunit-9.5.20.phar admin/cases/admin
php phpunit-9.5.20.phar catalog/cases/catalog
REM PAUSE
