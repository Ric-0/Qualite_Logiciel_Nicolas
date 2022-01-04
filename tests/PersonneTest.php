<?php 
use PHPUnit\Framework\TestCase;
require_once 'metier/Personne.php';

/**
 * Personne test case.
 */
class PersonneTest extends TestCase
{

    /**
     *
     * @var Personne
     */
    private $personne;

    /**
     * Prepares the environment before running a test.
     *  @coversNothing
     */
    public function setUp(): void
    {
        parent::setUp();

        // TODO Auto-generated PersonneTest::setUp()
        $date='15/12/1950';
        $dt = DateTime::createFromFormat('d/m/Y', $date);
        $this->personne = new Personne("Hollande", "Francois",$dt,"0656463524", "fhollande@free.fr", "fhollande", "monpwd");
        $this->personne->setId(49);
    }

    /**
     * Cleans up the environment after running a test.
     *  @coversNothing
     */
    public function tearDown(): void
    {
        // TODO Auto-generated PersonneTest::tearDown()
        $this->personne = null;

        parent::tearDown();
    }




    /**
     * @covers Personne::getId
     * Tests Personne->getId()
     */
    public function testGetId()
    {
        

       $this->assertEquals(49, $this->personne->getId());
      
    }

    /**
     * @covers Personne::getNom
     * Tests Personne->getNom()
     */
    public function testGetNom()
    {
      

        $this->assertEquals("Hollande", $this->personne->getNom());
       
    }

    /**
     *@covers Personne::getPrenom
     * Tests Personne->getPrenom()
     */
    public function testGetPrenom()
    {
      

        $this->assertEquals("Francois", $this->personne->getPrenom());
    }
    public function testGetDatenaissance()
    {
        
        $dateF='15/12/1950';
        $dateFR = DateTime::createFromFormat('d/m/Y', $dateF);
        $this->assertEquals($dateFR, $this->personne->getDatenaissance());

    }

/**
     * Tests Personne->getTelephone()
     * @covers Personne::getTelephone
     */
    public function testGetTelephone()
    {
   

    $this->assertEquals("0656463524", $this->personne->getTelephone());
    }

    /**
     * Tests Personne->getEmail()
     * @covers Personne::getEmail
     */
    public function testGetEmail()
    {


    $this->assertEquals("fhollande@free.fr",$this->personne->getEmail());
    }

    /**
     * Tests Personne->getLogin()
     * @covers Personne::getLogin
     */
    public function testGetLogin()
    {
  

        $this->assertEquals("fhollande",$this->personne->getLogin());
    }

    /**
     * Tests Personne->getPwd()
     * @covers Personne::getPwd
     */
    public function testGetPwd()
    {
    
        $this->personne->setPwd("monpwd"); 
        $this->assertEquals(md5("monpwd"),$this->personne->getPwd());
    }

    /**
     * Tests Personne->setId()
     * @covers Personne::setId
     */
    public function testSetId()
    {
      
        $this->personne->setId(5);
        $this->assertEquals(5, (int)$this->personne->getId());
    }

    /**
     * Tests Personne->setNom()
     * @covers Personne::setNom
     */
    public function testSetNom()
    {
      

        $this->personne->setNom("Macron");
        $this->assertEquals("Macron", $this->personne->getNom());
    }

    /**
     * Tests Personne->setPrenom()
     * @covers Personne::setPrenom
     */
    public function testSetPrenom()
    {
        $this->personne->setPrenom("Emmanuel");
        $this->assertEquals("Emmanuel", $this->personne->getPrenom());
    }
    /**
     * 
     * @covers Personne::setDateNaissance
     */
    public function testSetDateNaissance()
    {
        $dateF='1980-12-15';
        $dateFR = DateTime::createFromFormat('Y-m-d', $dateF);
        $this->personne->setDateNaissance($dateFR);
        $this->assertEquals($dateFR, $this->personne->getDatenaissance());
      
    }
     /**
     * 
     * @covers Personne::setTelephone
     */
    public function testSetTelephone()
    {


        $this->personne->setTelephone("0102030405");
        $this->assertEquals("0102030405", $this->personne->getTelephone());
    }
     /**
     * Tests Personne->setEmail()
    
     * @covers Personne::setEmail
     */
 
    public function testSetEmail()
    {
        $this->personne->setEmail("emacron@free.Fr");
        $this->assertEquals("emacron@free.Fr", $this->personne->getEmail());
    }

    /**
     * Tests Personne->setLogin()
     * @covers Personne::setLogin
     */
     
    public function testSetLogin()
    {
      
        $this->personne->setLogin("emacron");
        $this->assertEquals("emacron", $this->personne->getLogin());
    }

    /**
     * Tests Personne->setPwd()
     * @covers Personne::setPwd
     */
    public function testSetPwd()
    {
    
        $this->personne->setPwd("brigitte");
        $this->assertEquals(md5("brigitte"), $this->personne->getPwd());
    }

    /**
     * Tests Personne->__toString()
     * @covers Personne::__toString
     */
    public function test__toString()
    {
        $this->assertEquals("[".$this->personne->getNom().",".$this->personne->getPrenom().",".$this->personne->getDatenaissance()->format('Y-m-d').",".$this->personne->getTelephone().",".$this->personne->getEmail().",".$this->personne->getLogin().",".$this->personne->getPwd()."]", $this->personne->__toString());

    }
}

   



