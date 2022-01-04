<?php

include_once"vue/vueAuthentification.php";

class Controller {

	public function __construct()
	{
// Active tout les warning. Utile en phase de développement
	// En phase de production, remplacer E_ALL par 0
error_reporting(0);

//appel de la vue authentification

$v=new vueAuthentification();
$v->affiche();
	}
    public static function auth() {
        if (isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_GET['id'])) {

            if ($_SESSION['token'] == $_GET['id']) {
                //On stocke le timestamp il y a 30 minutes
                $timestamp_ancien = time() - (30 * 60);
                //Si le jeton n'est pas expiré
                if ($_SESSION['token_time'] >= $timestamp_ancien) {
                    //insertion cookies du token
                    setcookie("Nantes", $_SESSION['token'], time() + 1800);
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }
}



?>