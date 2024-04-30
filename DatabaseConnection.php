<?php

class DatabaseConnection
{
    protected static ?PDO $connection = null;

    private function __construct()
    {
        // Private constructor to prevent instantiation
    }

    public static function connect(): PDO
    {
        try {
            if (!self::$connection) {
                $host = 'localhost';
                $dbname = 'dpr';
                $username = 'root';
                $password = '';

                $dsn = "mysql:host=$host;dbname=$dbname";
                self::$connection = new PDO($dsn, $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$connection;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }
}
