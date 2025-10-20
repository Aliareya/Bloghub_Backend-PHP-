<?php

namespace app\repositories\storageTypes;

use app\repositories\storageTypes\contracts\Storage;

class Mysql implements Storage
{
  private  $connection;

  public function __construct($connection)
  {
    $this->connection = $connection;
  }

  public function insert(string $tableName, array $data): bool
  {
    if (empty($data)) {
      return false;
    }

    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), '?'));
    $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    $stmt = $this->connection->prepare($sql);

    return $stmt->execute(array_values($data));
  }
  
  



}
