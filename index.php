<?php

$action = isset($_GET['action']) ? strval($_GET['action']): '';

/* Decoupe l'url en liste */
$action_list = explode('/', $action);

if(isset($action) && isset($action_list[0])) {
  /* On trouve le nom du controleur */
  $controller_name = $action_list[0] . 'Controller';
  

  /* On importe le controleur */
  require 'controller/'. $controller_name . '.php';

  /* On instancie le controleur */
  $controller = new $controller_name ;
}


?>
