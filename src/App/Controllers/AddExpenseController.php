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

  public function addExpenseView()
  {
    $expenseCategories = $this->transactionService->loadExpenseCategories();
    $paymentMethods = $this->transactionService->loadPaymentMethods();

    if ((!$expenseCategories) || (!$paymentMethods)) {
      throw new FormOptionsException("No categories loaded.");
    }

    echo $this->view->render(
      "transactions/add-expense.php",
      [
        'expenseCategories' => $expenseCategories,
        'paymentMethods' => $paymentMethods
      ]
    );
  }

  public function addExpense()
  {
    $this->validatorService->validateTransaction($_POST);

    //$this->transactionService->createIncome($_POST);

    //redirectTo('/add-income');
  }
}
