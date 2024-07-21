<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
  public function __construct(private Database $db)
  {
  }

  public function isEmailTaken(string $email)
  {
    $emailCount = $this->db->query(
      "SELECT COUNT(*) FROM `users` WHERE `email` = :email",
      ['email' => $email]
    )->count();

    if ($emailCount > 0) {
      throw new ValidationException(['email' => ['Email taken.']]);
    }
  }

  public function createNewUser(array $formData)
  {
    $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

    $this->db->query(
      "INSERT INTO `users` (`username`, `email`, `password`) 
    VALUES (:username, :email, :password)",
      [
        'username' => $formData['username'],
        'email' => $formData['email'],
        'password' => $password
      ]
    );
  }

  public function copyDefaultTables()
  {
    $userId = $this->db->id();

    $this->db->query(
      "INSERT INTO `incomes_category_assigned_to_users` (`user_id`, `name`) 
      SELECT :user_id, `name` 
      FROM `incomes_category_default`",
      [
        'user_id' => $userId
      ]
    );

    $this->db->query(
      "INSERT INTO `expenses_category_assigned_to_users` (`user_id`, `name`) 
      SELECT :user_id, `name` 
      FROM `expenses_category_default`",
      [
        'user_id' => $userId
      ]
    );

    $this->db->query(
      "INSERT INTO `payment_methods_assigned_to_users` (`user_id`, `name`) 
      SELECT :user_id, `name` 
      FROM `payment_methods_default`",
      [
        'user_id' => $userId
      ]
    );
  }
}
