<?php
namespace app\repositories;

use app\core\Database;
use app\repositories\storageTypes\contracts\Storage;
use app\repositories\storageTypes\Mysql;

class UserRepository extends BaseRepository {
    public string $tableName = "users";
    private  $connection;
    public Storage $storage;

    public function __construct() {
      $this->connection = Database::connection();
      $this->storage = new Mysql($this->connection);
    }

    // public function getAllUsers() {
    //   $stmt = $this->db->query("SELECT * FROM users");
    //   return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getUserById(int $id) {
    //   $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
    //   $stmt->execute(['id' => $id]);
    //   return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
}
