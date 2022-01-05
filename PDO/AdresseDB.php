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
		$q = $this->db->prepare('INSERT INTO adresse(numero,rue,codepostal,ville) values(:numero,:rue,:codepostal,:ville)');
		
		$q->bindValue(':numero',$a->getNumero());
		$q->bindValue(':rue',$a->getRue());
		$q->bindValue(':codepostal',$a->getCodePostal());
		$q->bindValue(':ville',$a->getVille());
		$q->execute();	
		$q->closeCursor();
		$q = NULL;
	}
    /**
     * 
     * fonction de Suppression de l'objet Adresse
     * @param Adresse $a
     */
	public function suppression(Adresse $a){
		$q = $this->db->prepare('delete from adresse where numero=:n and rue=:r and codepostal=:c and ville=:v');
		$q->bindValue(':n',$a->getNumero());
		$q->bindValue(':r',$a->getRue());
		$q->bindValue(':c',$a->getCodePostal());
		$q->bindValue(':v',$a->getVille());			
		$q->execute();	
		$q->closeCursor();
		$q = NULL;
	}
/** 
	 * Fonction de modification d'une adresse
	 * @param Adresse $a
	 * @throws Exception
	 */
public function update(Adresse $a)
	{
		try {
			$q = $this->db->prepare('UPDATE adresse set numero=:n,rue=:r,codepostal=:c,ville=:v where id=:i');
			$q->bindValue(':i', $a->getId());	
			$q->bindValue(':n', $a->getNumero());	
			$q->bindValue(':r', $a->getRue());	
			$q->bindValue(':c', $a->getCodePostal());	
			$q->bindValue(':v', $a->getVille());

			

			$q->execute();	
			$q->closeCursor();
			$q = NULL;
		}
		catch(Exception $e){
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
		}
	}
	/**
	 * 
	 * Fonction qui retourne toutes les adresses
	 * @throws Exception
	 */
	public function selectAll(){
		
		$query = 'SELECT id,numero,rue,codepostal,ville FROM adresse';
		$q = $this->db->prepare($query);
		$q->execute();
		
		$arrAll = $q->fetchAll(PDO::FETCH_ASSOC);
		
		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
		}
		$q->closeCursor();
		$q = NULL;
		return $arrAll;
	}	
		/**
	 * 
	 * Fonction qui retourne l'adresse en fonction de son id
	 * @throws Exception
	 * @param $id
	 */
	public function selectAdresse($id){
		if(empty($id)){
			throw new Exception(EXCEPTION_DB_ADRESSE);
		}
		$query = 'SELECT numero,rue,codepostal,ville FROM adresse WHERE id=:i';
		$q->bindValue(':i', $id);	
		$q = $this->db->prepare($query);
		$q->execute();
		
		$arrAll = $q->fetchAll(PDO::FETCH_ASSOC);
		
		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
		}
		$q->closeCursor();
		$q = NULL;
		return $arrAll;
	}	
	/**
	 * 
	 * Fonction qui convertie un PDO Adresse en objet Adresse
	 * @param $pdoAdres
	 * @throws Exception
	 */
	private function convertPdoAdres($pdoAdres){
	//TODO conversion du PDO ADRESSE en objet adresse
		if(empty($pdoAdres)){
			throw new Exception(Constantes::EXCEPTION_DB_CONVERT_ADRES);
		}
		//conversion du pdo en objet
		$obj=(object)$pdoAdres;
		//print_r($obj);
		//conversion de l'objet en objet adresse
		$adres=new Adresse($obj->numero,$obj->rue,$dt,$obj->codePostal, $obj->ville);
		//affectation de l'id pers
		$adres->setId($obj->id);
	 	return $adres;
	}
}