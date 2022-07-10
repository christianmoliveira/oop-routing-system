<?php

namespace app\helpers;

class Request
{
  public function get(): string
  {
    return $_SERVER['REQUEST_METHOD'];
  }
}
