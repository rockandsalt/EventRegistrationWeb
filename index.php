<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Event Registration</title>
		<style>
			.error{color: #FF0000;}
		</style>
	</head>
	<body>
		<?php 
		require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Persistence\PersistenceEventRegistration.php';
		require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Model\RegistrationManager.php';
		require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Model\Participant.php';
		require_once 'C:\Users\marc\Documents\EclipseWorkspace\EventRegistrationWeb\Model\Event.php';
				
		session_start();
		
		$pm = new PersistenceEventRegistration();
		$rm = $pm->loadDataFromStore();
		
		echo "<form action = 'register.php' method='post'>";
		
		echo "<p>Name? <select name='participantspinner'>";
		foreach($rm->getParticipants()as $participant)
		{
			echo "<option>" . $participant->getName() . "</option>";
		}
		echo "</select><span class='error'>";
		
		if(isset($_SESSION['errorRegisterParticipant'])&& !empty($_SESSION['errorRegisterParticipant']))
		{
			echo "*". $_SESSION["errorParticipant"];
		}
		echo"</span></p>";
		
		echo"<p>Event? <select name='eventspinner'>";
		foreach($rm->getEvents() as $event)
		{
			echo "<option>" . $event->getname() . "</option>";
		}
		
		echo "</select><span class='error'>";
		
		if(isset($_SESSION['errorRegisterEvent']) && !empty($_SESSION['errorRegisterEvent']))
		{
			echo "*" . $_SESSION["errorRegisterEvent"];
		}
		
		echo "</span></p>";
		
		echo "<p><input type ='submit' value='Register'/></p>";
		echo "</form>";
		
		?>
		<form action="addparticipant.php" method = "post">
			<p>Name? <input type="text" name="participant_name"/>
			<span class= "error">
			<?php 
			if(isset($_SESSION['errorParticipantName']) && !empty($_SESSION['errorParticipantName'])){
				echo "*" . $_SESSION["errorParticipantName"];
			}
			?>
			</span></p>
			<p><input type="submit" value="Add Participant"/></p>
		</form>	
	</body>
	
</html>