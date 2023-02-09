<?php if ( ! defined('ACCESS') ) die("Direct access not allowed.");

	if ( isset($_POST['track']) ) {

		$numbr = sanitize_input($_POST['tr-numbr']);

		$result = $DB->prepare("SELECT * FROM transaction WHERE transactionID = ? LIMIT 0, 1");	
		$result->execute([ $numbr ]);
		
		if ($result && $result->rowCount() > 0) {
			$_SESSION['message'] 		= "Found!";
			$_SESSION['messagetype'] 	= "warning";
			redirect_to('home');
		} else {
			$_SESSION['message'] 		= "Incorrect credentials!";
			$_SESSION['messagetype'] 	= "warning";
		}
	}