<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\CsrfException;

class CsrfGuardMiddleware implements MiddlewareInterface
{
  public function process(callable $next)
  {
    $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    $validMethods = ['POST', 'PATCH', 'DELETE'];

    if (!in_array($requestMethod, $validMethods)) {
      $next();
      return;
    }

    if ($_SESSION['token'] !== $_POST['token']) {
      //redirectTo('/');
      throw new CsrfException('Token from the submission does not match the token submitted with the form.');
    }

    unset($_SESSION['token']);

    $next();
  }
}
