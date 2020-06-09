<?php
namespace App\Controllers;
use \Twig_Loader_Filesystem;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
class BaseController {
  protected $templateEngine;


  public function __construct(){
    $loader = new Twig_Loader_Filesystem('../views');

    $this->templateEngine = new \Twig_Environment($loader, array(
    'debug' => true,
    'cache' => false,
));
  }

public function renderHTML($fileName, $data = []){
  return new HtmlResponse ($this->templateEngine->render($fileName,$data));
}

public function renderJson($data){
  return new JsonResponse ($data);
}

}
