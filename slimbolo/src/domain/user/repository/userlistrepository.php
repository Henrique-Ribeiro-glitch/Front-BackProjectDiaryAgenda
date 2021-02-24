<?php

namespace App\Domain\User\Repository;

use PDO;
use App\Domain\User\Model\User;

class UserListRepository
{
  
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function findAll()
  {

    $sql = "SELECT id, username, password, first_name, last_name, email FROM users;";

    $statement = $this->connection->prepare($sql);
    $statement->execute();

    $rows = $statement->fetchAll();

    $users = [];
    foreach($rows as $row) {
      $user = new User();

      $user->id = (int) $row['id'];
      $user->username = (string) $row['username'];
      $user->password = (string) $row['password'];
      $user->firstName = (string) $row['first_name'];
      $user->lastName = (string) $row['last_name'];
      $user->email = (string) $row['email'];

      $users[] = $user;
    }

    return $users;

  }
}
