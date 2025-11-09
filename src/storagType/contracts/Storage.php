<?php
namespace App\storagType\contracts;

interface Storage{
    public function insert ($tableName , $data);
    public function getAll($tableName): array;
    public function getByFeild($tableName,$key,$ware):array;

    public function delete($tableName,$id):bool;

    public function checkUserpassword($tableName , $key , $password):bool;

    public function getAllbyware($tableName,$key,$ware):array;

    public function getPostWithUser($tableName,$id);

    public function getAllPostsWithDetails():array;

    public function getUserTotals($id):array;
}