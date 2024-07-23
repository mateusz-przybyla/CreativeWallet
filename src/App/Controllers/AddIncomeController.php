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
  ) {
  }

  public function addIncomeView()
  {
    $incomeCategories = $this->transactionService->loadCategories();

    if (!$incomeCategories) {
      throw new FormOptionsException("No categories loaded.");
    }

    echo $this->view->render("add-income.php", [
      'incomeCategories' => $incomeCategories
    ]);
  }

  public function addIncome()
  {
    $this->validatorService->validateTransaction($_POST);

    // $this->transactionService->getIncomeCategoryId($_POST['category']);

    $this->transactionService->createIncome($_POST);

    redirectTo('/add-income');
  }
}
