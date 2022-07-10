<?php 

namespace app\helpers;

class Uri 
{
  public function get(string $type): string
  {
    return parse_url($_SERVER['REQUEST_URI'])[$type];
  }
}