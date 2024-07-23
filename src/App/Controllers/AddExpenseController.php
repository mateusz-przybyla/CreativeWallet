<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{
  ValidatorService,
  TransactionService
};
use App\Exceptions\FormOptionsException;

class AddExpenseController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private TransactionService $transactionService
  ) {
  }

  public function addIncomeView()
  {
    $expenseCategories = $this->transactionService->loadCategories();

    if (!$expenseCategories) {
      throw new FormOptionsException("No categories loaded.");
    }

    echo $this->view->render("add-expense.php", [
      'expenseCategories' => $expenseCategories
    ]);
  }
  /*
  public function addIncome()
  {
    $this->validatorService->validateTransaction($_POST);

    $this->transactionService->createIncome($_POST);

    redirectTo('/add-income');
  }
*/
}
