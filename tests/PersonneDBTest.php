<?php

use PHPUnit\Framework\TestCase;

require_once "Constantes.php";
include_once "PDO/connectionPDO.php";
require_once "metier/Personne.php";
require_once "PDO/PersonneDB.php";

class PersonneDBTest extends TestCase {

    /**
     * @var PersonneDB
     */
    protected $personne;
    protected $pdodb;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    
      /**
       * 
* @backupGlobals disabled
* @backupStaticAttributes disabled
* @coversNothing
*/ 

    protected function setUp():void {
        //parametre de connexion à la bae de donnée
     $strConnection = Constantes::TYPE.':host='.Constantes::HOST.';dbname='.Constantes::BASE; 
    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
    $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    }

    /**
     *@coversNothing
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() : void{
        
    }

    /**
     * @covers PersonneDB::ajout
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/     
    public function testAjout() {
       try{ 
   $this->personne = new PersonneDB($this->pdodb);
   
   $dt = new DateTime('1950-01-12');
   $p = new Personne("Hollande", "Francois",$dt,"0656463524", "fhollande@free.fr", "fhollande", "monpwd");
   $p->setPwd("monpwd");
//insertion en bdd
$this->personne->ajout($p);

$pers=$this->personne->selectionNom($p->getNom());
//echo "pers bdd: $pers";
$this->assertEquals($p->getNom(),$pers->getNom());
$this->assertEquals($p->getPrenom(),$pers->getPrenom());
$this->assertEquals($p->getTelephone(),$pers->getTelephone());
$this->assertEquals($p->getEmail(),$pers->getEmail());
$this->assertEquals($p->getLogin(),$pers->getLogin());
$this->assertEquals($p->getPwd(),$pers->getPwd());
$this->assertEquals($p->getDatenaissance()->format('Y-m-d'),$pers->getDatenaissance()->format('Y-m-d'));


    }
    catch  (Exception $e) {
    echo 'Exception recue : ',  $e->getMessage(), "\n";
}

    }  

  /**
   * @covers PersonneDB::suppression
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/ 
    public function testSuppression() {
        try{
  $this->personne = new PersonneDB($this->pdodb);

  $pers=$this->personne->selectionNom("Hollande");
$this->personne->suppression($pers);
  $pers2=$this->personne->selectionNom("Hollande");
if($pers2!=null){
      $this->markTestIncomplete(
                "La suppression de l'enreg personne a echoué"
        );
}
    }  catch (Exception $e){
        //verification exception
        $exception="RECORD PERSONNE not present in DATABASE";
        $this->assertEquals($exception,$e->getMessage());

    }
        
    }

    /**
     * @covers PersonneDB::selectionNom
     */
      /**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/ 
    public function testSelectionNom() {
     $this->personne = new PersonneDB($this->pdodb);
     $dt = new DateTime('1850-11-20');
 $p=new Personne("Valjean", "jean",$dt,"0712233445","jvaljean@free.fr","jvaljean","cosette");
 $p->setPwd("cosette");
$this->personne->ajout($p);

$pers=$this->personne->selectionNom($p->getNom());
$this->assertEquals($p->getNom(),$pers->getNom());
$this->assertEquals($p->getPrenom(),$pers->getPrenom());
$this->assertEquals($p->getDatenaissance()->format('Y-m-d'),$pers->getDatenaissance()->format('Y-m-d'));
$this->assertEquals($p->getTelephone(),$pers->getTelephone());
$this->assertEquals($p->getEmail(),$pers->getEmail());
$this->assertEquals($p->getLogin(),$pers->getLogin());
$this->assertEquals($p->getPwd(),$pers->getPwd());


    }

    /**
     * @covers PersonneDB::selectionId
     *
     */
     /**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/ 
    public function testSelectionId() {
         $this->personne = new PersonneDB($this->pdodb);
         $p=$this->personne->selectionNom("Valjean");
         $pers=$this->personne->selectionId($p->getId());
           $this->assertEquals($p->getId(),$pers->getId());
         $this->assertEquals($p->getNom(),$pers->getNom());
$this->assertEquals($p->getPrenom(),$pers->getPrenom(),"Valeur de retour de getPrenom() incorrecte");
$this->assertEquals($p->getDatenaissance()->format('Y-m-d'),$pers->getDatenaissance()->format('Y-m-d'));
$this->assertEquals($p->getTelephone(),$pers->getTelephone());
$this->assertEquals($p->getEmail(),$pers->getEmail());
$this->assertEquals($p->getlogin(),$pers->getLogin());
$this->assertEquals($p->getPwd(),$pers->getPwd());        
    }

    /**
     * @covers PersonneDB::selectAll
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    public function testSelectAll() {
        $ok=true;
    $this->personne = new PersonneDB($this->pdodb);
    $res=$this->personne->selectAll();
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

    /**
     * @covers PersonneDB::convertPdoPers
     * @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    public function testConvertPdoPers() {
     $tab["id"]="34";
     $tab["nom"]="Dupont";
     $tab["prenom"]="Jacques";
     $tab["email"]="dupont@free.fr";
     $tab["telephone"]="0645342312";
     $tab["datenaissance"]="2002-12-12";
     $tab["login"]="jdupont";
     $tab["pwd"]="4755edd32703675c6a021322f9ca0433";
     $this->personne = new PersonneDB($this->pdodb);
     $pers= $this->personne->convertPdoPers($tab);
     $this->assertEquals($tab["nom"],$pers->getNom());
$this->assertEquals($tab["prenom"],$pers->getPrenom());
$this->assertEquals( $tab["datenaissance"],$pers->getDatenaissance()->format('Y-m-d'));
$this->assertEquals($tab["telephone"],$pers->getTelephone());
$this->assertEquals(  $tab["email"],$pers->getEmail());
$this->assertEquals(  $tab["login"],$pers->getLogin());
$this->assertEquals(  $tab["pwd"],$pers->getPwd());
     
    }

    /**
     * @covers PersonneDB::update
       * @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    public function testUpdate() {
        
      $this->personne = new PersonneDB($this->pdodb);
        //insertion en bdd de l'enreg
        $dt = new DateTime('1950-01-12');
        $p = new Personne("Hollande", "Francois",$dt,"0656463524", "fhollande@free.fr", "fhollande", "monpwd");
        $p->setPwd("monpwd");
        $p->setId(99);
     //insertion en bdd
     $this->personne->ajout($p);

//instanciation de l'objet pour mise ajour

 $dt = new DateTime('1970-09-10');
  $p=new Personne("Martin", "Eric",$dt,"0102030405","meric@orange.fr","meric","4755edd32703675c6a021322f9ca0433");
//update pers 
$lastId = $this->pdodb->lastInsertId();
$p->setId($lastId);
$this->personne->update($p);  
$pers=$this->personne->selectionId($p->getId());
$this->assertEquals($p->getId(),$pers->getId());
$this->assertEquals($p->getNom(),$pers->getNom());
$this->assertEquals($p->getPrenom(),$pers->getPrenom());
$this->assertEquals($p->getDatenaissance()->format('Y-m-d'),$pers->getDatenaissance()->format('Y-m-d'));
$this->assertEquals($p->getTelephone(),$pers->getTelephone());
$this->assertEquals($p->getEmail(),$pers->getEmail());
$this->assertEquals($p->getlogin(),$pers->getLogin());
$this->assertEquals($p->getPwd(),$pers->getPwd());      

    }

}
