<?php

namespace App\Action;

use App\Domain\Agenda\Service\AgendaCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AgendaCreateAction
{
  
  private $agendaCreator;

  public function __construct(AgendaCreator $agendaCreator)
  {
    $this->agendaCreator = $agendaCreator;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response
  ): ResponseInterface {

    $data = (array) $request->getParsedBody();

    $agendaId = $this->agendaCreator->createAgenda($data);

    $result = [
      'agenda_id' => $agendaId
    ];

    $response->getBody()->write((string)json_encode($result));

    return $response
    ->withHeader('Content-Type', 'application/json')
    ->withStatus(201);

  }
}
