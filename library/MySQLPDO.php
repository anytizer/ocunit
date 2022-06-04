<?php

namespace ocunit\library;

use PDO as PDO;
use PDOStatement;

/**
 * Basic database wrapper without exceptions.
 * Expecting a true connection each time you start this class.
 *
 * Always connects to opencart database.
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
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }

    /**
     * Queries that return the data - like: select, count, show
     */
    public function query($sql = "", $data = []): array
    {
        $statement = $this->raw($sql, $data);

        /**
         * Return the data
         */
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fire-only queries - like: insert, update, delete, replace
     */
    public function raw($sql = "", $data = []): PDOStatement
    {
        $statement = $this->connection->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,]);
        $statement->execute($data);

        return $statement;
    }
}