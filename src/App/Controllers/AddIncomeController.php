<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{
  ValidatorService,
  TransactionService
};
use App\Exceptions\FormOptionsException;

class AddIncomeController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private TransactionService $transactionService
  ) {}

  public function addIncomeView()
  {
    $incomeCategories = $this->transactionService->loadIncomeCategories();

    if (!$incomeCategories) {
      throw new FormOptionsException("No categories loaded.");
    }

    echo $this->view->render("transactions/add-income.php", [
      'incomeCategories' => $incomeCategories
    ]);
  }

  public function addIncome()
  {
    $this->validatorService->validateIncomeTransaction($_POST);

    $this->transactionService->createIncome($_POST);

    $_SESSION['flashNotifications'] = "New income added successfully.";

    redirectTo('/add-income');
  }
}
