<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class FlashMiddleware implements MiddlewareInterface
{
  public function __construct(private TemplateEngine $view) {}

  public function process(callable $next)
  {
    $this->view->addGlobal('errors', $_SESSION['errors'] ?? []);

    unset($_SESSION['errors']);

    $this->view->addGlobal('oldFormData', $_SESSION['oldFormData'] ?? []);

    unset($_SESSION['oldFormData']);

    $this->view->addGlobal('flashNotifications', $_SESSION['flashNotifications'] ?? '');

    unset($_SESSION['flashNotifications']);

    $next();
  }
}
