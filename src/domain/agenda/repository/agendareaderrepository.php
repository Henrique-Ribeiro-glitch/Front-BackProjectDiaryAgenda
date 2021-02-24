<?php

namespace App\Domain\Agenda\Repository;

use PDO;
use App\Domain\Agenda\Model\Agenda;
use DomainException;

class AgendaReaderRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function getAgendaById(int $agendaId): Agenda
  {

    $sql = "SELECT id, appointment, date, start_time, end_time, importance, urgency FROM agendas WHERE id = :id;";
    $statement = $this->connection->prepare($sql);
    $statement->execute(['id' => $agendaId]);

    $row = $statement->fetch();

    $agenda = new Agenda();
    $agenda->id = (int) $row['id'];
    $agenda->appointment = (string) $row['appointment'];
    $agenda->date = (string) $row['date'];
    $agenda->start_time = (string) $row['start_time'];
    $agenda->end_time = (string) $row['end_time'];
    $agenda->importance = (string) $row['importance'];
    $agenda->urgency = (string) $row['urgency'];


    return $agenda;
  }
}
