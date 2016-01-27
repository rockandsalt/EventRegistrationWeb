<?php

require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Controller\InputValidator.php';
require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Persistence\PersistenceEventRegistration.php';
require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Model\RegistrationManager.php';
require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Model\Participant.php';
require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Model\Event.php';
require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Model\Registration.php';

class Controller
{
	public function __contruct()
	{
		
	}
	
	public function createParticipant($participant_name)
	{
		$name = InputValidator::validate_input($participant_name);
		if($name == null || strlen($name)==0)
		{
			throw new Exception("Participant name cannot be empty!");
		}else{
			$pm = new PersistenceEventRegistration();
			$rm = $pm->loadDataFromStore();
			
			$participant = new Participant($name);
			$rm->addParticipant($Participant);
			
			$pm->writeDataToStore($rm);
		}
	}
	
	public function createEvent($event_name, $event_date, $starttime, $endtime)
	{
		
		$event = InputValidator::validate_input($event_name);
		$date = InputValidator::validate_input($event_date);
		
		$error = "";
		
		if($event_name = NULL || trim($event_name)==0)
		{
			$error = $error+"@1Event name cannot be empty! ";
		}
		
		else if($event_date == NULL || preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $event_date) )
		{
			$error = $error+"@2Event date must be specified correctly (YYYY-MM-DD)! ";
		}
		
		else if($starttime == NULL || preg_match("/^(0[0-9]|1[0-2]|2[0-4]):([0-6][0-9])$", $starttime) )
		{
			$error = $error+"@3Event start time must be specified correctly (HH:MM)! ";
		}
		
		else if($endtime == NULL || preg_match("/^(0[0-9]|1[0-2]|2[0-4]):([0-6][0-9])$", $endtime) )
		{
			$error = $error+"@4Event end time must be specified correctly (HH:MM)!";
		}
		
		else if (strlen(trim($error))!= 0)
		{
			throw new Exception($error);	
		}
		else
		{
			$pm = new PersistenceEventRegistration();
			$rm = $pm -> loadDataFromStore();
				
			$event = new Event($event_name, $event_date, $starttime, $endtime);
			$rm -> addEvent($event);
				
			$pm -> writeDataToStore($rm);
				
		}
		
		
	}
	
	public function register($aParticipant, $aEvent)
	{
		$pm = new PersistenceEventRegistration();
		$rm = $pm ->loadDataFromStore();
		
		$myparticipant = NULL;
		foreach($rm -> getParticipants() as $participant)
		{
			if(strcmp($participant -> getName(), $aParticipant == 0 ))
			{
				$myparticipant = $participant;
				break;
			}
		}
		
		$myevent = NULL;
		foreach($rm -> getEvents() as $event)
		{
			if(strcmp($event->getName(), $aEvent)==0)
			{
				$myevent = $event;
				break;
			}
		}
		
		$error ="";
		if($myparticipant != NULL && $myevent != NULL)
		{
			$myregistration = new Registration($myparticipant,$myevent);
			$rm -> addRegistration($myregistration);
			$pm -> writeDataToStore($rm);
		}else
		{
			if($myparticipant == NULL)
			{
				$error .= "@1Participant ";
				if($aParticipant != NULL)
				{
					$error .= $aParticipant;
				}
				$error .= " not found!";
			}
			if($myevent == NULL)
			{
				$error .= " @2Event ";
				if($aEvent != NULL)
				{
					$error .= $aEvent;
				}
				$error .= " not found!";
			}
			throw new Exception(trim($error));
		}
	}
	
}