<?php

namespace ocunit\library;

use PDO;
use PDOStatement;

/**
 * Basic database wrapper without exceptions.
 * Expecting a true connection each time you start this class.
 *
 * Always connects to the opencart database.
 */
class MySQLPDO
{
    private PDO $connection;

    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE . ";port=" . DB_PORT . ";";
        $this->connection = new PDO(
            $dsn,
            DB_USERNAME,
            DB_PASSWORD,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4;",
            ]
        );
    }

    /**
     * Use carefully and responsibly.
     * @return mixed
     */
    public function _id()
    {
        return $this->query("SELECT LAST_INSERT_ID() id;")[0]["id"];
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