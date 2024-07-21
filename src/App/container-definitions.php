<?php

declare(strict_types=1);

namespace App;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\ValidatorService;

return [
  TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
  ValidatorService::class => fn () => new ValidatorService(Paths::VIEW)
];
