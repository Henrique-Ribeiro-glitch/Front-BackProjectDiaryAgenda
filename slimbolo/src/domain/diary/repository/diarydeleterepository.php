<?php

namespace App\Domain\Diary\Repository;

use PDO;
use App\Domain\Diary\Model\Diary;
use DomainException;

class DiaryDeleteRepository
{
  private $connection;

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  public function deleteById(int $diaryId): int
  {

    $sql = "DELETE FROM diarys WHERE id = :id;";

    $statement = $this->connection->prepare($sql);
    $statement->execute(['id' => $diaryId]);

    return (int) $statement->rowCount();
  }
}
