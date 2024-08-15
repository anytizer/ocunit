@ECHO OFF
mysqldump --routines -h192.168.1.250 -uadmin -p opencart > opencart.dmp
PAUSE