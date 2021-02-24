<?php

namespace App\Domain\Diary\Repository;

use PDO;

class DiaryCreatorRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function insertDiary(array $diary): int
  {
    $row = [
      'date' => $diary['date'],
      'hour' => $diary['hour'],
      'objectives' => $diary['objectives'],
      'goals' => $diary['goals'],
      'thingsDone' => $diary['thingsDone'],
      'thingsLeftUndone' => $diary['thingsLeftUndone'],
      'thingsToThanks' => $diary['thingsToThanks'],
    ];

    $sql = "INSERT INTO diarys SET
            date=:date,
            hour=:hour,
            objectives=:objectives,
            goals=:goals,
            thingsDone=:thingsDone,
            thingsLeftUndone=:thingsLeftUndone,
            thingsToThanks=:thingsToThanks;";

    $this->connection->prepare($sql)->execute($row);

    return (int) $this->connection->lastInsertId();
  }
}
