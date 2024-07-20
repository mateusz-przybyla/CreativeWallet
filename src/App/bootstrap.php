<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;

$app = new App();

$app->get("/");
$app->get("/about");

dd($app);

return $app;
