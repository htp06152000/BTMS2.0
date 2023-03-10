<?php if ( ! defined('ACCESS') ) die("Direct access not allowed.");?>
<?php
    if (user_is_loggedin()) {}
    else {
        $_SESSION['message'] = "Login First!";
        $_SESSION['messagetype'] = "danger";

        redirect_to("login");}
?>
<?php include_once('./layout/sidebar.php');   ?>




<!-- Title -->
<div class="py-3 px-4" style="margin-left: 250px;">
    <div class="alert alert-primary animate__animated animate__slideInDown animate__faster" role="alert" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
        Welcome to the Administrators page!
    </div>
</div>

<!-- Cards -->
<div class="row py-4 px-4" style="margin-left: 241px;">
    <div class="col-sm-6 ">
        <div class="card text-white bg-primary mb-3" style="max-width: 35rem; box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
            <div class="card-header font-weight-900">Population</div>
                <div class="card-body">
                    <?php
                    $nRows = $DB->query('SELECT count(*) FROM resident')->fetchColumn(); 
                    echo '<h5 class="card-title"><span class="icon"><i class="bi bi-people"></i></span> Total: '.$nRows.'</h5>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
        <div class="card text-white bg-success mb-3" style="max-width: 35rem; box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
            <div class="card-header">Barangay Clearance Requests</div>
                <div class="card-body">
                <?php
                    $nRows = $DB->query('SELECT count(*) FROM transaction WHERE servicesID = 1')->fetchColumn(); 
                    echo '<h5 class="card-title"><span class="icon"><i class="bi bi-people"></i></span> Total: '.$nRows.'</h5>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
        <div class="card text-white bg-warning mb-3" style="max-width: 35rem; box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
            <div class="card-header">Certificate of Indigency Requests</div>
                <div class="card-body">
                <?php
                    $nRows = $DB->query('SELECT count(*) FROM transaction WHERE servicesID = 2')->fetchColumn(); 
                    echo '<h5 class="card-title"><span class="icon"><i class="bi bi-people"></i></span> Total: '.$nRows.'</h5>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
        <div class="card text-white bg-info mb-3" style="max-width: 35rem; box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
            <div class="card-header">Business Permit Requests</div>
                <div class="card-body">
                <?php
                    $nRows = $DB->query('SELECT count(*) FROM transaction WHERE servicesID = 3')->fetchColumn(); 
                    echo '<h5 class="card-title"><span class="icon"><i class="bi bi-people"></i></span> Total: '.$nRows.'</h5>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
        <div class="card text-white bg-danger mb-3" style="max-width: 35rem; box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
            <div class="card-header">Blotter Reports Recorded</div>
                <div class="card-body">
                <?php
                    $nRows = $DB->query('SELECT count(*) FROM blotter')->fetchColumn(); 
                    echo '<h5 class="card-title"><span class="icon"><i class="bi bi-exclamation-triangle-fill"></i></span> Total: '.$nRows.'</h5>';
                ?>
                </div>
            </div>
        </div>
</div>