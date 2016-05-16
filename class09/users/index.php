<?php
	
	session_start();

	if( ! empty( $_SESSION ) )
		echo 'Welcome ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
	else
		echo 'Session not created';