<?php if ( ! defined('ACCESS') ) die("Direct access not allowed.");

if ( isset($_POST['delete-transactionss']) ) {
        

    $delete_transactions = $DB->prepare("DELETE FROM transaction WHERE transactionID = ?");

    try {
        $DB->beginTransaction();
        if( $delete_transactions->execute( [ $transactionID ] ) ) {
            $DB->commit();
            $_SESSION['message'] = " Request retrieve reason did not pay";
            $_SESSION['messagetype'] = "danger";
        } else {
            $DB->rollback();
            $_SESSION['message'] = "Unable to delete transaction";
            $_SESSION['messagetype'] = "danger";
        }
    } catch (PDOException $err) {
        $DB->rollback();
        $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
        $_SESSION['messagetype'] = "danger";

    }

}