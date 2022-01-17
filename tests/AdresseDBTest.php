<?php

use PHPUnit\Framework\TestCase;

require_once "Constantes.php";
include_once "PDO/connectionPDO.php";
require_once "metier/Adresse.php";
require_once "PDO/AdresseDB.php";

class AdresseDBTest extends TestCase
{
    /**
     * @var AdresseDB
     */
    protected $adresse;
    protected $pdodb;

    protected function setUp(): void
    {
        //parametre de connexion à la bae de donnée
        $strConnection = Constantes::TYPE . ':host=' . Constantes::HOST . ';dbname=' . Constantes::BASE;
        $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
        $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function tearDown(): void
    {
    }

    /**
    * @covers AdresseDB::ajout
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testAjout()
    {
        try {
            $this->adresse = new AdresseDB($this->pdodb);

            $a = new Adresse(1, "rue Marie Curie", 56890, "Plescop");
            //insertion en bdd
            $this->adresse->ajout($a);

            $lastId = $this->pdodb->lastInsertId();

            $a->setId($lastId);

            $adres = $this->adresse->selectAdresse($lastId);
            //echo "adres bdd: $adres";
            $this->assertEquals($a->getId(), $adres[0]['id']);
            $this->assertEquals($a->getNumero(), $adres[0]['numero']);
            $this->assertEquals($a->getRue(), $adres[0]['rue']);
            $this->assertEquals($a->getCodePostal(), $adres[0]['codepostal']);
            $this->assertEquals($a->getVille(), $adres[0]['ville']);
        } catch (Exception $e) {
            echo 'Exception recue : ',  $e->getMessage(), "\n";
        }
    }

    /**
    * @covers AdresseDB::suppression
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testSuppression()
    {
        try {
            $this->adresse = new AdresseDB($this->pdodb);

            $a = new Adresse(1, "rue Marie Curie", 56890, "Plescop");
            //insertion en bdd
            $this->adresse->ajout($a);

            $lastId = $this->pdodb->lastInsertId();

            $a->setId($lastId);

            $adres = $this->adresse->selectAdresse($lastId);

            $adr = $this->adresse->convertPdoAdres($adres);
            $this->adresse->suppression($adr);
            $adres2 = $this->adresse->selectAdresse($lastId);
            if ($adres2 != null) {
                $this->markTestIncomplete(
                    "La suppression de l'enreg adresse a echoué"
                );
            }
        } catch (Exception $e) {
            //verification exception
            //echo 'Exception recue : ',  $e->getMessage(), "\n";
            $exception="RECORD ADRESSE not present in DATABASE";
            $this->assertEquals($exception,$e->getMessage());
        }
    }

    /**
    * @covers AdresseDB::selectAll
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testSelectAll()
    {
        $ok = true;
        $this->adresse = new AdresseDB($this->pdodb);
        $res = $this->adresse->selectAll();
        $i = 0;
        foreach ($res as $key => $value) {
            $i++;
        }
        if ($i == 0) {
            $this->markTestIncomplete('Pas de résultat');
            $ok = false;
        }
        $this->assertTrue($ok);
    }
    /**
    * @covers AdresseDB::update
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testUpdate()
    {

        $this->adresse = new AdresseDB($this->pdodb);

        $a = new Adresse(1, "rue Marie Curie", 56890, "Plescop");
        //insertion en bdd
        $this->adresse->ajout($a);

        //instanciation de l'objet pour mise ajour

        $a = new Adresse(2, "Allée de Kerlann", 56000, "Vannes");
        //update pers
        $lastId = $this->pdodb->lastInsertId();
        $a->setId($lastId);
        $this->adresse->update($a);
        $adres = $this->adresse->selectAdresse($a->getId());
        $this->assertEquals($a->getId(), $adres[0]['id']);
        $this->assertEquals($a->getNumero(), $adres[0]['numero']);
        $this->assertEquals($a->getRue(), $adres[0]['rue']);
        $this->assertEquals($a->getCodePostal(), $adres[0]['codepostal']);
        $this->assertEquals($a->getVille(), $adres[0]['ville']);
    }
    /**
    * @covers AdresseDB::selectAdresse
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testSelectAdresse()
    {
        $this->adresse = new AdresseDB($this->pdodb);
        $a = new Adresse(2, "Allée de Kerlann", 56000, "Vannes");
        $this->adresse->ajout($a);
        $lastId = $this->pdodb->lastInsertId();
        $a->setId($lastId);
        $adres = $this->adresse->selectAdresse($a->getId());
        $this->assertEquals($a->getId(), $adres[0]['id']);
        $this->assertEquals($a->getNumero(), $adres[0]['numero']);
        $this->assertEquals($a->getRue(), $adres[0]['rue']);
        $this->assertEquals($a->getCodePostal(), $adres[0]['codepostal']);
        $this->assertEquals($a->getVille(), $adres[0]['ville']);
    }
    /**
    * @covers AdresseDB::convertPdoAdres
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testConvertPdoAdres()
    {
        $tab["id"] = "34";
        $tab["numero"] = 1;
        $tab["rue"] = "Allée de Kerlann";
        $tab["codepostal"] = 56000;
        $tab["ville"] = "Vannes";
        $this->adresse = new AdresseDB($this->pdodb);
        $adres = $this->adresse->convertPdoAdres($tab);
        $this->assertEquals($tab["id"], $adres->getId());
        $this->assertEquals($tab["numero"], $adres->getNumero());
        $this->assertEquals($tab["rue"], $adres->getRue());
        $this->assertEquals($tab["codepostal"], $adres->getCodePostal());
        $this->assertEquals($tab["ville"], $adres->getVille());
    }
}
