<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class CurrentPageMiddleware implements MiddlewareInterface
{
  public function __construct(private TemplateEngine $view)
  {
  }

  public function process(callable $next)
  {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $status = 'active';

    $this->view->addGlobal('currentPath', $path);
    $this->view->addGlobal('activeStatus', $status);

    $next();
  }
}
