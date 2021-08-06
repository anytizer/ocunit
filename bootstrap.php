<?php
use \PDO as PDO;

/**
 * Path where your OpenCart is installed.
 */
$opencart_upload = "D:/htdocs/opencart/upload";
require_once("{$opencart_upload}/config.php");
#require_once("{$opencart_upload}/admin/config.php");

class MySQLPDO
{
    private $dbh = null;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->dbh = new PDO(
            'mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE.';port=3306;',
            DB_USERNAME,
            DB_PASSWORD,
            array(
                //PDO::MYSQL_ATTR_SSL_KEY    =>'/path/to/client-key.pem',
                //PDO::MYSQL_ATTR_SSL_CERT=>'/path/to/client-cert.pem',
                //PDO::MYSQL_ATTR_SSL_CA    =>'/path/to/ca-cert.pem',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            )
        );
    }

    public function query($sql='')
    {
        $statement = $this->dbh->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,]);
        $statement->execute([]);
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

require_once("vendor/autoload.php");
