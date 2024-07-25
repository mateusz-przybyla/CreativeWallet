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

    $incomeTotal = $this->transactionService->calculateTotal($incomes);
    $incomeTotal = number_format($incomeTotal, 2, ".", "");

    $expenseTotal = $this->transactionService->calculateTotal($expenses);
    $expenseTotal = number_format($expenseTotal, 2, ".", "");

    $balance = $this->transactionService->calculateBalance((float)$incomeTotal, (float)$expenseTotal);
    $balance = number_format($balance, 2, ".", "");

    $dataPoints = $this->transactionService->createDataPoints($expenses);

    //dd($dataPoints);

    echo $this->view->render(
      "transactions/show-balance.php",
      [
        'incomes' => $incomes,
        'expenses' => $expenses,
        'incomeTotal' => $incomeTotal,
        'expenseTotal' => $expenseTotal,
        'balance' => $balance,
        'dataPoints' => $dataPoints
      ]
    );
  }

  public function showBalance()
  {
    //$transactions = $this->transactionService->getUserTransactions();
  }
}
