<?php
namespace App\repositories;

use App\Core\Database;
use App\storagType\contracts\Storage;
use App\storagType\Medoo;

class BaseRepository {
    protected string $tableName;
    private Storage $storage;

    public function __construct(){
        $this->storage = new Medoo(Database::getInstance());

    }

    public function store($data): bool{
       return $this->storage->insert($this->tableName , $data);
    }

    public function getAll(): array{
        return $this->storage->getAll($this->tableName);
    }

    public function getByware($id): array{
        return $this->storage->getByware($this->tableName , $id);
    }

    public function delete($id): bool{
        return $this->storage->delete($this->tableName , $id);
    }
}