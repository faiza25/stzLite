<?php
namespace App\Controllers;
use App\Models\{Ejercicios};
use Cache;
class EjerciciosController extends BaseController{

  public function  ENS_0135Action($request) {
    $principal ="Hola";
    $dia = date("Y-m-d");
    $inicio =$dia;

    if($request->getMethod()=='GET'){
        $getData =$request->getQueryParams();
        $name =$getData['name'];
    }

    $telematicas = Ejercicios::where('name','=',$name)
            ->orderBy('created_at', 'asc')
            ->get();

    $array = [
    "principal" => $principal,
    "inicio" => $inicio,
    ];

    return $this->renderHTML('ENS_0135.twig',[
      'response' => $telematicas,
      'name'=>$name
    ]);
  }

}
