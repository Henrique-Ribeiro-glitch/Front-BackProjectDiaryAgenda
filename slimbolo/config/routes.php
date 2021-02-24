<?php
use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

return function(App $app) {

    $app->get('/', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
      $response->getBody()->write("Hello World!");

      return $response->withStatus(200);
    });

    $app->post('/agendas',\App\Action\AgendaCreateAction::class);
    $app->get('/agendas',\App\Action\AgendaListAction::class);
    $app->get('/agendas/{id}',\App\Action\AgendaReaderAction::class);
    $app->put('/agendas',\App\Action\AgendaUpdateAction::class);
    $app->delete('/agendas/{id}',\App\Action\AgendaDeleteAction::class);

    $app->post('/diarys',\App\Action\DiaryCreateAction::class);
    $app->get('/diarys',\App\Action\DiaryListAction::class);
    $app->get('/diarys/{id}',\App\Action\DiaryReaderAction::class);
    $app->put('/diarys',\App\Action\DiaryUpdateAction::class);
    $app->delete('/diarys/{id}',\App\Action\DiaryDeleteAction::class);
};
