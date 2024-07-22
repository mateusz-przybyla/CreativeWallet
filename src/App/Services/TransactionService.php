<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
  public function __construct(private Database $db)
  {
  }

  public function loadCategories()
  {
    $categories = $this->db->query(
      "SELECT `name` 
      FROM `incomes_category_assigned_to_users` 
      WHERE `user_id` = :userId",
      [
        'userId' => $_SESSION['user']
      ]
    )->retrieveAll();

    return $categories;
  }
}
