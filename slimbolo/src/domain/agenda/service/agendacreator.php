<?php

namespace App\Domain\Agenda\Service;

use App\Domain\Agenda\Repository\AgendaCreatorRepository;
use App\Exception\ValidationException;

final class AgendaCreator
{

    private $repository;

    public function __construct(AgendaCreatorRepository $repository)
    {
      $this->repository = $repository;
    }

    public function createAgenda(array $data): int
    {
      $this->validateNewAgenda($data);

      $agendaId = $this->repository->insertAgenda($data);

      return $agendaId;

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
        $errors['urgency'] = 'Precisa digitar a urgencia do comrpomisso';
      }

      if($errors) {
        throw new ValidationException('Por favor verifique os dados digitados', $errors);
      }

    }

}
