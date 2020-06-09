<?php
namespace App\Controllers;
use App\Models\{ENS_0135,ENS_0136,ENS_0137};
use Cache;
class TelematicaController extends BaseController{

  public function  ENS_0135Action() {
    $principal ="/ENS_TELEMATICA/telematica/json?id_ENS=0135";
    $dia = date("Y-m-d");
    $inicio =$dia;

    $array = [
    "principal" => $principal,
    "inicio" => $inicio,
    ];

    return $this->renderHTML('ENS_0135.twig',[
      'response' => $array
    ]);
  }
  public function  ENS_0136Action() {
    $principal ="/ENS_TELEMATICA/telematica/json?id_ENS=0136";
    $dia = date("Y-m-d");
    $inicio =$dia;

    $array = [
    "principal" => $principal,
    "inicio" => $inicio,
    ];

    return $this->renderHTML('ENS_0136.twig',[
      'response' => $array
    ]);
  }

  public function  ENS_0137Action() {
    $principal ="/ENS_TELEMATICA/telematica/json?id_ENS=0137";
    $dia = date("Y-m-d");
    $inicio =$dia;

    $array = [
    "principal" => $principal,
    "inicio" => $inicio,
    ];

    return $this->renderHTML('ENS_0137.twig',[
      'response' => $array
    ]);
  }

  public function  ENS_0135_Fechas_Action($request) {
    if($request->getMethod()=='GET'){
        $getData =$request->getQueryParams();
        $inicio =$getData['inicio'];
        $final =$getData['final'];
    }

    $principal ="/ENS_TELEMATICA/telematica/json?id_ENS=0135";

    $array = [
    "principal" => $principal,
    "inicio" => $inicio,
    "final" => $final,
    ];

    return $this->renderHTML('ENS_0135_Fecha.twig',[
      'response' => $array
    ]);
  }

  public function  ENS_0136_Fechas_Action($request) {
    if($request->getMethod()=='GET'){
        $getData =$request->getQueryParams();
        $inicio =$getData['inicio'];
        $final =$getData['final'];
    }

    $principal ="/ENS_TELEMATICA/telematica/json?id_ENS=0136";

    $array = [
    "principal" => $principal,
    "inicio" => $inicio,
    "final" => $final,
    ];

    return $this->renderHTML('ENS_0136_Fecha.twig',[
      'response' => $array
    ]);
  }

  public function  ENS_0137_Fechas_Action($request) {
    if($request->getMethod()=='GET'){
        $getData =$request->getQueryParams();
        $inicio =$getData['inicio'];
        $final =$getData['final'];
    }

    $principal ="/ENS_TELEMATICA/telematica/json?id_ENS=0137";

    $array = [
    "principal" => $principal,
    "inicio" => $inicio,
    "final" => $final,
    ];

    return $this->renderHTML('ENS_0137_Fecha.twig',[
      'response' => $array
    ]);
  }

  public function  jsonTelematicaAction($request) {
    if($request->getMethod()=='GET'){
      $inicio="";
      $final="";
      $getData =$request->getQueryParams();
        $id_ENS=$getData['id_ENS'];
        $inicio=$getData['inicio'];
        $final=$getData['final'];
        if( $final==null){

          if($id_ENS=='0135'){
            $telematicas= ENS_0135::all();
            $telematicas = ENS_0135::where('Fecha','=',$inicio)
                    ->orderBy('created_at', 'asc')
                    ->limit(96)
                    ->get();
            return $this->renderJson($telematicas);
          }
          if($id_ENS=='0136'){
            $telematicas = ENS_0136::where('Fecha','=',$inicio)
                    ->orderBy('created_at', 'asc')
                    ->limit(96)
                    ->get();
            return $this->renderJson($telematicas);
          }
          if($id_ENS=='0137'){
            $telematicas = ENS_0137::where('Fecha','=',$inicio)
                    ->orderBy('created_at', 'asc')
                    ->limit(96)
                    ->get();
            return $this->renderJson($telematicas);
          }

      }else{

         if($id_ENS=='0135'){
           $telematicas= ENS_0135::all();
           $telematicas = ENS_0135::whereBetween('Fecha',array($inicio,$final))
                   ->orderBy('created_at', 'asc')
                   ->limit(1000)
                   ->get();
           return $this->renderJson($telematicas);
         }
        if($id_ENS=='0136'){
          $telematicas= ENS_0136::all();
          $telematicas = ENS_0136::whereBetween('Fecha',array($inicio,$final))
                  ->orderBy('created_at', 'asc')
                  ->limit(1000)
                  ->get();
          return $this->renderJson($telematicas);
        }
        if($id_ENS=='0137'){
          $telematicas= ENS_0137::all();
          $telematicas = ENS_0137::whereBetween('Fecha',array($inicio,$final))
                  ->orderBy('created_at', 'asc')
                  ->limit(1000)
                  ->get();
          return $this->renderJson($telematicas);
        }



      }
    }
  }

