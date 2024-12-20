<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middlewares\{
  TemplateDataMiddleware,
  ValidationExceptionMiddleware,
  SessionMiddleware,
  FlashMiddleware,
  CsrfTokenMiddleware,
  CsrfGuardMiddleware,
  CurrentPageMiddleware
};

function registerMiddleware(App $app)
{
  $app->addMiddleware(CurrentPageMiddleware::class);
  $app->addMiddleware(CsrfGuardMiddleware::class);
  $app->addMiddleware(CsrfTokenMiddleware::class);
  $app->addMiddleware(TemplateDataMiddleware::class);
  $app->addMiddleware(ValidationExceptionMiddleware::class);
  $app->addMiddleware(FlashMiddleware::class);
  $app->addMiddleware(SessionMiddleware::class);
}
