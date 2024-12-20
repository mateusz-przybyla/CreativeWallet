<?php

declare(strict_types=1);

namespace App\Services;

use DateTime;
use Framework\Database;
use Framework\Exceptions\ValidationException;

class TransactionService
{
  public function __construct(private Database $db) {}

  public function loadIncomeCategories(): array
  {
    return $this->db->query(
      "SELECT `name`, `id` 
      FROM `incomes_category_assigned_to_users` 
      WHERE `user_id` = :user_id",
      [
        'user_id' => $_SESSION['user']
      ]
    )->retrieveAll();
  }

  public function loadExpenseCategories(): array
  {
    return $this->db->query(
      "SELECT `name`, `id`, `category_limit`
      FROM `expenses_category_assigned_to_users` 
      WHERE `user_id` = :user_id",
      [
        'user_id' => $_SESSION['user']
      ]
    )->retrieveAll();
  }

  public function loadPaymentMethods(): array
  {
    return $this->db->query(
      "SELECT `name`, `id`
      FROM `payment_methods_assigned_to_users` 
      WHERE `user_id` = :user_id",
      [
        'user_id' => $_SESSION['user']
      ]
    )->retrieveAll();
  }

  public function getIncomeCategoryId(string $category): array
  {
    return $this->db->query(
      "SELECT `id`
      FROM `incomes_category_assigned_to_users`
      WHERE `user_id` = :user_id
      AND `name` = :category",
      [
        'user_id' => $_SESSION['user'],
        'category' => $category
      ]
    )->retrieve();
  }

  public function getExpenseCategoryId(string $category): array
  {
    return $this->db->query(
      "SELECT `id`
      FROM `expenses_category_assigned_to_users`
      WHERE `user_id` = :user_id
      AND `name` = :category",
      [
        'user_id' => $_SESSION['user'],
        'category' => $category
      ]
    )->retrieve();
  }

  public function getPaymentMethodId(string $category): array
  {
    return $this->db->query(
      "SELECT `id`
      FROM `payment_methods_assigned_to_users`
      WHERE `user_id` = :user_id
      AND `name` = :category",
      [
        'user_id' => $_SESSION['user'],
        'category' => $category
      ]
    )->retrieve();
  }

  public function createIncome(array $formData)
  {
    $categoryId = $this->getIncomeCategoryId($formData['category']);

    $this->db->query(
      "INSERT INTO `incomes` 
      VALUES (NULL, :user_id, :income_category_assigned_to_user_id, :amount, :date_of_income, :income_comment)",
      [
        'user_id' => $_SESSION['user'],
        'income_category_assigned_to_user_id' => $categoryId['id'],
        'amount' => $formData['amount'],
        'date_of_income' => $formData['date'],
        'income_comment' => $formData['comment']
      ]
    );

    $_SESSION['newTrans'] = true;
  }

  public function createExpense(array $formData)
  {
    $categoryId = $this->getExpenseCategoryId($formData['category']);
    $paymentMethodId = $this->getPaymentMethodId($formData['paymentMethod']);

    $this->db->query(
      "INSERT INTO `expenses` 
      VALUES (NULL, :user_id, :expense_category_assigned_to_user_id, :payment_method_assigned_to_user_id, :amount, :date_of_expense, :expense_comment)",
      [
        'user_id' => $_SESSION['user'],
        'expense_category_assigned_to_user_id' => $categoryId['id'],
        'payment_method_assigned_to_user_id' => $paymentMethodId['id'],
        'amount' => $formData['amount'],
        'date_of_expense' => $formData['date'],
        'expense_comment' => $formData['comment']
      ]
    );

    $_SESSION['newTrans'] = true;
  }

  public function getUserIncomes(array $dateRange): array
  {
    return $this->db->query(
      "SELECT `name`, SUM(`amount`) AS total
      FROM  `incomes`, `incomes_category_assigned_to_users`
      WHERE `incomes`.`income_category_assigned_to_user_id` = `incomes_category_assigned_to_users`.`id`
      AND `incomes`.`user_id` = :user_id
      AND `incomes`.`date_of_income` BETWEEN :start_date AND :end_date
      GROUP BY `income_category_assigned_to_user_id` 
      ORDER BY total DESC",
      [
        'user_id' => $_SESSION['user'],
        'start_date' => $dateRange['startDate'],
        'end_date' => $dateRange['endDate']
      ]
    )->retrieveAll();
  }

