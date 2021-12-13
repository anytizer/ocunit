<?php

namespace ocunit\library;

use \PDO as PDO;

/**
 * Basic database wrapper without exceptions.
 * Expecting a true connection each time you start this class.
 *
 * Always connects to only-opencart database.
 */
class MySQLPDO
{
    private PDO $connection;

    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE . ";port=3306;";
        $this->connection = new PDO(
            $dsn,
            DB_USERNAME,
            DB_PASSWORD,
            array(
                // PDO::MYSQL_ATTR_SSL_KEY  => "/path/to/client-key.pem",
                // PDO::MYSQL_ATTR_SSL_CERT => "/path/to/client-cert.pem",
                // PDO::MYSQL_ATTR_SSL_CA   => "/path/to/ca-cert.pem",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            )
        );
    }

    /**
     * Queries that return the data - like: select, count, show
     */
    public function query($sql = "", $data = [])
    {
        $statement = $this->connection->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,]);
        $statement->execute($data);

        /**
         * Return the data
         */
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fire-only queries - like: insert, update, delete, replace
     */
    public function raw($sql = "", $data = []): void
    {
        $statement = $this->connection->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,]);
        $statement->execute($data);
    }
}