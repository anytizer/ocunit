<?php
namespace library;

use \PDO as PDO;

/**
 * Mimicry of basic database wrapper
 */
class MySQLPDO
{
    private $connection = null;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->connection = new PDO(
            'mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE.';port=3306;',
            DB_USERNAME,
            DB_PASSWORD,
            array(
                // PDO::MYSQL_ATTR_SSL_KEY  => '/path/to/client-key.pem',
                // PDO::MYSQL_ATTR_SSL_CERT => '/path/to/client-cert.pem',
                // PDO::MYSQL_ATTR_SSL_CA   => '/path/to/ca-cert.pem',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            )
        );
    }

    /**
     * Queries that return the data - like: select, count, show
     */
    public function query($sql='', $data=[])
    {
        $statement = $this->connection->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,]);
        $statement->execute($data);

        /**
         * Return the data
         */
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Fire-only queries - like: insert, update, delete, replace
     */
    public function raw($sql='', $data=[])
    {
        $statement = $this->connection->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,]);
        $statement->execute($data);
    }
}