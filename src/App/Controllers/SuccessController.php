<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class SuccessController
{
  public function __construct(private TemplateEngine $view)
  {
  }

  public function success()
  {
    echo $this->view->render("success.php");
  }
}
