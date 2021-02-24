<?php

namespace App\Action;

use App\Domain\Diary\Service\DiaryCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DiaryCreateAction
{

  private $diaryCreator;

  public function __construct(DiaryCreator $diaryCreator)
  {
    $this->diaryCreator = $diaryCreator;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response
  ): ResponseInterface {

    $data = (array) $request->getParsedBody();

    $diaryId = $this->diaryCreator->createDiary($data);

    $result = [
      'diary_id' => $diaryId
    ];

    $response->getBody()->write((string)json_encode($result));

    return $response
    ->withHeader('Content-Type', 'application/json')
    ->withStatus(201);

  }
}
