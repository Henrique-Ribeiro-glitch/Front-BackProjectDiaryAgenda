<?php

namespace App\Action;

use App\Domain\Diary\Service\DiaryReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DiaryReaderAction
{
  private $diaryReader;

  public function __construct(DiaryReader $diaryReader)
  {
    $this->diaryReader = $diaryReader;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args = []
    ): ResponseInterface {

      $diaryId = (int) $args['id'];

      $diary = $this->diaryReader->getDiaryById($diaryId);

      $result = [
        'diary_id' => $diary->id,
        'date' => $diary->date,
        'hour' => $diary->hour,
        'objectives' => $diary->objectives,
        'goals' => $diary->goals,
        'thingsDone' => $diary->thingsDone,
        'thingsLeftUndone' => $diary->thingsLeftUndone,
        'thingsToThanks' => $diary->thingsToThanks,

      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);

    }
}
