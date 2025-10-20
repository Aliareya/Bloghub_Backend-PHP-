<?php
namespace app\repositories;

use app\repositories\storageTypes\contracts\Storage;

class BaseRepository{
  private $connection;
  public string $tableName;
  public Storage $storage;

  public function store(array $data){
   return $this->storage->insert($this->tableName , $data);
  }







}
