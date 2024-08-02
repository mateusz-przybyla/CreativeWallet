<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{
  ValidatorService,
  TransactionService,
  UserService
};
use App\Exceptions\FormOptionsException;

class SettingsController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private TransactionService $transactionService,
    private UserService $userService
  ) {
  }

  public function settingsView()
  {
    $incomeCategories = $this->transactionService->loadIncomeCategories();
    $expenseCategories = $this->transactionService->loadExpenseCategories();
    $paymentMethods = $this->transactionService->loadPaymentMethods();

    if ((!$expenseCategories) || (!$incomeCategories) || (!$paymentMethods)) {
      throw new FormOptionsException("No categories loaded.");
    }

    echo $this->view->render(
      "transactions/settings.php",
      [
        'incomeCategories' => $incomeCategories,
        'expenseCategories' => $expenseCategories,
        'paymentMethods' => $paymentMethods,
        'incomeCategoriesAmount' => count($incomeCategories),
        'expenseCategoriesAmount' => count($expenseCategories),
        'paymentMethodsAmount' => count($paymentMethods)
      ]
    );
  }

  public function deleteIncomeCategory(array $params)
  {
    $this->transactionService->deleteIncomeCategory((int) $params['category']);

    redirectTo('/settings');
  }

  public function deleteExpenseCategory(array $params)
  {
    $this->transactionService->deleteExpenseCategory((int) $params['category']);

    redirectTo('/settings');
  }

  public function deletePaymentMethod(array $params)
  {
    $this->transactionService->deletePaymentMethod((int) $params['category']);

    redirectTo('/settings');
  }
}
