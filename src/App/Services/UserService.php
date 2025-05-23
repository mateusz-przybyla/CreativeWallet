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

    $_SESSION['success'] = 'done';

    session_regenerate_id();
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

  public function verifyLoginData(array $formData)
  {
    $query = $this->db->query(
      "SELECT * FROM `users` WHERE `email` = :email",
      ['email' => $formData['email']]
    );

    $user = $query->retrieve();

    $passwordMatch = password_verify(
      $formData['password'],
      $user['password'] ?? ''
    );

    if (!$user || !$passwordMatch) {
      throw new ValidationException(['password' => ['Invalid credentials.']]);
    }

    session_regenerate_id();

    $_SESSION['user'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    unset($_SESSION['success']);
  }

  public function logout()
  {
    //unset($_SESSION['user']);
    session_destroy();

    //session_regenerate_id();
    $params = session_get_cookie_params();
    setcookie(
      'PHPSESSID',
      '',
      time() - 3600,
      $params['path'],
      $params['domain'],
      $params['secure'],
      $params['httponly']
    );
  }

  public function verifyOldPassword(array $formData)
  {
    $query = $this->db->query(
      "SELECT * FROM `users` WHERE `id` = :user_id",
      ['user_id' => $_SESSION['user']]
    );

    $user = $query->retrieve();

    $passwordMatch = password_verify(
      $formData['oldPassword'],
      $user['password'] ?? ''
    );

    if (!$user || !$passwordMatch) {
      throw new ValidationException(['oldPassword' => ['Invalid old password.']]);
    }
  }

  public function updatePassword(array $formData)
  {
    $newPassword = password_hash($formData['newPassword'], PASSWORD_BCRYPT, ['cost' => 12]);

    $this->db->query(
      "UPDATE `users`
      SET `password` = :password
      WHERE `id` = :user_id",
      [
        'user_id' => $_SESSION['user'],
        'password' => $newPassword
      ]
    );
  }

  public function deleteAccount()
  {
    $this->db->query("DELETE FROM `incomes_category_assigned_to_users` WHERE `user_id` = :user_id", [
      'user_id' => $_SESSION['user']
    ]);

    $this->db->query("DELETE FROM `expenses_category_assigned_to_users` WHERE `user_id` = :user_id", [
      'user_id' => $_SESSION['user']
    ]);

    $this->db->query("DELETE FROM `payment_methods_assigned_to_users` WHERE `user_id` = :user_id", [
      'user_id' => $_SESSION['user']
    ]);

    $this->db->query("DELETE FROM `incomes` WHERE `user_id` = :user_id", [
      'user_id' => $_SESSION['user']
    ]);

    $this->db->query("DELETE FROM `expenses` WHERE `user_id` = :user_id", [
      'user_id' => $_SESSION['user']
    ]);

    $this->db->query("DELETE FROM `users` WHERE `id` = :user_id", [
      'user_id' => $_SESSION['user']
    ]);
  }
}
