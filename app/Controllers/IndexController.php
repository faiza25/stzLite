<?php
namespace App\Controllers;
use App\Models\{Job};
class IndexController extends BaseController{
  public function indexAction() {

      return $this->renderHTML('login.twig');

  }



}
