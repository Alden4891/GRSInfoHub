<?php
	for ($i=0; $i < 10; $i++) { 
		sleep(2); 
		
		echo "<br>The time is " . date("h:i:sa");
		  flush();
		  ob_flush(); 
	}


?>