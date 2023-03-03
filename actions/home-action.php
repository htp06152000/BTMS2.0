<?php if ( ! defined('ACCESS') ) die("Direct access not allowed.");

	if ( isset($_POST['track']) ) {

		$get_status = $DB->prepare("SELECT status FROM transaction WHERE transactionID = ? ");
		$status = $get_status->fetchall();

		$numbr = sanitize_input($_POST['trackingnumber']);

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
	
	if ( isset($_POST['add-indigenciess']) ) {

		$requester =  sanitize_input( $_POST['requester'] );
		$tod =  sanitize_input( $_POST['tod'] );
		$pickupdate =  sanitize_input( $_POST['pickupdate'] );
		$status =  sanitize_input( $_POST['status'] );
		$purpose = sanitize_input( $_POST['purpose'] );
		$dateRecorded = sanitize_input( $_POST['dateRecorded'] );
		$amount = sanitize_input( $_POST['amount'] );
		
		$update_transactions = $DB->prepare("INSERT INTO transaction ( residentID, servicesID, pickupdate, status, purpose, dateRecorded, amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
		
		try {
			$DB->beginTransaction();
			if( $update_transactions->execute( [$requester, $tod, $pickupdate, $status, $purpose, $dateRecorded, $amount] ) ) {
				$DB->commit();
				$_SESSION['message'] = "Request successfully submitted";
				$_SESSION['messagetype'] = "success";
			} else {
				$DB->rollback();
				$_SESSION['message'] = "Unable to submit Request";
				$_SESSION['messagetype'] = "danger";
			}
		} catch (PDOException $err) {
			$DB->rollback();
			$_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
			$_SESSION['messagetype'] = "danger";
		
		}
		redirect_to('payment1');
		}
		
		if ( isset($_POST['add-clearancess']) ) {
		
		$requester =  sanitize_input( $_POST['requester'] );
		$tod =  sanitize_input( $_POST['tod'] );
		$pickupdate =  sanitize_input( $_POST['pickupdate'] );
		$status =  sanitize_input( $_POST['status'] );
		$purpose = sanitize_input( $_POST['purpose'] );
		$dateRecorded = sanitize_input( $_POST['dateRecorded'] );
		$amount = sanitize_input( $_POST['amount'] );
		
		$update_transactions = $DB->prepare("INSERT INTO transaction ( residentID, servicesID, pickupdate, status, purpose, dateRecorded, amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
		
		try {
			$DB->beginTransaction();
			if( $update_transactions->execute( [$requester, $tod, $pickupdate, $status, $purpose, $dateRecorded, $amount] ) ) {
				$DB->commit();
				$_SESSION['message'] = "Request successfully submitted";
				$_SESSION['messagetype'] = "success";
			} else {
				$DB->rollback();
				$_SESSION['message'] = "Unable to submit Request";
				$_SESSION['messagetype'] = "danger";
			}
		} catch (PDOException $err) {
			$DB->rollback();
			$_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
			$_SESSION['messagetype'] = "danger";
			
			}
			redirect_to('payment');

			}
		
			if ( isset($_POST['add-permitss']) ) {
		
				$requester =  sanitize_input( $_POST['requester'] );
				$tod =  sanitize_input( $_POST['tod'] );
				$business_name = sanitize_input($_POST['business_name']);
				$business_address = sanitize_input($_POST['business_address']);
				$type_of_business = sanitize_input($_POST['type_of_business']);
				$pickupdate =  sanitize_input( $_POST['pickupdate'] );
				$status =  sanitize_input( $_POST['status'] );
				$purpose = sanitize_input( $_POST['purpose'] );
				$dateRecorded = sanitize_input( $_POST['dateRecorded'] );
				$amount = sanitize_input( $_POST['amount'] );
				
				$update_transactions = $DB->prepare("INSERT INTO transaction (residentID, servicesID, business_name, business_address, type_of_business, pickupdate, status, purpose, dateRecorded, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				
				try {
					$DB->beginTransaction();
					if( $update_transactions->execute( [$requester, $tod, $business_name, $business_address, $type_of_business, $pickupdate, $status, $purpose, $dateRecorded, $amount] ) ) {
						$DB->commit();
						$_SESSION['message'] = "Request successfully submitted";
						$_SESSION['messagetype'] = "success";
					} else {
						$DB->rollback();
						$_SESSION['message'] = "Unable to submit Request";
						$_SESSION['messagetype'] = "danger";
					}
				} catch (PDOException $err) {
					$DB->rollback();
					$_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
					$_SESSION['messagetype'] = "danger";
				
				}
				redirect_to('payment2');
				}