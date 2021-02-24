<?php

namespace App\Action;

use App\Domain\Diary\Service\DiaryDelete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DiaryDeleteAction
{
  private $diaryDelete;

  public function __construct(DiaryDelete $diaryDelete)
  {
    $this->diaryDelete = $diaryDelete;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args = []
    ): ResponseInterface {

      $diaryId = (int) $args['id'];

      $rowCount = $this->diaryDelete->deleteById($diaryId);

      $result = [
        'success' => $rowCount == 1 ? true : false
      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);

    }
}
