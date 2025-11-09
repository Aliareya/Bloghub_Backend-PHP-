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

    public function getByusername($ware,$id="username"): array{
        return $this->storage->getAllbyware($this->tableName , $id ,$ware );
    }

    public function where($key , $were): array{
        return $this->storage->getByFeild($this->tableName ,$key, $were);
    }

    public function delete($id): bool{
        return $this->storage->delete($this->tableName , $id);
    }

    public function PasswordCheck($username , $password){
        return $this->storage->checkUserpassword($this->tableName , $username , $password);
    }

    public function getsinglePost($id){
        return $this->storage->getPostWithUser($this->tableName , $id);
    }

    public function getalldetailsOFPost(){
        return $this->storage->getAllPostsWithDetails();
    }

    public function getUserActivityById($id){
        return $this->storage->getUserTotals( $id);
    }


 

}