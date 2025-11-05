<?php
namespace App\repositories;

use App\storagType\contracts\Storage;

class BaseRepository {
    private string $tableName;
    private Storage $storage;

    public function __construct(Storage $storage){
        $this->storage = $storage;
    }

    public function store($data){
       $this->storage->insert($this->tableName , $data);
    }
}