<?php

namespace App\Domain\Agenda\Repository;

use PDO;

class AgendaUpdateRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function updateAgenda(array $agenda): int
  {
    $row = [
      'id' => $agenda['id'],
      'appointment' => $agenda['appointment'],
      'date' => $agenda['date'],
      'start_time' => $agenda['start_time'],
      'end_time' => $agenda['end_time'],
      'importance' => $agenda['importance'],
      'urgency' => $agenda['urgency'],
    ];

    $sql = "UPDATE agendas SET
            appointment=:appointment,
            date=:date,
            start_time=:start_time,
            end_time=:end_time,
            importance=:importance,
            urgency=:urgency
            WHERE id=:id;";

    $statement = $this->connection->prepare($sql);
    $statement->execute($row);

    return (int) $statement->rowCount();
  }
}