  public function getUserExpenses(array $dateRange): array
  {
    return $this->db->query(
      "SELECT `name`, SUM(`amount`) AS total
      FROM  `expenses`, `expenses_category_assigned_to_users`
      WHERE `expenses`.`expense_category_assigned_to_user_id` = `expenses_category_assigned_to_users`.`id`
      AND `expenses`.`user_id` = :user_id
      AND `expenses`.`date_of_expense` BETWEEN :start_date AND :end_date
      GROUP BY `expense_category_assigned_to_user_id` 
      ORDER BY total DESC",
      [
        'user_id' => $_SESSION['user'],
        'start_date' => $dateRange['startDate'],
        'end_date' => $dateRange['endDate']
      ]
    )->retrieveAll();
  }

  public function calculateTotal(array $transactions): float
  {
    $total = 0;

    foreach ($transactions as $transaction) {
      $total += $transaction['total'];
    }

    return $total;
  }

  public function calculateBalance(float $transaction1, float $transaction2): float
  {
    return $transaction1 - $transaction2;
  }

  public function createDataPoints(array $data): array
  {
    $dataPoints = [];

    foreach ($data as $point) {
      $dataPoints[] = ['y' => $point['total'], 'label' => $point['name']];
    }

    return $dataPoints;
  }

  public function deleteIncomeCategory(int $id)
  {
    $this->db->query(
      "DELETE FROM `incomes_category_assigned_to_users` WHERE `id` = :id",
      [
        'id' => $id
      ]
    );

    $this->db->query(
      "DELETE FROM `incomes` WHERE `income_category_assigned_to_user_id` = :id",
      [
        'id' => $id
      ]
    );
  }

  public function deleteExpenseCategory(int $id)
  {
    $this->db->query(
      "DELETE FROM `expenses_category_assigned_to_users` WHERE `id` = :id",
      [
        'id' => $id
      ]
    );

    $this->db->query(
      "DELETE FROM `expenses` WHERE `expense_category_assigned_to_user_id` = :id",
      [
        'id' => $id
      ]
    );
  }

  public function deletePaymentMethod(int $id)
  {
    $this->db->query(
      "DELETE FROM `payment_methods_assigned_to_users` WHERE `id` = :id",
      [
        'id' => $id
      ]
    );

    $this->db->query(
      "DELETE FROM `expenses` WHERE `payment_method_assigned_to_user_id` = :id",
      [
        'id' => $id
      ]
    );
  }

  public function updateIncomeCategory(int $id, array $formData)
  {
    $this->db->query(
      "UPDATE `incomes_category_assigned_to_users`
      SET `name` = :name
      WHERE `id` = :id",
      [
        'id' => $id,
        'name' => $formData['editIncomeCategory']
      ]
    );
  }

  public function updateExpenseCategory(int $id, array $formData)
  {
    if (!isset($formData['expenseLimit'])) {
      $formData['expenseLimit'] = null;
    }

    $this->db->query(
      "UPDATE `expenses_category_assigned_to_users`
      SET `name` = :name, `category_limit` = :category_limit
      WHERE `id` = :id",
      [
        'id' => $id,
        'name' => $formData['editExpenseCategory'],
        'category_limit' => $formData['expenseLimit']
      ]
    );
  }

  public function updatePaymentMethod(int $id, array $formData)
  {
    $this->db->query(
      "UPDATE `payment_methods_assigned_to_users`
      SET `name` = :name
      WHERE `id` = :id",
      [
        'id' => $id,
        'name' => $formData['editPaymentMethod']
      ]
    );
  }

  public function addIncomeCategory(array $formData)
  {
    $this->db->query(
      "INSERT INTO `incomes_category_assigned_to_users`
      VALUES (NULL, :user_id, :name)",
      [
        'user_id' => $_SESSION['user'],
        'name' => $formData['newIncomeCategory']
      ]
    );
  }

  public function addExpenseCategory(array $formData)
  {
    $this->db->query(
      "INSERT INTO `expenses_category_assigned_to_users`
      VALUES (NULL, :user_id, :name, NULL)",
      [
        'user_id' => $_SESSION['user'],
        'name' => $formData['newExpenseCategory']
      ]
    );
  }

  public function addPaymentMethod(array $formData)
  {
    $this->db->query(
      "INSERT INTO `payment_methods_assigned_to_users`
      VALUES (NULL, :user_id, :name)",
      [
        'user_id' => $_SESSION['user'],
        'name' => $formData['newPaymentMethod']
      ]
    );
  }

