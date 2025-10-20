<?php
namespace app\core;

use PDO;
use PDOException;

class Database {
    private static string $hostname = "localhost";
    private static string $username = "root";
    private static string $password = "";
    private static string $dbname = "blogpost";
    public static ?PDO $connection = null;

    public static function connection(): PDO {
        if (empty(self::$connection) || !self::$connection instanceof PDO || self::$connection === null) {
            try {
                $dns = "mysql:host=". self::$hostname .";dbname=". self::$dbname .";charset=utf8mb4";
                self::$connection = new PDO($dns, self::$username, self::$password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
