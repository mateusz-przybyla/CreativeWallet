<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
  HomeController,
  AuthController,
  WelcomeController,
  UserpageController
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
  $app->get('/welcome', [WelcomeController::class, 'welcome']);
  $app->get('/user-page', [UserpageController::class, 'userpage'])->add(AuthRequiredMiddleware::class);
  $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
}
