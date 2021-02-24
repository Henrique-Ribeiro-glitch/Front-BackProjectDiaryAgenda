<?php

namespace App\Action;

use App\Domain\User\Service\UserReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserReaderAction
{
  private $userReader;

  public function __construct(UserReader $userReader)
  {
    $this->userReader = $userReader;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args = []
    ): ResponseInterface {

      $userId = (int) $args['id'];

      $user = $this->userReader->getUserById($userId);

      $result = [
        'user_id' => $user->id,
        'username' => $user->username,
        'password' => $user->password,
        'first_name' => $user->firstName,
        'last_name' => $user->lastName,
        'email' => $user->email,
      ];

      $response->getBody()->write((string)json_encode($result));

      return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(200);

    }
}
