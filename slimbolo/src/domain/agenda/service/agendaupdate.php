<?php

namespace App\Domain\Agenda\Service;

use App\Domain\Agenda\Repository\AgendaUpdateRepository;
use App\Exception\ValidationException;

final class AgendaUpdate
{

    private $repository;

    public function __construct(AgendaUpdateRepository $repository)
    {
      $this->repository = $repository;
    }

    public function updateAgenda(array $data): int
    {
      $this->validateNewAgenda($data);


      $rowCount = $this->repository->updateAgenda($data);

      return $rowCount;

    }

      private function validateNewAgenda(array $data): void
      {
        $errors = [];

        if(empty($data['appointment'])) {
          $errors['appointment'] = 'Precisa digitar o compromisso';
        }

        if(empty($data['date'])) {
          $errors['date'] = 'Precisa digitar a data';
        }

        if(empty($data['start_time'])) {
          $errors['start_time'] = 'Precisa digitar a hora inicio';
        }

        if(empty($data['end_time'])) {
          $errors['end_time'] = 'Precisa digitar a hora de termino';
        }

        if(empty($data['importance'])) {
          $errors['importance'] = 'Precisa digitar a importançia do compromisso';
        }

        if(empty($data['urgency'])) {
          $errors['urgency'] = 'Precisa digitar a urgencia do compromisso';
        }

        if($errors) {
          throw new ValidationException('Por favor verifique os dados digitados', $errors);
        }
      }
}
