<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
  public function __construct(private Database $db)
  {
  }

  public function loadIncomeCategories(): array
  {
    return $this->db->query(
      "SELECT `name` 
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
      "SELECT `name` 
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
      "SELECT `name` 
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

    $_SESSION['newTrans'] = "Transaction added successfully!";
  }

  public function createExpense(array $formData)
  {
    $categoryId = $this->getExpenseCategoryId($formData['category']);
    $paymentMethodId = $this->getPaymentMethodId($formData['paymentMethod']);

    $this->db->query(
      "INSERT INTO `expenses` 
      VALUES (NULL, :user_id, :expense_category_assigned_to_user_id, :payment_method_assigned_to_user_id	, :amount, :date_of_expense, :expense_comment)",
      [
        'user_id' => $_SESSION['user'],
        'expense_category_assigned_to_user_id' => $categoryId['id'],
        'payment_method_assigned_to_user_id' => $paymentMethodId['id'],
        'amount' => $formData['amount'],
        'date_of_expense' => $formData['date'],
        'expense_comment' => $formData['comment']
      ]
    );

    $_SESSION['newTrans'] = "Transaction added successfully!";
  }
}