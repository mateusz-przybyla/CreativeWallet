<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class AddIncomeController
{
  public function __construct(private TemplateEngine $view)
  {
  }

  public function addIncomeView()
  {
    echo $this->view->render("add-income.php");
  }

  public function addIncome()
  {
    //$this->validatorService->validateTransaction($_POST);

    //$this->transactionService->create($_POST);

    //redirectTo('/');
  }
}
