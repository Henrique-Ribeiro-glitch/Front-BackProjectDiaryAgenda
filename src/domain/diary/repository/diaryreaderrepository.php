<?php

namespace App\Domain\Diary\Repository;

use PDO;
use App\Domain\Diary\Model\Diary;
use DomainException;

class DiaryReaderRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function getDiaryById(int $diaryId): Diary
  {

    $sql = "SELECT id, date, hour, objectives, goals, thingsDone, thingsLeftUndone, thingsToThanks FROM diarys WHERE id = :id;";
    $statement = $this->connection->prepare($sql);
    $statement->execute(['id' => $diaryId]);

    $row = $statement->fetch();

    $diary = new Diary();
    $diary->id = (int) $row['id'];
    $diary->date = (string) $row['date'];
    $diary->hour = (string) $row['hour'];
    $diary->objectives = (string) $row['objectives'];
    $diary->goals = (string) $row['goals'];
    $diary->thingsDone = (string) $row['thingsDone'];
    $diary->thingsLeftUndone = (string) $row['thingsLeftUndone'];
    $diary->thingsToThanks = (string) $row['thingsToThanks'];

    return $diary;

  }
}
