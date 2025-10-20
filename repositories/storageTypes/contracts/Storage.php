<?php
interface Storage{
 public function insert(string $tableNaem , array $data):bool;
//  public function GetAll():array;
//  public function GetByWhere(string $tableNaem):array;
//  public function Update(string $tableNaem , array $data ):bool;
//  public function Delete(string $tableNaem , string $id):bool;
}