<?php
ini_set('display_errors',1);
ini_set('display_starup_error',1);
error_reporting(E_ALL);
require_once '../vendor/autoload.php';
date_default_timezone_set("America/Guayaquil");
session_start();
use Aura\Router\RouterContainer;

use Illuminate\Database\Capsule\Manager as Capsule;


$capsule = new Capsule;

 //$capsule->addConnection([
//     'driver'    => 'mysql',
//     'host'      => 'localhost',
//     'database'  => 'stz',
//     'username'  => 'root',
//     'password'  => '',
//     'charset'   => 'utf8',
//     'collation' => 'utf8_unicode_ci',
//     'prefix'    => '',
 //]);


$capsule->addConnection([
//     'driver'    => 'psql',
//     'host'      => 'ec2-52-44-55-63.compute-1.amazonaws.com',
//     'database'  => 'db93qttg5ej8kg',
//     'username'  => 'lsyglveqvzwfuw',
//     'password'  => '33baad8fbb8c693fca543406b62d8184096a681afb1628ed4909714e1a507849',
//     'charset'   => 'utf8',
//     'collation' => 'utf8_unicode_ci',
//     'prefix'    => '',
//     'port'    => '5432',
 ]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

 $request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
     $_SERVER,
     $_GET,
     $_POST,
     $_COOKIE,
     $_FILES
 );


 $routerContainer = new RouterContainer();
 $map = $routerContainer->getMap();
 $map->get('index','/',[
   'controller' => 'App\Controllers\IndexController',
   'action' => 'indexAction'
 ]);

 //Users
 $map->get('addUser','/users/add',[
   'controller' => 'App\Controllers\UsersController',
   'action' => 'getAddUserAction'
 ]);
 $map->post('saveUsers', '/user/add',[
  'controller' => 'App\Controllers\UsersController',
  'action' => 'getAddUserAction'
]);

$map->post('auth', '/auth',[
  'controller' => 'App\Controllers\AuthController',
  'action' => 'postLogin'
]);


//Admin

$map->get('admin', '/admin',[
  'controller' => 'App\Controllers\AdminController',
  'action' => 'getIndex',
]);


//Ejercicios
$map->get('showeje', '/ejercicios',[
  'controller' => 'App\Controllers\EjerciciosController',
  'action' => 'ENS_0135Action',
]);


//Telematica Paginas Hora

$map->get('showENS_0135', '/telematica/ENS_0135',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'ENS_0135Action',
]);

$map->get('showENS_0136', '/telematica/ENS_0136',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'ENS_0136Action',
]);

$map->get('showENS_0137', '/telematica/ENS_0137',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'ENS_0137Action',
]);

//Telematica Paginas Fechas

$map->get('showENS_0135_Fechas', '/telematica/ENS_0135_Fechas',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'ENS_0135_Fechas_Action',
]);

$map->get('showENS_0136_Fechas', '/telematica/ENS_0136_Fechas',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'ENS_0136_Fechas_Action',
]);

$map->get('showENS_0137_Fechas', '/telematica/ENS_0137_Fechas',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'ENS_0137_Fechas_Action',
]);


//Telematica Json
$map->get('jsonTelematica','/telematica/json',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'jsonTelematicaAction'
]);

$map->get('json1Telematica','/telematica/json1',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'jsonTelematicaAction1'
]);
//Telematica Añadir
$map->get('addTelematica','/telematica/add',[
  'controller' => 'App\Controllers\TelematicaController',
  'action' => 'addTelematicaAction'
]);


//Inicio Sección
$map->get('loginForm', '/login',[
  'controller' => 'App\Controllers\AuthController',
  'action' => 'getLogin'
]);

$map->get('logout', '/logout',[
  'controller' => 'App\Controllers\AuthController',
  'action' => 'getLogout'
]);

 $matcher = $routerContainer->getMatcher();
 $route = $matcher->match($request);

 if(!$route){
   echo 'No route';
 }else{
   $handlerData = $route->handler;
   $controllerName= $handlerData['controller'];
   $actionName = $handlerData['action'];
   $needsAuth = $handlerData['auth'] ?? false;

   $sessionUserId = $_SESSION['userId']?? null;
   if($needsAuth && !$sessionUserId){
     echo 'Procted route';
     die;
    }
   $controller = new $handlerData['controller'];
   $response = $controller->$actionName($request);

   foreach($response->getHeaders() as $name=> $values)
   {
     foreach($values as $value){
       header(sprintf('%s: %s',$name, $value),false);
     }
   }
   http_response_code($response->getStatusCode());
   echo $response->getBody();
 }

 ?>
