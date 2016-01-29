<?php
require_once __DIR__.'\..\Persistence\PersistenceEventRegistration.php';
require_once __DIR__.'\..\Model\Participant.php';
require_once __DIR__.'\..\Model\RegistrationManager.php';


class PersistenceEventRegistrationTest  extends PHPUnit_Framework_TestCase
{
	protected $pm;
	
	protected function setUp()
	{
		$this -> pm = new PersistenceEventRegistration();
		
	}
	
	protected function tearDown()
	{
		
	}
	
	public function testPersistence()
	{
		$rm = RegistrationManager :: getInstance();
		$participant = new Participant("Frank");
		$rm -> addParticipant($participant);
		
		$this -> pm -> writeDataToStore($rm);
		
		$rm -> delete();
		
		$this -> assertEquals(0, count($rm->getParticipants()));
		
		$rm = $this -> pm-> loadDataFromStore();
		$this -> assertEquals(1, count($rm->getParticipants()));
		$myParticipant = $rm -> getParticipant_index(0);
		$this -> assertEquals("Frank", $myParticipant->getName());
		
	}
	
	
}