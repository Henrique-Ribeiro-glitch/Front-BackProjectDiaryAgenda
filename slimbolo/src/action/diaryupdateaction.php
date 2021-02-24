<?php

namespace App\Action;

use App\Domain\Diary\Service\DiaryUpdate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DiaryUpdateAction
{
  private $diaryUpdate;

  public function __construct(DiaryUpdate $diaryUpdate)
  {
    $this->diaryUpdate = $diaryUpdate;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response
    ): ResponseInterface {

      $data = (array) $request->getParsedBody();

      $rowCount = $this->diaryUpdate->updateDiary($data);

      $result = [
        'success' => $rowCount == 1 ? true : false
      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);

    }
}
