<?php
use \PDO as PDO;

/**
 * Path where your OpenCart is installed.
 */
$opencart_upload = "../opencart/upload";
require_once("{$opencart_upload}/config.php");


/**
 * Silently load admin configurations too.
 */
ob_start();
require_once("{$opencart_upload}/admin/config.php");
ob_end_clean();

/**
 * Mimicry of basic database wrapper
 */
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
                //PDO::MYSQL_ATTR_SSL_KEY  => '/path/to/client-key.pem',
                //PDO::MYSQL_ATTR_SSL_CERT => '/path/to/client-cert.pem',
                //PDO::MYSQL_ATTR_SSL_CA   => '/path/to/ca-cert.pem',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            )
        );
    }

    /**
     * Queries that return the data
     */
    public function query($sql='', $data=[])
    {
        $statement = $this->dbh->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,]);
        $statement->execute($data);

        /**
         * Return the data
         */
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Fire-only queries - like: insert, update, delete
     */
    public function raw($sql='', $data=[])
    {
        $statement = $this->dbh->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,]);
        $statement->execute($data);
    }
}

require_once("vendor/autoload.php");
