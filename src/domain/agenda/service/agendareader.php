<?php

namespace App\Domain\Agenda\Service;

use App\Domain\Agenda\Repository\AgendaReaderRepository;
use App\Domain\Agenda\Model\Agenda;
use App\Exception\ValidationException;

final class AgendaReader
{

    private $repository;

    public function __construct(AgendaReaderRepository $repository)
    {
      $this->repository = $repository;
    }

    public function getAgendaById(int $agendaId): Agenda
    {
      if(empty($agendaId)) {
        throw new ValidationException('código do usuário requerido!');
      }

      $agenda = $this->repository->getAgendaById($agendaId);

      return $agenda;

    }

}
