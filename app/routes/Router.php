<?php 

namespace app\routes;

use Exception;
use app\helpers\Uri;
use app\helpers\Request;

class Router 
{
  const CONTROLLER_NAMESPACE = "app\\controllers\\";

  public static function load(string $controller, string $action)
  {
    try {
      $controllerNamespace = self::CONTROLLER_NAMESPACE . $controller;

      if (!class_exists($controllerNamespace)) {
        throw new Exception("O controller {$controller} não existe");
      }

      $controllerInstance = new $controllerNamespace();

      if (!method_exists($controllerInstance, $action)) {
        throw new Exception("O método {$action} não existe no controller {$controller}");
      }

      $controllerInstance->$action((object) $_REQUEST);
      
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public static function routes(): array
  {
    return [
      'GET' => [
        '/' => fn() => self::load('HomeController', 'index'),
        '/contact' => fn() => self::load('ContactController', 'index'),
      ],
      'POST' => [
        '/contact' => fn () => self::load('ContactController', 'store'),
      ],
    ];
  }

  public static function execute()
  {
    try {
      $routes = self::routes();
      $request = Request::get();
      $uri = Uri::get('path');

      if (!isset($routes[$request])) {
        throw new Exception("Route does not exist.");
      }

      if (!array_key_exists($uri, $routes[$request])) {
        throw new Exception("Route does not exist.");
      }

      $router = $routes[$request][$uri];
      
      if (!is_callable($router)) {
        throw new Exception("Route {$uri} is not callable");
      }
      
      $router();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}