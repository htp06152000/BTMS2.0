<?php 

if ( isset($_GET['trackingnumber']) ) {

	$numbr = sanitize_input($_GET['trackingnumber']);
		
	$delete_req = $DB->prepare('DELETE from transaction WHERE trackingnumber = ? ');

    try {
        $DB->beginTransaction();
        if( $delete_req->execute( [ $numbr ] ) ) {
            $DB->commit();
            $_SESSION['message'] = "Request cancelled. Please try again";
            $_SESSION['messagetype'] = "danger";
        } else {
            $DB->rollback();
            $_SESSION['message'] = "Unable to cancel";
            $_SESSION['messagetype'] = "danger";
        }
    } catch (PDOException $err) {
        $DB->rollback();
        $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
        $_SESSION['messagetype'] = "danger";

    }
    redirect_to('home#Services');


    
} else { echo 'No trackingnumber';}
?>