<?php 

namespace app\controllers;

class HomeController extends Controller
{
  public function index($request)
  {
    $this->view('home');
  }
}