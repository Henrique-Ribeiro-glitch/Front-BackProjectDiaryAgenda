<?php

namespace App\Domain\Diary\Service;

use App\Domain\Diary\Repository\DiaryReaderRepository;
use App\Domain\Diary\Model\Diary;
use App\Exception\ValidationException;

final class DiaryReader
{

    private $repository;

    public function __construct(DiaryReaderRepository $repository)
    {
      $this->repository = $repository;
    }

    public function getDiaryById(int $diaryId): Diary
    {
      if(empty($diaryId)) {
        throw new ValidationException('diary code required!');
      }

      $diary = $this->repository->getDiaryById($diaryId);

      return $diary;

    }

}
