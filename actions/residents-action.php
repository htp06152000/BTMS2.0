<?php if ( ! defined('ACCESS') ) die("Direct access not allowed.");

	if ( isset($_POST['update-residents']) ) {
        
        $residentFName = sanitize_input( $_POST['residentFName'] );
        $residentMName = sanitize_input( $_POST['residentMName'] );
        $residentLName = sanitize_input( $_POST['residentLName'] );
        $residentAge = sanitize_input( $_POST['residentAge'] );
        $residentCivilStatus = sanitize_input( $_POST['residentCivilStatus'] );
        $residentGender = sanitize_input( $_POST['residentGender'] );
        $residentZoneNumber = sanitize_input( $_POST['residentZoneNumber'] );
        $residentBdate = sanitize_input($_POST['residentBdate'] );
        $residentContactNumber = sanitize_input($_POST['residentContactNumber'] ); 
        $residentOccupation = sanitize_input($_POST['residentOccupation'] );
        $residentID = sanitize_input( $_POST['residentID']);
        $file = sanitize_input($_FILES['residentImage']);  
        $fileName = sanitize_input ($_FILES['residentImage']['name']);
        $fileTmpName = sanitize_input ($_FILES['residentImage']['tmp_name']);
        $fileSize = sanitize_input ($_FILES['residentImage']['size']);
        
        $fileType = sanitize_input ($_FILES['residentImage']['type']);
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = "/resources/images/residentimage" . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);


        $update_residents = $DB->prepare("UPDATE resident SET residentFName = ?, residentMName = ?, residentLName = ?, residentAge = ?, residentCivilStatus = ?, residentGender = ?, residentZoneNumber = ?, residentBdate = ?, residentContactNumber = ?, residentOccupation = ? residentImage = ? WHERE residentID = ?");

        try {
            $DB->beginTransaction();
            if( $update_residents->execute( [$residentFName, $residentMName, $residentLName, $residentAge, $residentCivilStatus, $residentGender, $residentZoneNumber, $residentBdate, $residentContactNumber, $residentOccupation, $file, $residentID] ) ) {
                $DB->commit();
                $_SESSION['message'] = "Resident successfully updated";
                $_SESSION['messagetype'] = "success";
            } else {
                $DB->rollback();
                $_SESSION['message'] = "Resident update unsuccessfull";
                $_SESSION['messagetype'] = "danger";
            }
        } catch (PDOException $err) {
            $DB->rollback();
            $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
            $_SESSION['messagetype'] = "danger";

        }

        redirect_to('residents');

    }





 error_reporting(0);

 if ( isset($_POST['add-residents']) ) {

        $user_id = $_SESSION["user_info"]["id"];
        $residentFName = sanitize_input( $_POST['residentFName'] );
        $residentMName = sanitize_input( $_POST['residentMName'] );
        $residentLName = sanitize_input( $_POST['residentLName'] );
        $residentAge = sanitize_input( $_POST['residentAge'] );
        $residentCivilStatus = sanitize_input( $_POST['residentCivilStatus'] );
        $residentGender = sanitize_input( $_POST['residentGender'] );
        $residentZoneNumber = sanitize_input( $_POST['residentZoneNumber'] );
        $residentBdate = sanitize_input($_POST['residentBdate'] );
        $residentContactNumber = sanitize_input($_POST['residentContactNumber'] ); 
        $residentOccupation = sanitize_input($_POST['residentOccupation'] );
        $image = sanitize_input($_FILES['residentImage']['tmp_name']);
        $imagename = sanitize_input($_FILES['residentImage']['name']);

        $targetpath = "resources/images/resident_image/".$imagename;
        move_uploaded_file($image, $targetpath);
        
        $update_residents = $DB->prepare("INSERT INTO resident ( user_id, residentFName, residentMName, residentLName, residentAge, residentCivilStatus, residentGender, residentZoneNumber, residentBdate, residentContactNumber, residentOccupation, residentImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        try {
            $DB->beginTransaction();
            if( $update_residents->execute( [$user_id, $residentFName, $residentMName, $residentLName, $residentAge, $residentCivilStatus, $residentGender, $residentZoneNumber, $residentBdate, $residentContactNumber, $residentOccupation, $imagename] ) ) {
                $DB->commit();
                $_SESSION['message'] = "Resident successfully added";
                $_SESSION['messagetype'] = "success";
            } else {
                $DB->rollback();
                $_SESSION['message'] = "Unable to add Resident";
                $_SESSION['messagetype'] = "danger";
            }
        } catch (PDOException $err) {
            $DB->rollback();
            $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
            $_SESSION['messagetype'] = "danger";

        }
    }


    if ( isset($_POST['delete-residents']) ) {
        
        $residentID  = sanitize_input( $_POST['itemid'] );

        $delete_residents = $DB->prepare("DELETE FROM resident WHERE residentID = ?");

        try {
            $DB->beginTransaction();
            if( $delete_residents->execute( [ $residentID ] ) ) {
                $DB->commit();
                $_SESSION['message'] = "Resident successfully deleted";
                $_SESSION['messagetype'] = "success";
            } else {
                $DB->rollback();
                $_SESSION['message'] = "Unable to delete resident";
                $_SESSION['messagetype'] = "danger";
            }
        } catch (PDOException $err) {
            $DB->rollback();
            $_SESSION['message'] = "DB Transaction Error: " . $err->getMessage();
            $_SESSION['messagetype'] = "danger";

        }

    }