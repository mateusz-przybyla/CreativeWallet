<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;

class ShowBalanceController
{
  public function __construct(
    private TemplateEngine $view,
    private TransactionService $transactionService
  ) {
  }

  public function showBalanceView()
  {
    $incomes = $this->transactionService->getUserIncomes();
    $expenses = $this->transactionService->getUserExpenses();

    echo $this->view->render(
      "transactions/show-balance.php",
      [
        'incomes' => $incomes,
        'expenses' => $expenses
      ]
    );
  }

  public function showBalance()
  {
    //$transactions = $this->transactionService->getUserTransactions();
  }
}
