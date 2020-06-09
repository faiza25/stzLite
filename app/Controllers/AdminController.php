<?php
namespace App\Controllers;
use App\Models\{ENS_0135,ENS_0136,ENS_0137};
class AdminController extends BaseController{
  public function getIndex() {

    $principal ="/ENS_TELEMATICA/telematica/json1?id_ENS=0135";
    $principal1 ="/ENS_TELEMATICA/telematica/json1?id_ENS=0136";
    $principal2 ="/ENS_TELEMATICA/telematica/json1?id_ENS=0137";
    $dia = date("Y-m-d");
    $inicio =$dia;

    $array = [
    "principal" => $principal,
    "principal1"=>$principal1,
    "principal2"=>$principal2,
    "inicio" => $inicio,
    ];

    return $this->renderHTML('admin.twig',[
      'response' => $array
    ]);

  }

}
