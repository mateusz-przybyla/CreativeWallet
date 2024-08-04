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

  public function editIncomeCategory(array $params)
  {
    $this->validatorService->validateNewCategoryName($_POST);

    $this->transactionService->isIncomeCategoryTaken($_POST['newName']);

    $this->transactionService->updateIncomeCategory((int) $params['category'], $_POST);

    redirectTo('/settings');
  }

  public function editExpenseCategory(array $params)
  {
    $this->validatorService->validateNewCategoryName($_POST);

    $this->transactionService->isExpenseCategoryTaken($_POST['newName']);

    $this->transactionService->updateExpenseCategory((int) $params['category'], $_POST);

    redirectTo('/settings');
  }

  public function editPaymentMethod(array $params)
  {
    $this->validatorService->validateNewCategoryName($_POST);

    $this->transactionService->isPaymentMethodTaken($_POST['newName']);

    $this->transactionService->updatePaymentMethod((int) $params['category'], $_POST);

    redirectTo('/settings');
  }

  public function addIncomeCategory()
  {
    $this->validatorService->validateNewCategory($_POST);

    $this->transactionService->isIncomeCategoryTaken($_POST['newCategory']);

    $this->transactionService->addIncomeCategory($_POST);

    redirectTo('/settings');
  }

  public function addExpenseCategory()
  {
    $this->validatorService->validateNewCategory($_POST);

    $this->transactionService->isExpenseCategoryTaken($_POST['newCategory']);

    $this->transactionService->addExpenseCategory($_POST);

    redirectTo('/settings');
  }

  public function addPaymentMethod()
  {
    $this->validatorService->validateNewCategory($_POST);

    $this->transactionService->isPaymentMethodTaken($_POST['newCategory']);

    $this->transactionService->addPaymentMethod($_POST);

    redirectTo('/settings');
  }

  public function changePassword()
  {
    $this->validatorService->validateNewPassword($_POST);

    $this->userService->verifyOldPassword($_POST);

    $this->userService->updatePassword($_POST);

    redirectTo('/settings');
  }

  public function deleteAccount()
  {
    $this->userService->deleteAccount();

    $this->userService->logout();

    redirectTo('/');
  }
}
