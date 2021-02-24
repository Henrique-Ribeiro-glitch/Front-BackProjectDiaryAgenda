<?php

namespace App\Domain\Diary\Service;

use App\Domain\Diary\Repository\DiaryListRepository;

final class DiaryList
{

    private $repository;

    public function __construct(DiaryListRepository $repository)
    {
      $this->repository = $repository;
    }

    public function findAll()
    {
      $diarys = $this->repository->findAll();

      return $diarys;
    }

}
