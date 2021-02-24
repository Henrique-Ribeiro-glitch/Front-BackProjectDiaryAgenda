<?php

namespace App\Domain\Agenda\Service;

use App\Domain\Agenda\Repository\AgendaListRepository;

final class AgendaList
{

    private $repository;

    public function __construct(AgendaListRepository $repository)
    {
      $this->repository = $repository;
    }

    public function findAll()
    {
      $agendas = $this->repository->findAll();

      return $agendas;
    }


}