  public function isEditedIncomeCategoryTaken(int $id, string $category)
  {
    $currentCategory = $this->db->query(
      "SELECT `name`
      FROM  `incomes_category_assigned_to_users`
      WHERE `id` = :id",
      [
        'id' => $id
      ]
    )->retrieve();

    $nameCount = $this->db->query(
      "SELECT COUNT(*) FROM `incomes_category_assigned_to_users` 
      WHERE `name` = :name AND `user_id` = :user_id",
      [
        'name' => $category,
        'user_id' => $_SESSION['user']
      ]
    )->count();

    if ($nameCount > 0 && $category != $currentCategory['name']) {
      throw new ValidationException(['editIncomeCategory' => ['Income category taken.'], 'editIncomeCategoryId' => $id]);
    }
  }

  public function isNewIncomeCategoryTaken(string $category)
  {
    $nameCount = $this->db->query(
      "SELECT COUNT(*) FROM `incomes_category_assigned_to_users`
      WHERE `name` = :name AND `user_id` = :user_id",
      [
        'name' => $category,
        'user_id' => $_SESSION['user']
      ]
    )->count();

    if ($nameCount > 0) {
      throw new ValidationException(['newIncomeCategory' => ['Income category taken.']]);
    }
  }

  public function isEditedExpenseCategoryTaken(int $id, string $category)
  {
    $currentCategory = $this->db->query(
      "SELECT `name`
      FROM  `expenses_category_assigned_to_users`
      WHERE `id` = :id",
      [
        'id' => $id
      ]
    )->retrieve();

    $nameCount = $this->db->query(
      "SELECT COUNT(*) FROM `expenses_category_assigned_to_users` 
      WHERE `name` = :name AND `user_id` = :user_id",
      [
        'name' => $category,
        'user_id' => $_SESSION['user']
      ]
    )->count();

    if ($nameCount > 0 && $category != $currentCategory['name']) {
      throw new ValidationException(['editExpenseCategory' => ['Expense category taken.'], 'editExpenseCategoryId' => $id]);
    }
  }

  public function isNewExpenseCategoryTaken(string $category)
  {
    $nameCount = $this->db->query(
      "SELECT COUNT(*) FROM `expenses_category_assigned_to_users` 
      WHERE `name` = :name AND `user_id` = :user_id",
      [
        'name' => $category,
        'user_id' => $_SESSION['user']
      ]
    )->count();

    if ($nameCount > 0) {
      throw new ValidationException(['newExpenseCategory' => ['Expense category taken.']]);
    }
  }

  public function isEditedPaymentMethodTaken(int $id, string $category)
  {
    $currentCategory = $this->db->query(
      "SELECT `name`
      FROM  `payment_methods_assigned_to_users`
      WHERE `id` = :id",
      [
        'id' => $id
      ]
    )->retrieve();

    $nameCount = $this->db->query(
      "SELECT COUNT(*) FROM `payment_methods_assigned_to_users` 
      WHERE `name` = :name AND `user_id` = :user_id",
      [
        'name' => $category,
        'user_id' => $_SESSION['user']
      ]
    )->count();

    if ($nameCount > 0 && $category != $currentCategory['name']) {
      throw new ValidationException(['editPaymentMethod' => ['Payment method taken.'], 'editPaymentMethodId' => $id]);
    }
  }

  public function isNewPaymentMethodTaken(string $category)
  {
    $nameCount = $this->db->query(
      "SELECT COUNT(*) FROM `payment_methods_assigned_to_users` 
      WHERE `name` = :name AND `user_id` = :user_id",
      [
        'name' => $category,
        'user_id' => $_SESSION['user']
      ]
    )->count();

    if ($nameCount > 0) {
      throw new ValidationException(['newPaymentMethod' => ['Payment method taken.']]);
    }
  }

  public function getCategoryLimit(int $id): ?string
  {
    $limit = $this->db->query(
      "SELECT `category_limit`
      FROM  `expenses_category_assigned_to_users`
      WHERE `id` = :id",
      [
        'id' => $id,
      ]
    )->retrieve();

    return  $limit['category_limit'];
  }

  public function getMoneySpent(int $id, string $date): ?string
  {
    $realDate = new DateTime($date);

    $firstDayOfMonth = $realDate->modify("first day of this month")->format("Y-m-d");
    $lastDayOfMonth = $realDate->modify("last day of this month")->format("Y-m-d");

    $amount = $this->db->query(
      "SELECT SUM(`amount`) AS total
      FROM  `expenses`
      WHERE `expense_category_assigned_to_user_id` = :id AND `date_of_expense` BETWEEN :beginDate AND :endDate",
      [
        'id' => $id,
        'beginDate' => $firstDayOfMonth,
        'endDate' => $lastDayOfMonth,
      ]
    )->retrieve();

    return $amount['total'];
  }
}
