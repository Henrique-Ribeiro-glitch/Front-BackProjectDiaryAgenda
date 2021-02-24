<?php

namespace App\Domain\Agenda\Service;

use App\Domain\Agenda\Repository\AgendaDeleteRepository;
use App\Domain\Agenda\Model\Agenda;
use App\Exception\ValidationException;

final class AgendaDelete
{

    private $repository;

    public function __construct(AgendaDeleteRepository $repository)
    {
      $this->repository = $repository;
    }

    public function deleteById(int $agendaId): int
    {
      if(empty($agendaId)) {
        throw new ValidationException('código do usuário requerido!');
      }

      $rowCount = $this->repository->deleteById($agendaId);

      return $rowCount;

    }

}
