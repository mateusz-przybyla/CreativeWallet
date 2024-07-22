<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;

class SuccessMiddleware implements MiddlewareInterface
{
  public function process(callable $next)
  {
    if (empty($_SESSION['success'])) {
      if (!empty($_SESSION['user'])) {
        redirectTo('/user-page');
      } else {
        redirectTo('/register');
      }
    }

    $next();
  }
}
