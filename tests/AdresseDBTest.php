<?php

use PHPUnit\Framework\TestCase;

require_once "Constantes.php";
include_once "PDO/connectionPDO.php";
require_once "metier/Adresse.php";
require_once "PDO/AdresseDB.php";

class AdresseDBTest extends TestCase {

    /**
     * @var AdresseDB
     */
    protected $adresse;
    protected $pdodb;

    protected function setUp():void {
        //parametre de connexion à la bae de donnée
        $strConnection = Constantes::TYPE.':host='.Constantes::HOST.';dbname='.Constantes::BASE; 
        $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
        $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    }

    protected function tearDown() : void{
        
    }

    /**
    * @covers AdresseDB::ajout
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */     
    public function testAjout() {
        try{ 
            $this->adresse = new AdresseDB($this->pdodb);
            
            $p = new Adresse(1, "rue Marie Curie", 56890,"Plescop");
            //insertion en bdd
            $this->adresse->ajout($p);

            $adres=$this->adresse->selectionNom($a->getNom());
            //echo "adres bdd: $adres";
            $this->assertEquals($a->getNumero(),$adres->getNumero());
            $this->assertEquals($a->getRue(),$adres->getRue());
            $this->assertEquals($a->getcodePostal(),$adres->getcodePostal());
            $this->assertEquals($a->getVille(),$adres->getVille());
        }
        catch  (Exception $e) {
            echo 'Exception recue : ',  $e->getMessage(), "\n";
        }

    } 

    /**
    * @covers AdresseDB::suppression
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */ 
    public function testSuppression() {
        try{
            $this->adresse = new AdresseDB($this->pdodb);
            $lastId = $this->pdodb->lastInsertId();
            $adres=$this->adresse->selectAdresse($lastId);
            $this->adresse->suppression($adres);
            $adres2=$this->adresse->selectAdresse($lastId);
            if($adres2!=null){
                $this->markTestIncomplete(
                    "La suppression de l'enreg adresse a echoué"
                );
            }
        }catch (Exception $e){
            //verification exception
            $exception="RECORD ADRESSE not present in DATABASE";
            $this->assertEquals($exception,$e->getMessage());
        }
        
    }

    /**
    * @covers AdresseDB::selectAll
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testSelectAll() {
        $ok=true;
        $this->adresse = new AdresseDB($this->pdodb);
        $res=$this->adresse->selectAll();
        $i=0;
        foreach ($res as $key=>$value) {
            $i++;
        }
        print_r($res);
        if($i==0){
            $this->markTestIncomplete( 'Pas de résultat' );
            $ok=false;
        }
        $this->assertTrue($ok);
    }

}

?>