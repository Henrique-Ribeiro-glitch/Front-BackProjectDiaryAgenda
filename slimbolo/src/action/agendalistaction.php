<?php

namespace App\Action;

use App\Domain\Agenda\Service\AgendaList;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AgendaListAction
{
  private $agendaList;

  public function __construct(AgendaList $agendaList)
  {
    $this->agendaList = $agendaList;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response
    ): ResponseInterface {



      $agendas = $this->agendaList->findAll();

      $result = [
        'agendas' => $agendas
      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);

    }
}
