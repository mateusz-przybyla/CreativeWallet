<?php

declare(strict_types=1);

namespace Framework;

class Router
{
  private array $routes = [];
  private array $middlewares = [];
  private array $errorHandler;

  public function addRoute(string $method, string $path, array $controller)
  {
    $path = $this->normalizePath($path);
    $this->routes[] = [
      'path' => $path,
      'method' => strtoupper($method),
      'controller' => $controller,
      'middleware' => []
    ];
  }

  private function normalizePath(string $path): string
  {
    $path = trim($path, '/');
    $path = "/{$path}/";
    $path = preg_replace('#[/]{2,}#', '/', $path);

    return $path;
  }

  public function dispatch(string $path, string $method, Container $container = null)
  {
    $path = $this->normalizePath($path);
    $method = strtoupper($method);

    foreach ($this->routes as $route) {
      if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
        continue;
      }

      [$class, $function] = $route['controller'];

      $controllerInstance = $container ?
        $container->resolve($class) :
        new $class;

      $action = fn () => $controllerInstance->$function(); //recursion (main content)

      $allMiddleware = [...$route['middleware'], ...$this->middlewares]; //global middlewares pass last, execute first (session)

      foreach ($allMiddleware as $middleware) {
        $middlewareInstance = $container ?
          $container->resolve($middleware) :
          new $middleware;

        $action = fn () => $middlewareInstance->process($action); //recursion (before main content)
      }

      $action(); //start the chain of functions

      return;
    }
  }

  public function addMiddleware(string $middleware)
  {
    $this->middlewares[] = $middleware;
  }

  public function addRouteMiddleware(string $middleware)
  {
    $lastRouteKey = array_key_last($this->routes);
    $this->routes[$lastRouteKey]['middleware'][] = $middleware;
  }

  public function setErrorHandler(array $controller)
  {
    $this->errorHandler = $controller;
  }

  public function dispatchNotFound(?Container $container)
  {
    [$class, $function] = $this->errorHandler;

    $controllerInstance = $container ?
      $container->resolve($class) :
      new $class;

    $action = fn () => $controllerInstance->$function();

    foreach ($this->middlewares as $middleware) {
      $middlewareInstance = $container ?
        $container->resolve($middleware) :
        new $middleware;

      $action = fn () => $middlewareInstance->process($action);
    }

    $action();
  }
}
