<?php

namespace App\Domain\User\Repository;

use PDO;
use App\Domain\User\Model\User;
use DomainException;

class UserReaderRepository
{
  
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function getUserById(int $userId): User
  {

    $sql = "SELECT id, username, password, first_name, last_name, email FROM users WHERE id = :id;";
    $statement = $this->connection->prepare($sql);
    $statement->execute(['id' => $userId]);

    $row = $statement->fetch();

    $user = new User();
    $user->id = (int) $row['id'];
    $user->username = (string) $row['username'];
    $user->password = (string) $row['password'];
    $user->firstName = (string) $row['first_name'];
    $user->lastName = (string) $row['last_name'];
    $user->email = (string) $row['email'];

    return $user;

  }
}
