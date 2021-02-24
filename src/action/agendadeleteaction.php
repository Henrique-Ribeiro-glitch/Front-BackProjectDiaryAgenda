<?php

namespace App\Action;

use App\Domain\Agenda\Service\AgendaDelete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AgendaDeleteAction
{
  private $agendaDelete;

  public function __construct(AgendaDelete $agendaDelete)
  {
    $this->agendaDelete = $agendaDelete;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args = []
    ): ResponseInterface {

      $agendaId = (int) $args['id'];

      $rowCount = $this->agendaDelete->deleteById($agendaId);

      $result = [
        'success' => $rowCount == 1 ? true : false
      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);

    }
}
