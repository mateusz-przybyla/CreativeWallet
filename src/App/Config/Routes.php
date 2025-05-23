<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
  HomeController,
  AuthController,
  SuccessController,
  WelcomeController,
  AddIncomeController,
  AddExpenseController,
  ShowBalanceController,
  ErrorController,
  SettingsController
};
use App\Middlewares\{
  AuthRequiredMiddleware,
  GuestOnlyMiddleware,
  SuccessMiddleware
};

function registerRoutes(App $app)
{
  $app->get('/', [HomeController::class, 'home'])->add(GuestOnlyMiddleware::class);
  $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
  $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
  $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
  $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
  $app->get('/success', [SuccessController::class, 'success'])->add(SuccessMiddleware::class);
  $app->get('/welcome', [WelcomeController::class, 'welcome'])->add(AuthRequiredMiddleware::class);
  $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
  $app->get('/add-income', [AddIncomeController::class, 'addIncomeView'])->add(AuthRequiredMiddleware::class);
  $app->post('/add-income', [AddIncomeController::class, 'addIncome'])->add(AuthRequiredMiddleware::class);
  $app->get('/add-expense', [AddExpenseController::class, 'addExpenseView'])->add(AuthRequiredMiddleware::class);
  $app->post('/add-expense', [AddExpenseController::class, 'addExpense'])->add(AuthRequiredMiddleware::class);
  $app->get('/show-balance', [ShowBalanceController::class, 'showBalanceView'])->add(AuthRequiredMiddleware::class);
  $app->get('/settings', [SettingsController::class, 'settingsView'])->add(AuthRequiredMiddleware::class);

  $app->delete('/settings/delete/income-category/{id}', [SettingsController::class, 'deleteIncomeCategory'])->add(AuthRequiredMiddleware::class);
  $app->delete('/settings/delete/expense-category/{id}', [SettingsController::class, 'deleteExpenseCategory'])->add(AuthRequiredMiddleware::class);
  $app->delete('/settings/delete/payment-method/{id}', [SettingsController::class, 'deletePaymentMethod'])->add(AuthRequiredMiddleware::class);

  $app->post('/settings/edit/income-category/{id}', [SettingsController::class, 'editIncomeCategory'])->add(AuthRequiredMiddleware::class);
  $app->post('/settings/edit/expense-category/{id}', [SettingsController::class, 'editExpenseCategory'])->add(AuthRequiredMiddleware::class);
  $app->post('/settings/edit/payment-method/{id}', [SettingsController::class, 'editPaymentMethod'])->add(AuthRequiredMiddleware::class);

  $app->post('/settings/add/income-category', [SettingsController::class, 'addIncomeCategory'])->add(AuthRequiredMiddleware::class);
  $app->post('/settings/add/expense-category', [SettingsController::class, 'addExpenseCategory'])->add(AuthRequiredMiddleware::class);
  $app->post('/settings/add/payment-method', [SettingsController::class, 'addPaymentMethod'])->add(AuthRequiredMiddleware::class);

  $app->post('/settings/change/password', [SettingsController::class, 'changePassword'])->add(AuthRequiredMiddleware::class);

  $app->delete('/settings/delete/account', [SettingsController::class, 'deleteAccount'])->add(AuthRequiredMiddleware::class);

  $app->get('/api/limit/{id}', [AddExpenseController::class, 'getCategoryLimit'])->add(AuthRequiredMiddleware::class);
  $app->get('/api/amount/{id}/{date}', [AddExpenseController::class, 'getMoneySpent'])->add(AuthRequiredMiddleware::class);

  $app->setErrorHandler([ErrorController::class, 'notFound']);
}
