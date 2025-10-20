<?php
namespace app\repositories\storageTypes;
use app\repositories\storageTypes\contracts\Storage;

class MongoDB implements Storage{
  public function insert(string $tableNaem, array $data){
    echo "MongoDB";
  }
}