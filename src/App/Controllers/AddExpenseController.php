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
  ) {}

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
    $this->validatorService->validateExpenseTransaction($_POST);

    $this->transactionService->createExpense($_POST);

    redirectTo('/add-expense');
  }

  public function getCategoryLimit(array $params)
  {
    $expenseCategoryLimit = $this->transactionService->getCategoryLimit((int) $params['id']);

    echo json_encode($expenseCategoryLimit, JSON_UNESCAPED_UNICODE);
  }

  public function getMoneySpent(array $params)
  {
    $amount = $this->transactionService->getMoneySpent((int) $params['id'], $params['date']);

    echo json_encode($amount, JSON_UNESCAPED_UNICODE);
  }
}
