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

    public function update($tableName, $data, $where): bool {
        $result = $this->connection->update($tableName, $data, $where);
        return $result->rowCount() > 0;
    }

    public function delete($tableName, $where): bool {
        $result = $this->connection->delete($tableName, $where);
        return $result->rowCount() > 0;
    }
}
