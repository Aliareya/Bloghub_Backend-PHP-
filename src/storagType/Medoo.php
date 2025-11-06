<?php
namespace App\storagType;

use App\storagType\contracts\Storage;

class Medoo implements Storage {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function insert($tableName, $data): bool {
        $result = $this->connection->insert($tableName, $data);
        return $result->rowCount() > 0;
    }

    public function getAll($tableName): array {
        return $this->connection->select($tableName , "*");
    }

    public function getByware($tableName , $ware): array{
        return $this->connection->select($tableName , "*" , ["id"=>$ware]);
    }

    public function delete($tableName, $id): bool {
        $result = $this->connection->delete($tableName, $id);
        return $result->rowCount() > 0;
    }


}