  public function  jsonTelematicaAction1($request) {
    if($request->getMethod()=='GET'){
      $inicio="";
      $getData =$request->getQueryParams();
      $id_ENS=$getData['id_ENS'];
      $inicio=$getData['inicio'];
          if($id_ENS=='0135'){
            $telematicas= ENS_0135::all();
            $telematicas = ENS_0135::where('Fecha','=',$inicio)
                    ->orderBy('created_at', 'desc')
                    ->limit(96)
                    ->get();
            return $this->renderJson($telematicas);
          }
          if($id_ENS=='0136'){
            $telematicas = ENS_0136::where('Fecha','=',$inicio)
                    ->orderBy('created_at', 'desc')
                    ->limit(96)
                    ->get();
            return $this->renderJson($telematicas);
          }
          if($id_ENS=='0137'){
            $telematicas = ENS_0137::where('Fecha','=',$inicio)
                    ->orderBy('created_at', 'desc')
                    ->limit(96)
                    ->get();
            return $this->renderJson($telematicas);
          }


    }
  }


  public function addTelematicaAction($request) {
    date_default_timezone_set("America/Guayaquil");
    if($request->getMethod()=='GET'){
      $getData =$request->getQueryParams();
        $id_ENS=$getData['id_ENS'];
        if($id_ENS==null){
            $response= 'No almacenados';
        }else {
          $altura=$getData['altura'];
          $temperatura=$getData['temperatura'];
          $humedad=$getData['humedad'];
          $gsm=$getData['gsm'];
          $bateria=$getData['bateria'];
          $solar=$getData['solar'];
          $estado=$getData['estado'];
        if($altura==null){
          $altura=0;
        }
        if($temperatura==null){
          $temperatura=0;
        }
        if($humedad==null){
          $humedad=0;
        }
        if($gsm==null){
          $gsm=0;
        }
        if($bateria==null){
          $bateria=0;
        }
        if($solar==null){
          $solar=0;
        }
        if($estado==null){
          $estado=0;
        }

        if($id_ENS=='0135'){
        $telematicas = new ENS_0135();
        $telematicas->Altura = $altura;
        $telematicas->Temperatura = $temperatura;
        $telematicas->Humedad = $humedad;
        $telematicas->GSM = $gsm;
        $telematicas->Bateria = $bateria;
        $telematicas->Solar = $solar;
        $telematicas->Estado= $altura;
        $telematicas->Fecha=  date("Y-m-d");
        $telematicas->Hora= date("H:i:s");
        $telematicas->save();
        }
        if($id_ENS=='0136'){
        $telematicas = new ENS_0136();
        $telematicas->Altura = $altura;
        $telematicas->Temperatura = $temperatura;
        $telematicas->Humedad = $humedad;
        $telematicas->GSM = $gsm;
        $telematicas->Bateria = $bateria;
        $telematicas->Solar = $solar;
        $telematicas->Estado= $altura;
        $telematicas->Fecha=  date("Y-m-d");
        $telematicas->Hora= date("H:i:s");
        $telematicas->save();
        }

        if($id_ENS=='0137'){
        $telematicas = new ENS_0137();
        $telematicas->Altura = $altura;
        $telematicas->Temperatura = $temperatura;
        $telematicas->Humedad = $humedad;
        $telematicas->GSM = $gsm;
        $telematicas->Bateria = $bateria;
        $telematicas->Solar = $solar;
        $telematicas->Estado= $altura;
        $telematicas->Fecha=  date("Y-m-d");
        $telematicas->Hora= date("H:i:s");
        $telematicas->save();
        }

        $response= 'Datos ENS_TELEMATICA Almacenados';
        }
  }
      return $this->renderHTML('addTelematica.twig',[
        'response' => $response
      ]);
  }

}
