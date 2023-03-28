<?php if ( ! defined('ACCESS') ) die("Direct access not allowed.");


if ( isset($_POST['update-transactions']) ) {

    
    $status =  sanitize_input( $_POST['status'] );
    $transactionID = sanitize_input($_POST['transactionID']);
    
    $update_transactions = $DB->prepare("UPDATE transaction SET status = ?  WHERE transactionID = ?");
    try {
        $DB->beginTransaction();
        if( $update_transactions->execute( [$status , $transactionID] ) ) {
            $DB->commit();
            $_SESSION['message'] = "Request successfully added";
            $_SESSION['messagetype'] = "success";
        } else {
            $DB->rollback();
            $_SESSION['message'] = "Unable to add Request";
            $_SESSION['messagetype'] = "danger";
        }
    } catch (PDOException $err) {
        $DB->rollback();
        $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
        $_SESSION['messagetype'] = "danger";

        }

        redirect_to('transactions');

}


if ( isset($_POST['add-indigencies']) ) {

$requester =  sanitize_input( $_POST['requester'] );
$tod =  sanitize_input( $_POST['tod'] );
$pickupdate =  sanitize_input( $_POST['pickupdate'] );
$status =  sanitize_input( $_POST['status'] );
$purpose = sanitize_input( $_POST['purpose'] );
$dateRecorded = sanitize_input( $_POST['dateRecorded'] );
$amount = sanitize_input( $_POST['amount'] );
$trackingnumber = sanitize_input($_POST['trackingnumber']);

$update_transactions = $DB->prepare("INSERT INTO transaction ( residentID, servicesID, pickupdate, status, purpose, dateRecorded, amount, trackingnumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

try {
    $DB->beginTransaction();
    if( $update_transactions->execute( [$requester, $tod, $pickupdate, $status, $purpose, $dateRecorded, $amount, $trackingnumber] ) ) {
        $DB->commit();
        $_SESSION['message'] = "Request successfully added";
        $_SESSION['messagetype'] = "success";
    } else {
        $DB->rollback();
        $_SESSION['message'] = "Unable to add Request";
        $_SESSION['messagetype'] = "danger";
    }
} catch (PDOException $err) {
    $DB->rollback();
    $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
    $_SESSION['messagetype'] = "danger";

}

}

if ( isset($_POST['add-clearances']) ) {

$requester =  sanitize_input( $_POST['requester'] );
$tod =  sanitize_input( $_POST['tod'] );
$pickupdate =  sanitize_input( $_POST['pickupdate'] );
$status =  sanitize_input( $_POST['status'] );
$purpose = sanitize_input( $_POST['purpose'] );
$dateRecorded = sanitize_input( $_POST['dateRecorded'] );
$amount = sanitize_input( $_POST['amount'] );
$trackingnumber = sanitize_input($_POST['trackingnumber']);

$update_transactions = $DB->prepare("INSERT INTO transaction ( residentID, servicesID, pickupdate, status, purpose, dateRecorded, amount, trackingnumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

try {
    $DB->beginTransaction();
    if( $update_transactions->execute( [$requester, $tod, $pickupdate, $status, $purpose, $dateRecorded, $amount, $trackingnumber] ) ) {
        $DB->commit();
        $_SESSION['message'] = "Request successfully added";
        $_SESSION['messagetype'] = "success";
    } else {
        $DB->rollback();
        $_SESSION['message'] = "Unable to add Request";
        $_SESSION['messagetype'] = "danger";
    }
} catch (PDOException $err) {
    $DB->rollback();
    $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
    $_SESSION['messagetype'] = "danger";
    
    }
    
    }

    if ( isset($_POST['add-permits']) ) {

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
        $trackingnumber = sanitize_input($_POST['trackingnumber']);

        $update_transactions = $DB->prepare("INSERT INTO transaction ( residentID, servicesID, pickupdate, status, purpose, dateRecorded, amount, trackingnumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        try {
            $DB->beginTransaction();
            if( $update_transactions->execute( [$requester, $tod, $pickupdate, $status, $purpose, $dateRecorded, $amount, $trackingnumber] ) ) {
                $DB->commit();
                $_SESSION['message'] = "Request successfully added";
                $_SESSION['messagetype'] = "success";
            } else {
                $DB->rollback();
                $_SESSION['message'] = "Unable to add Request";
                $_SESSION['messagetype'] = "danger";
            }
        } catch (PDOException $err) {
            $DB->rollback();
            $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
            $_SESSION['messagetype'] = "danger";
        
        }
        
        }

        if ( isset($_POST['delete-transactions']) ) {
        
            $transactionID  = sanitize_input( $_POST['itemid'] );
    
            $delete_transactions = $DB->prepare("DELETE FROM transaction WHERE transactionID = ?");
    
            try {
                $DB->beginTransaction();
                if( $delete_transactions->execute( [ $transactionID ] ) ) {
                    $DB->commit();
                    $_SESSION['message'] = " Transaction successfully deleted";
                    $_SESSION['messagetype'] = "success";
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