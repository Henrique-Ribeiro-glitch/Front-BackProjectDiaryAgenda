<?php

namespace App\Action;

use App\Domain\Diary\Service\DiaryList;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DiaryListAction
{
  
  private $diaryList;

  public function __construct(DiaryList $diaryList)
  {
    $this->diaryList = $diaryList;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response
  ): ResponseInterface {

    $diarys = $this->diaryList->findAll();

    $result = [
      'diarys' => $diarys
    ];

    $response->getBody()->write((string)json_encode($result));

    return $response
    ->withHeader('Content-Type', 'application/json')
    ->withStatus(200);

  }
}
