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
  ) {}

  public function settingsView()
  {
    $incomeCategories = $this->transactionService->loadIncomeCategories();
    $expenseCategories = $this->transactionService->loadExpenseCategories();
    $paymentMethods = $this->transactionService->loadPaymentMethods();

    if ((!$expenseCategories) || (!$incomeCategories) || (!$paymentMethods)) {
      throw new FormOptionsException("No categories loaded.");
    }

    //dd($expenseCategories);

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
    $this->transactionService->deleteIncomeCategory((int) $params['id']);

    redirectTo('/settings');
  }

  public function deleteExpenseCategory(array $params)
  {
    $this->transactionService->deleteExpenseCategory((int) $params['id']);

    redirectTo('/settings');
  }

  public function deletePaymentMethod(array $params)
  {
    $this->transactionService->deletePaymentMethod((int) $params['id']);

    redirectTo('/settings');
  }

  public function editIncomeCategory(array $params)
  {
    $this->validatorService->validateEditIncomeCategory((int) $params['id'], $_POST);

    $this->transactionService->isEditedIncomeCategoryTaken((int) $params['id'], $_POST['editIncomeCategory']);

    $this->transactionService->updateIncomeCategory((int) $params['id'], $_POST);

    redirectTo('/settings');
  }

  public function editExpenseCategory(array $params)
  {
    $this->validatorService->validateEditExpenseCategory((int) $params['id'], $_POST);

    $this->transactionService->isEditedExpenseCategoryTaken((int) $params['id'], $_POST['editExpenseCategory']);

    $this->transactionService->updateExpenseCategory((int) $params['id'], $_POST);

    redirectTo('/settings');
  }

  public function editPaymentMethod(array $params)
  {
    $this->validatorService->validateEditPaymentMethod((int) $params['id'], $_POST);

    $this->transactionService->isEditedPaymentMethodTaken((int) $params['id'], $_POST['editPaymentMethod']);

    $this->transactionService->updatePaymentMethod((int) $params['id'], $_POST);

    redirectTo('/settings');
  }

  public function addIncomeCategory()
  {
    $this->validatorService->validateNewIncomeCategory($_POST);

    $this->transactionService->isNewIncomeCategoryTaken($_POST['newIncomeCategory']);

    $this->transactionService->addIncomeCategory($_POST);

    redirectTo('/settings');
  }

  public function addExpenseCategory()
  {
    $this->validatorService->validateNewExpenseCategory($_POST);

    $this->transactionService->isNewExpenseCategoryTaken($_POST['newExpenseCategory']);

    $this->transactionService->addExpenseCategory($_POST);

    redirectTo('/settings');
  }

  public function addPaymentMethod()
  {
    $this->validatorService->validateNewPaymentMethod($_POST);

    $this->transactionService->isNewPaymentMethodTaken($_POST['newPaymentMethod']);

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
