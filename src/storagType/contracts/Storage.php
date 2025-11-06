<?php
namespace App\storagType\contracts;

interface Storage{
    public function insert ($tableName , $data);
    public function getAll($tableName): array;
    public function getByware($tableName,$ware):array;

    public function delete($tableName,$id):bool;
}