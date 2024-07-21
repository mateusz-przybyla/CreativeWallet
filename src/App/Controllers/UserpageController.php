<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class UserpageController
{
  public function __construct(private TemplateEngine $view)
  {
  }

  public function userpage()
  {
    echo $this->view->render("userpage.php");
  }
}
