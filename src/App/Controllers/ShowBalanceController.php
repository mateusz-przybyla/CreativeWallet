<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class ShowBalanceController
{
  public function __construct(
    private TemplateEngine $view,
  ) {
  }

  public function showBalanceView()
  {
    echo $this->view->render("transactions/show-balance.php");
  }
}
