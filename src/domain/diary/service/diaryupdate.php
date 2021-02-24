<?php

namespace App\Domain\Diary\Service;

use App\Domain\Diary\Repository\DiaryUpdateRepository;
use App\Exception\ValidationException;

final class DiaryUpdate
{

    private $repository;

    public function __construct(DiaryUpdateRepository $repository)
    {
      $this->repository = $repository;
    }

    public function updateDiary(array $data): int
    {
      $this->validateNewDiary($data);


      $rowCount = $this->repository->updateDiary($data);

      return $rowCount;

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
        throw new ValidationException('Please verify the data you typed', $errors);
      }

    }

}
