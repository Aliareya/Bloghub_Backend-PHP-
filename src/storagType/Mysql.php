<?php
namespace App\storagType;

use App\storagType\contracts\Storage;
use Medoo\Medoo;
class Mysql implements Storage{
  

  public function __construct(Medoo $medoo){
    $this->medoo = $medoo;
  }  
  public function insert($tableName, $data){
    return $data;
  }
}