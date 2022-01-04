<?php
class accueilController {

	public function __construct()
	{      
session_start();
error_reporting(0);
require_once "controller/Controller.php";
require_once "vue/vueAccueil.php";


if(Controller::auth())
        {
$v=new vueAccueil();
$v->affiche();

        }
	

else
{
	
	header('Location: index.php?error=login');

}
    }
}