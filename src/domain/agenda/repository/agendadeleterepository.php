<?php

namespace App\Domain\Agenda\Repository;

use PDO;
use App\Domain\Agenda\Model\Agenda;
use DomainException;

class AgendaDeleteRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function deleteById(int $agendaId): int
  {

    $sql = "DELETE FROM agendas WHERE id = :id;";

    $statement = $this->connection->prepare($sql);
    $statement->execute(['id' => $agendaId]);

    return (int) $statement->rowCount();
  }
}
