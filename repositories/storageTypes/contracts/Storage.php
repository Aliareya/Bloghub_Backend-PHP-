<?php
namespace app\repositories\storageTypes\contracts;

interface Storage{
 public function insert(string $tableName , array $data);
//  public function GetAll():array;
//  public function GetByWhere(string $tableNaem):array;
//  public function Update(string $tableNaem , array $data ):bool;
//  public function Delete(string $tableNaem , string $id):bool;
}