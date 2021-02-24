<?php

namespace App\Domain\User\Repository;

use PDO;

class UserUpdateRepository
{

  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function updateUser(array $user): int
  {
    $row = [
      'id' => $user['id'],
      'username' => $user['username'],
      'password' => $user['password'],
      'first_name' => $user['first_name'],
      'last_name' => $user['last_name'],
      'email' => $user['email'],
    ];

    $sql = "UPDATE users SET
            username=:username,
            password=:password,
            first_name=:first_name,
            last_name=:last_name,
            email=:email
            WHERE id=:id;";

    $statement = $this->connection->prepare($sql);
    $statement->execute($row);

    return (int) $statement->rowCount();
    
  }
}
