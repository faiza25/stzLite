<?php

namespace App\Controllers;
use App\Models\User;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController{
  public function getLogin(){
    return $this->renderHTML('login.twig');
  }
  public function postLogin($request){
    $super = 'superusuario';
    $usuario ='usuario';
    $responseMessage= null;
    $postData =$request->getParsedBody();
    $user= User::where('email', $postData['email'])->first();
    if($user){
        if(\password_verify($postData['password'],$user->password)){
            $_SESSION['userId']= $user->id;
            return new RedirectResponse('/ENS_TELEMATICA/admin');
        }else{
          $responseMessage = 'Credenciales Erroneas';
        }
    }else {
      $responseMessage= 'Credenciales Erroneas';
    }

  return $this->renderHTML('login.twig',[
    'responseMessage' => $responseMessage
  ]);

  }
  public function getLogout(){
      unset($_SESSION['userId']);
      return new RedirectResponse('/ENS_TELEMATICA/login');

  }
}
