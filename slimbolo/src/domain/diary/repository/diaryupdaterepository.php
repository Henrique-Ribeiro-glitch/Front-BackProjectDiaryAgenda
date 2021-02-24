<?php

namespace App\Domain\Diary\Repository;

use PDO;

class DiaryUpdateRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function updateDiary(array $diary): int
  {
    $row = [
      'id' => $diary['id'],
      'date' => $diary['date'],
      'hour' => $diary['hour'],
      'objectives' => $diary['objectives'],
      'goals' => $diary['goals'],
      'thingsDone' => $diary['thingsDone'],
      'thingsLeftUndone' => $diary['thingsLeftUndone'],
      'thingsToThanks' => $diary['thingsToThanks'],
    ];

    $sql = "UPDATE diarys SET
            date=:date,
            hour=:hour,
            objectives=:objectives,
            goals=:goals,
            thingsDone=:thingsDone,
            thingsLeftUndone=:thingsLeftUndone,
            thingsToThanks=:thingsToThanks
            WHERE id=:id;";

    $statement = $this->connection->prepare($sql);
    $statement->execute($row);

    return (int) $statement->rowCount();
  }
}
