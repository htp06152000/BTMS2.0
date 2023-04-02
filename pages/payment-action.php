<?php 

if (isset($_GET['trackingnumber'])) {

    $success = sanitize_input($_GET['trackingnumber']);
    $status = sanitize_input($_GET['status']);


	
	$update_status = $DB->prepare("UPDATE transaction SET status = ? WHERE trackingnumber = ?");

    try {
        $DB->beginTransaction();
        if( $update_status->execute( [$status , $success] ) ) {
            $DB->commit();
        } else {
            $DB->rollback();
        }
    } catch (PDOException $err) {
        $DB->rollback();
        }
}
$trck = sanitize_input($_GET['trackingnumber']);
redirect_to('paid?trackingnumber='.$trck);
?>

