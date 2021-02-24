<?php

namespace App\Action;

use App\Domain\Agenda\Service\AgendaUpdate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AgendaUpdateAction
{
  private $agendaUpdate;

  public function __construct(AgendaUpdate $agendaUpdate)
  {
    $this->agendaUpdate = $agendaUpdate;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response
    ): ResponseInterface {

      $data = (array) $request->getParsedBody();

      $rowCount = $this->agendaUpdate->updateAgenda($data);

      $result = [
        'success' => $rowCount == 1 ? true : false
      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);

    }
}
