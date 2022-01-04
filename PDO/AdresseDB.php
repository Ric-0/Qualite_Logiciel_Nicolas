<?php
require_once "Constantes.php";
require_once "metier/Adresse.php";

/**
 * 
*Classe permettant d'acceder en bdd pour inserer supprimer modifier
 * selectionner l'objet Adresse
 * @author pascal Lamy
 *
 */
class AdresseDB 
{
	private $db; // Instance de PDO
	
	public function __construct($db)
	{
		$this->db=$db;;
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Adresse en base de donnee
	 * @param Adresse $p
	 */
	public function ajout(Adresse $a)
	{
	//TODO insertion de l'adresse en bdd
	}
    /**
     * 
     * fonction de Suppression de l'objet Adresse
     * @param Adresse $a
     */
	public function suppression(Adresse $a){
		 //TODO suppression de l'adresse en bdd
	}
/** 
	 * Fonction de modification d'une adresse
	 * @param Adresse $a
	 * @throws Exception
	 */
public function update(Adresse $a)
	{
		try {
		//TODO mise a jour de l'adresse en bdd
		}
		catch(Exception $e){
			//TODO definir constante de l'exception
			throw new Exception(); 
			
		}
	}
	/**
	 * 
	 * Fonction qui retourne toutes les adresses
	 * @throws Exception
	 */
	public function selectAll(){
		
		//TODO selection de l'adresse
		
	//TODO definir constante de l'exception
		if(empty($result)){
			throw new Exception();
		}
	}	
		/**
	 * 
	 * Fonction qui retourne l'adresse en fonction de son id
	 * @throws Exception
	 * @param $id
	 */
	public function selectAdresse($id){
		//TODO definir constante de l'exception
		if(empty($id)){
			throw new Exception();
		}
			//TODO selection de l'adresse en fonction de son id
		
	}	
	/**
	 * 
	 * Fonction qui convertie un PDO Adresse en objet Adresse
	 * @param $pdoAdres
	 * @throws Exception
	 */
	private function convertPdoPers($pdoAdres){
	//TODO conversion du PDO ADRESSE en objet adresse
	}
}