<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{
  TransactionService,
  ValidatorService
};

class ShowBalanceController
{
  public function __construct(
    private TemplateEngine $view,
    private TransactionService $transactionService,
    private ValidatorService $validatorService
  ) {
  }

  public function showBalanceView()
  {
    $selectedPeriod = $this->selectTimePeriod($_GET);

    $_SESSION['m_period'] = "(from {$selectedPeriod['startDate']} to {$selectedPeriod['endDate']})";

    $incomes = $this->transactionService->getUserIncomes($selectedPeriod);
    $expenses = $this->transactionService->getUserExpenses($selectedPeriod);

    $incomeTotal = $this->transactionService->calculateTotal($incomes);
    $incomeTotal = number_format($incomeTotal, 2, ".", "");

    $expenseTotal = $this->transactionService->calculateTotal($expenses);
    $expenseTotal = number_format($expenseTotal, 2, ".", "");

    $balance = $this->transactionService->calculateBalance((float)$incomeTotal, (float)$expenseTotal);
    $balance = number_format($balance, 2, ".", "");

    $dataPoints = $this->transactionService->createDataPoints($expenses);

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

  public function selectTimePeriod(array $formData): array
  {
    $selectedPeriod = [];

    if (isset($formData['period'])) {
      $period = $formData['period'];

      if ($period === 'currentMonth') {
        $startDate = date('Y-m-d', strtotime("first day of this month"));
        $endDate = date('Y-m-d');
        $selectedPeriod = ['startDate' => $startDate, 'endDate' => $endDate];
        $_SESSION['btn1'] = "active";

        return $selectedPeriod;
      } else if ($period === 'previousMonth') {
        $startDate = date('Y-m-d', strtotime("first day of previous month"));
        $endDate = date('Y-m-d', strtotime("last day of previous month"));
        $selectedPeriod = ['startDate' => $startDate, 'endDate' => $endDate];
        $_SESSION['btn2'] = "active";

        return $selectedPeriod;
      } else if ($period === 'currentYear') {
        $startDate = date('Y-m-d', strtotime("first day of january this year"));
        $endDate = date('Y-m-d');
        $selectedPeriod = ['startDate' => $startDate, 'endDate' => $endDate];
        $_SESSION['btn3'] = "active";

        return $selectedPeriod;
      }
    } else if (isset($formData['customStartDate']) && isset($formData['customEndDate'])) {
      $startDate = $formData['customStartDate'];
      $endDate = $formData['customEndDate'];

      $today = date('Y-m-d');

      if ($startDate > $today) {
        $startDate = $today;
      }
      if ($endDate > $today) {
        $endDate = $today;
      }
      if ($startDate > $endDate) {
        $temp = $startDate;
        $startDate = $endDate;
        $endDate = $temp;
      }
      $selectedPeriod = ['startDate' => $startDate, 'endDate' => $endDate];
      $_SESSION['btn4'] = "active";

      return $selectedPeriod;
    } else if (!isset($formData['period'])) {
      $startDate = date('Y-m-d', strtotime("first day of this month"));
      $endDate = date('Y-m-d');
      $selectedPeriod = ['startDate' => $startDate, 'endDate' => $endDate];
      $_SESSION['btn1'] = "active";

      return $selectedPeriod;
    }
  }
}
