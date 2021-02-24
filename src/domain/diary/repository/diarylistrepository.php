<?php

namespace App\Domain\Diary\Repository;

use PDO;
use App\Domain\Diary\Model\Diary;

class DiaryListRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function findAll()
  {

    $sql = "SELECT id, date, hour, objectives, goals, thingsDone, thingsLeftUndone, thingsToThanks FROM diarys;";
    $statement = $this->connection->prepare($sql);
    $statement->execute();

    $rows = $statement->fetchAll();

    $diarys = [];
    foreach($rows as $row) {
      $diary = new Diary();

      $diary->id = (int) $row['id'];
      $diary->date = (string) $row['date'];
      $diary->hour = (string) $row['hour'];
      $diary->objectives = (string) $row['objectives'];
      $diary->goals = (string) $row['goals'];
      $diary->thingsDone = (string) $row['thingsDone'];
      $diary->thingsLeftUndone = (string) $row['thingsLeftUndone'];
      $diary->thingsToThanks = (string) $row['thingsToThanks'];

      $diarys[] = $diary;
    }

    return $diarys;

  }
}
