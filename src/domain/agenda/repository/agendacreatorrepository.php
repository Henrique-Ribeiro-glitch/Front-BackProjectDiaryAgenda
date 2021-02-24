<?php

namespace App\Domain\Agenda\Repository;

use PDO;

class AgendaCreatorRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function insertAgenda(array $agenda): int
  {
    $row = [
      'appointment' => $agenda['appointment'],
      'date' => $agenda['date'],
      'start_time' => $agenda['start_time'],
      'end_time' => $agenda['end_time'],
      'importance' => $agenda['importance'],
      'urgency' => $agenda['urgency'],
    ];

    $sql = "INSERT INTO agendas SET
            appointment=:appointment,
            date=:date,
            start_time=:start_time,
            end_time=:end_time,
            importance=:importance,
            urgency=:urgency;";

    $this->connection->prepare($sql)->execute($row);

    return (int) $this->connection->lastInsertId();

  }
}
