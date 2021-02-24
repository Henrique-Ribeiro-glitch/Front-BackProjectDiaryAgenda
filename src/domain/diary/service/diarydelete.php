<?php

namespace App\Domain\Diary\Service;

use App\Domain\Diary\Repository\DiaryDeleteRepository;
use App\Domain\Diary\Model\Diary;
use App\Exception\ValidationException;

final class DiaryDelete
{

    private $repository;

    public function __construct(DiaryDeleteRepository $repository)
    {
      $this->repository = $repository;
    }

    public function deleteById(int $diaryId): int
    {
      if(empty($diaryId)) {
        throw new ValidationException('Diary code require!');
      }

      $rowCount = $this->repository->deleteById($diaryId);

      return $rowCount;

    }

}
