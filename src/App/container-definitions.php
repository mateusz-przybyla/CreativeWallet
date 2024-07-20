<?php

declare(strict_types=1);

namespace App;

use Framework\TemplateEngine;
use App\Config\Paths;

return [
  TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW)
];
