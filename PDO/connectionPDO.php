<?php
/**
 * fichier necessaire a la connexion ala base de donnée, les variables de connexions sont définies dans le fichier constantes.php
 */
include_once "Constantes.php";
try {

    $strConnection = Constantes::TYPE.':host='.Constantes::HOST.';dbname='.Constantes::BASE; 
    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $pdo = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Ligne 4
}
catch(PDOException $e) {
    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
    die($msg);
}
