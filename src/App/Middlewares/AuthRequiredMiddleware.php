<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;

class AuthRequiredMiddleware implements MiddlewareInterface
{
  public function process(callable $next)
  {
    if (empty($_SESSION['user'])) {
      redirectTo('/login');
    }

    $next();
  }
}
