<?php 

namespace app\controllers;

use League\Plates\Engine;

abstract class Controller
{
  public function view(string $view, array $data = [])
  {
    $viewsPath = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'views';

    if (!file_exists($viewsPath . DIRECTORY_SEPARATOR . $view . '.php')) {
      throw new \Exception("A view {$view} não existe");
    }

    $templates = new Engine($viewsPath);
    echo $templates->render($view, $data);
  }
}