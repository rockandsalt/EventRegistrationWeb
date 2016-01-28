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
		require_once 'C:\xampp\htdocs\EventRegistration\Persistence\PersistenceEventRegistration.php';
		require_once 'C:\xampp\htdocs\EventRegistration\Model\RegistrationManager.php';
		require_once 'C:\xampp\htdocs\EventRegistration\Model\Participant.php';
		require_once 'C:\xampp\htdocs\EventRegistration\Model\Event.php';
				
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
			
		<form action="addevent.php" method = "post">
			<p>Name? <input type="text" name="event_name"/>
			<span class = "error">
			<?php 
			if(isset($_SESSION['errorEventName']) && !empty($_SESSION['errorEventName']) && is_numeric(strpos($_SESSION['errorEventName'], "@1")))
			{

				$error_start = strpos($_SESSION['errorEventName'], "@1");
				$error_end = strpos($_SESSION['errorEventName'], "@",$error_start+1);
				
				if($error_end)
				{
					echo "*" . substr($_SESSION["errorEventName"],$error_start,$error_end-$error_start);
				}else 
				{
					echo "*". $_SESSION["errorEventName"];
				}
				
			}
			?>
			</span></p>
			
			<p>Date? <input type="date" name="event_date" value="<?php echo date('Y-m-d'); ?>" />
			<span class = "error">
			<?php 
			if(isset($_SESSION['errorEventName']) && !empty($_SESSION['errorEventName']) && is_numeric(strpos($_SESSION['errorEventName'], "@2")) ){
				$error_start = strpos($_SESSION['errorEventName'], "@2");
				$error_end = strpos($_SESSION['errorEventName'], "@",$error_start+1);
				
				if($error_end)
				{
					echo "*" . substr($_SESSION["errorEventName"],$error_start,$error_end-$error_start);
				}else 
				{
					echo "*". $_SESSION["errorEventName"];
				}
			}
			?>
			</span></p>
			
			<p>Start Time? <input type="time" name="starttime" value="<?php echo date('H:i'); ?>" />
			<span class = "error">
			<?php 
			if(isset($_SESSION['errorEventName']) && !empty($_SESSION['errorEventName']) && (is_numeric(strpos($_SESSION['errorEventName'], "@4")) || is_numeric(strpos($_SESSION['errorEventName'], "@3")))){
				
				$error_code = "";
				
				if(is_numeric(is_numeric(strpos($_SESSION['errorEventName'], "@4"))))
				{
					$error_code = "@4";
				}else
				{
					$error_code = "@3";
				}
				
				$error_start = strpos($_SESSION['errorEventName'], $error_code);
				$error_end = strpos($_SESSION['errorEventName'], "@",$error_start+1);
				
				if($error_end)
				{
					echo "*" . substr($_SESSION["errorEventName"],$error_start,$error_end-$error_start);
				}else 
				{
					echo "*". $_SESSION["errorEventName"];
				}
			}
			?>
			</span></p>
			
			<p>End Time? <input type="time" name="endtime" value="<?php echo date('H:i'); ?>" />
			<span class = "error">
			<?php 
			if(isset($_SESSION['errorEventName']) && !empty($_SESSION['errorEventName']) && is_numeric(strpos($_SESSION['errorEventName'], "@4")) ){
				
				$error_code = "";
				
				if(is_numeric(is_numeric(strpos($_SESSION['errorEventName'], "@4"))))
				{
					$error_code = "@4";
				}else
				{
					$error_code = "@3";
				}
				
				$error_start = strpos($_SESSION['errorEventName'], $error_code);
				$error_end = strpos($_SESSION['errorEventName'], "@",$error_start+1);
				
				if($error_end)
				{
					echo "*" . substr($_SESSION["errorEventName"],$error_start,$error_end-$error_start);
				}else 
				{
					echo "*". $_SESSION["errorEventName"];
				}
				
			}
			?>
			</span></p>
			
			<p><input type="submit" value="Add Event"/></p>
		</form>
	</body>
	
</html>