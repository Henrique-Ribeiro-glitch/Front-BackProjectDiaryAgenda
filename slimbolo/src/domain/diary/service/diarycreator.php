<?php

namespace App\Domain\Diary\Service;

use App\Domain\Diary\Repository\DiaryCreatorRepository;
use App\Exception\ValidationException;

final class DiaryCreator
{

    private $repository;

    public function __construct(DiaryCreatorRepository $repository)
    {
      $this->repository = $repository;
    }

    public function createDiary(array $data): int
    {
      $this->validateNewDiary($data);

      $diaryId = $this->repository->insertDiary($data);

      return $diaryId;

    }

    private function validateNewDiary(array $data): void
    {
      $errors = [];

      if(empty($data['date'])) {
       $errors['date'] = 'Type the date';
     }

      if(empty($data['hour'])) {
       $errors['hour'] = 'Type the time';
     }

      if(empty($data['objectives'])) {
       $errors['objectives'] = 'Type the objectives';
     }

      if(empty($data['goals'])) {
       $errors['goals'] = 'Type the goals';
     }

      if(empty($data['thingsDone'])) {
       $errors['thingsDone'] = 'Type the things you done today';
     }

      if(empty($data['thingsToThanks'])) {
       $errors['thingsToThanks'] = 'Type 3 things that you thanks for that happened today';
     }

      if($errors) {
        throw new ValidationException('Please verify what you typed', $errors);
      }

    }

}
