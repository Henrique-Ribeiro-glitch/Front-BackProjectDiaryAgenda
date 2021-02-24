<?php

namespace App\Action;

use App\Domain\Agenda\Service\AgendaReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AgendaReaderAction
{
  private $agendaReader;

  public function __construct(AgendaReader $agendaReader)
  {
    $this->agendaReader = $agendaReader;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args = []
    ): ResponseInterface {

      $agendaId = (int) $args['id'];

      $agenda = $this->agendaReader->getAgendaById($agendaId);

      $result = [
        'agenda_id' => $agenda->id,
        'appointment' => $agenda->appointment,
        'date' => $agenda->date,
        'start_time' => $agenda->start_time,
        'end_time' => $agenda->end_time,
        'importance' => $agenda->importance,
        'urgency' => $agenda->urgency,
      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);

    }
}
