<?PHP
namespace App\Core;

use Medoo\Medoo;

class Database {
    private static ?Medoo $connection = null;

    public static function getInstance(): Medoo {
        if (self::$connection === null) {
            self::$connection = new Medoo([
                'type' => 'mysql',
                'host' => 'localhost',
                'database' => 'blogpostoop',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8mb4',
            ]);
        }

        return self::$connection;
    }
}

