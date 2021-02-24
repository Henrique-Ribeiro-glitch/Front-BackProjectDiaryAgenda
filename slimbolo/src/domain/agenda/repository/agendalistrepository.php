<?php

namespace App\Domain\Agenda\Repository;

use PDO;
use App\Domain\Agenda\Model\Agenda;

class AgendaListRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function findAll()
  {

    $sql = "SELECT id, appointment, date, start_time, end_time, importance, urgency FROM agendas;";

    $statement = $this->connection->prepare($sql);
    $statement->execute();

    $rows = $statement->fetchAll();

    $agendas = [];
    foreach($rows as $row) {
      $agenda = new Agenda();

      $agenda->id = (int) $row['id'];
      $agenda->appointment = (string) $row['appointment'];
      $agenda->date = (string) $row['date'];
      $agenda->startTime = (string) $row['start_time'];
      $agenda->endTime = (string) $row['end_time'];
      $agenda->importance = (string) $row['importance'];
      $agenda->urgency = (string) $row['urgency'];

      $agendas[] = $agenda;
    }

    return $agendas;

  }
}
