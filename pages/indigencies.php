<?php
    if (user_is_loggedin()) {}
    else {
        $_SESSION['message'] = "Login First!";
        $_SESSION['messagetype'] = "danger";

        redirect_to("login");}
?>
<?php include_once('./layout/sidebar.php');   ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"       
        
        <div class="row py-3">
        <div class="row py-1" style="margin-left: 260px; margin-right: 20px">
            <div class="col-12">
                <div class="card rounded-10px" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <div class="card-header bg-info">
                        <h6 class="card-text h4 text-light">
                            Certificate of Indigency
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr class="table-sm text-center">
                                        <th class="text-center">Last name</th>
                                        <th class="text-center">First name</th>
                                        <th class="text-center">Middle name</th>
                                        <th class="text-center">Age</th>
                                        <th class="text-center">Civil Status</th>
                                        <th class="text-center">Gender</th>
                                        <th class="text-center">Zone#</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $resident = $DB->query("SELECT * FROM resident ORDER BY residentLName ASC");
                                        foreach ($resident as $residents) : ?>
                                            <tr class="table-sm overflow-auto">
                                                <td class="text-center"><?=$residents["residentLName"] ?></td>
                                                <td class="text-center"><?=$residents["residentFName"] ?></td>
                                                <td class="text-center"><?=$residents["residentMName"] ?></td>
                                                <td class="text-center"><?=$residents["residentAge"] ?></td>
                                                <td class="text-center"><?=$residents["residentCivilStatus"] ?></td>
                                                <td class="text-center"><?=$residents["residentGender"] ?></td>
                                                <td class="text-center"><?=$residents["residentZoneNumber"] ?></td>
                                                <td class="text-center">
                                                    <a href="<?=root_url('generate_indigency')?>?view=<?=$residents['residentID']?>" title="Generate" class="btn btn-sm btn-success" ><i class="fi fi-rr-print"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <!-- generate datatable on our table -->
        <script>
        $(document).ready(function(){
            //inialize datatable
            $('#myTable').DataTable();

            //hide alert
            $(document).on('click', '.close', function(){
                $('.alert').hide();
            })
        });
        </script>