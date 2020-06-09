<?php

namespace App\Controllers;
use App\Models\User;
use Respect\Validation\Validator as v;
class UsersController extends BaseController{
  public function getAddUserAction($request){
    $responseMessage= null;
      if($request->getMethod()=='POST'){
        $postData = $request->getParsedBody();
        $userValidator = v::key('email', v::stringType()->notEmpty())
                         ->key('password',v::stringType()->notEmpty());
       try {
         $userValidator->assert($postData);
         $postData = $request->getParsedBody();

          $user = new User();
          $user->email = $postData['email'];
          $user->password = password_hash($postData['password'],PASSWORD_DEFAULT);
          $user->save();
          $responseMessage = 'Usuario Guardado';
       } catch (\Exception $e) {
         $responseMessage = ($e->getMessage());
       }
      }

    return $this->renderHTML('addUser.twig',[
      'responseMessage' =>$responseMessage
    ]);
  }

  public function showUsersAction() {
      $users= User::all();
      return $this->renderHTML('showusers.twig',[
        'users' => $users
      ]);

  }

  public function editUsersAction($request) {
      $getData =$request->getQueryParams();
      $id= $getData['id'];
      if($id > 0){
      $users = User::find($id);
      return $this->renderHTML('editusers.twig',[
        'users' => $users
      ]);
      }
      else {
        $users= User::all();
        return $this->renderHTML('showusers.twig',[
          'users' => $users
        ]);

    }
  }
  public function updateUsersAction($request){
    if($request->getMethod()=='POST'){
      $postData = $request->getParsedBody();
      $id = $postData['id'];
      $users = User::find($id);
      $users->email = $postData['email'];
      $users->type = $postData['type'];
      $users->save();
    }
    $users= User::all();
    return $this->renderHTML('showusers.twig',[
      'users' => $users
    ]);
  }
  public function deleteUsersAction($request){
    $getData =$request->getQueryParams();
    $id= $getData['id'];
    $users = User::find($id);
    $users->delete();
    $users= User::all();
    return $this->renderHTML('showusers.twig',[
      'users' => $users
    ]);
  }
}
