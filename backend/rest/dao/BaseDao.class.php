<?php

require_once __DIR__ . '/../config.php';

class BaseDao
{
    protected $connection;
    private $table;

    public function __construct($table)
    {
        $this->table = $table;
        try {
            $this->connection = new PDO(
                "mysql:host=" . Config::DB_HOST() . ";port=" . Config::DB_PORT() . ";dbname=" . Config::DB_NAME(),
                Config::DB_USER(),
                Config::DB_PASSWORD(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
