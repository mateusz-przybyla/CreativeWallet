<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class WelcomeController
{
  public function __construct(private TemplateEngine $view)
  {
  }

  public function welcome()
  {
    echo $this->view->render("welcome.php");
  }
}
