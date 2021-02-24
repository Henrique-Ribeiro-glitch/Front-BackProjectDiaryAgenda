<?php

namespace App\Domain\User\Repository;

use PDO;

class UserCreatorRepository
{
  
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function insertUser(array $user): int
  {
    $row = [
      'username' => $user['username'],
      'password' => $user['password'],
      'first_name' => $user['first_name'],
      'last_name' => $user['last_name'],
      'email' => $user['email'],
    ];

    $sql = "INSERT INTO users SET
            username=:username,
            password=:password,
            first_name=:first_name,
            last_name=:last_name,
            email=:email;";

    $this->connection->prepare($sql)->execute($row);

    return (int) $this->connection->lastInsertId();

  }
}
