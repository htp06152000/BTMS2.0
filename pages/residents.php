<?php
    if (user_is_loggedin()) {}
    else {
        $_SESSION['message'] = "Login First!";
        $_SESSION['messagetype'] = "danger";

        redirect_to("login");}
?>
<?php include_once('./layout/sidebar.php');   ?>
<?php if (isset($_GET['edit']) ) : ?>


<?php $get_residents = $DB->prepare("SELECT * FROM resident WHERE residentID = ? LIMIT 0, 1");
$get_residents->execute([ $_GET['edit'] ]);  ?>

<?php if ($get_residents && $get_residents->rowCount() > 0) :
        $residents = $get_residents->fetch(); ?>


    <form method="POST" class="row py-5" style="margin-left: 260px; margin-right: 20px">

    <div class="row g-3 mb-4">
        <div class="col-12">
            <h2 class="h2 text-primary">Edit Resident</h2>
            <hr class="hr" />
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="c_address" class="form-label fw-bold" >First Name:</label>
                <input type="text" name="residentFName" id="residentFName" class="form-control" value="<?=$residents['residentFName']?>" maxlength="255" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_contact" class="form-label fw-bold">Middle Name:</label>
                <input type="text" name="residentMName" id="residentMName" class="form-control" value="<?=$residents['residentMName']?>" maxlength="255" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_address" class="form-label fw-bold">Last Name:</label>
                <input type="text" name="residentLName" id="residentLName" class="form-control" value="<?=$residents['residentLName']?>" maxlength="255" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="username" class="form-label fw-bold">Birthdate:</label>
                <input type="date" name="residentBdate" id="residentBdate" class="form-control" placeholder="mm/dd/yyyy" value="<?=$residents['residentBdate']?>"required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_address" class="form-label fw-bold">Age:</label>
                <input type="number" name="residentAge" id="residentAge" class="form-control" value="<?=$residents['residentAge']?>" maxlength="3" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_address" class="form-label fw-bold">Contact Number:</label>
                <input type="text" name="residentContactNumber" id="residentContactNumber" class="form-control" value="<?=$residents['residentContactNumber']?>" maxlength="10" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="residentGender" class="form-label fw-bold">Gender:</label>
                <select name="residentGender" id="residentGender" class="form-select">
                    <option <?=$residents['residentGender']=='Male' ? 'selected' : '' ?> value="Male" >Male</option>
                    <option <?=$residents['residentGender']=='Female' ? 'selected' : '' ?> value="Female" >Female</option>
                </select>
            </div>
        </div> 
        <div class="col-md-4">
            <div class="form-group">
                <label for="residentZoneNumber" class="form-label fw-bold">Zone Number:</label>
                <select name="residentZoneNumber" id="residentZoneNumber" class="form-select">
                    <option <?=$residents['residentZoneNumber']=='1-A' ? 'selected' : '' ?> value="1-A" >1-A</option>
                    <option <?=$residents['residentZoneNumber']=='1-B' ? 'selected' : '' ?> value="1-B" >1-B</option>
                    <option <?=$residents['residentZoneNumber']=='2' ? 'selected' : '' ?> value="2" >2</option>
                    <option <?=$residents['residentZoneNumber']=='3' ? 'selected' : '' ?> value="3" >3</option>
                    <option <?=$residents['residentZoneNumber']=='4' ? 'selected' : '' ?> value="4" >4</option>
                    <option <?=$residents['residentZoneNumber']=='5' ? 'selected' : '' ?> value="5" >5</option>
                    <option <?=$residents['residentZoneNumber']=='6' ? 'selected' : '' ?> value="6" >6</option>
                    <option <?=$residents['residentZoneNumber']=='7' ? 'selected' : '' ?> value="7" >7</option>
                    <option <?=$residents['residentZoneNumber']=='8' ? 'selected' : '' ?> value="8" >8</option>
                    <option <?=$residents['residentZoneNumber']=='9' ? 'selected' : '' ?> value="9" >9</option>
                    <option <?=$residents['residentZoneNumber']=='10' ? 'selected' : '' ?> value="10" >10</option>
                </select>
            </div>
        </div> 
        <div class="col-md-4">
            <div class="form-group">
                <label for="residentCivilStatus" class="form-label fw-bold">Civil Status:</label>
                <select name="residentCivilStatus" id="residentCivilStatus" class="form-select">
                    <option <?=$residents['residentCivilStatus']=='Single' ? 'selected' : '' ?> value="Single" >Single</option>
                    <option <?=$residents['residentCivilStatus']=='Married' ? 'selected' : '' ?> value="Married" >Married</option>
                    <option <?=$residents['residentCivilStatus']=='Divorced' ? 'selected' : '' ?> value="Divorced" >Divorced</option>
                </select>
            </div>
        </div> 
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_address" class="form-label fw-bold">Occupation:</label>
                <input type="text" name="residentOccupation" id="residentOccupation" class="form-control" value="<?=$residents['residentOccupation']?>" maxlength="30" required />
        </div>
       </div>
        <div class="col-12">
            <hr class="hr" />
            <a href="<?=root_url('residents')?>" class="btn btn-light text-danger rounded-50px px-4">Cancel</a>
            <input type="hidden" name="residentID" value="<?=$residents['residentID']?>" class="d-none">
            <button type="submit" name="update-residents" class="btn btn-primary rounded-50px px-4">Update</button>
        </div>
        </div>
    </form>
<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>


    
<!-- View Modal -->
<?php if (isset($_GET['view']) ) : ?>


<?php $get_residents = $DB->prepare("SELECT * FROM resident WHERE residentID = ? LIMIT 0, 1");
$get_residents->execute([ $_GET['view'] ]);  ?>

<?php if ($get_residents && $get_residents->rowCount() > 0) :
        $residents = $get_residents->fetch(); ?>



<form class="row py-5" style="margin-left: 260px; margin-right: 20px">
    <div class="col-12">
        <h2 class="h2 text-primary">Residents Info</h2>
        <hr class="hr" />
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">First Name: <span class="font-weight-normal"><?=$residents["residentFName"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Middle Name: <span class="font-weight-normal"><?=$residents["residentMName"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Last Name: <span class="font-weight-normal"><?=$residents["residentLName"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Age: <span class="font-weight-normal"><?=$residents["residentAge"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Gender: <span class="font-weight-normal"><?=$residents["residentGender"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Occupation: <span class="font-weight-normal"><?=$residents["residentOccupation"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Civil Status: <span class="font-weight-normal"><?=$residents["residentCivilStatus"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Contact #: <span class="font-weight-normal"><?=$residents["residentContactNumber"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Zone Number: <span class="font-weight-normal"><?=$residents["residentZoneNumber"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Birthdate: <span class="font-weight-normal"><?=$residents["residentBdate"] ?></span></p>
    </div>
    <div class="col-12">
            <hr class="hr" />
            <a href="<?=root_url('residents')?>" class="btn btn-secondary text-light rounded-50px px-4">Close</a>
            <button class="btn btn-success text-light rounded-50px px-4">Generate</button>
    </div>
</form>
<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>
<?php endif; ?>

            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"
            <!-- Table Title -->
                    <div class="row py-1" style="margin-left: 260px; margin-right: 20px">

                    <div class="row py-3">
                        <div class="col-lg-8 animate__animated animate__slideInDown animate__faster">
                        <button type="button" class="btn btn-primary rounded-50px float-right px-5" data-bs-toggle="modal" data-bs-target="#add-modal">Add</button>
                        </div>
                    </div>

                   <div class="col-12">
                        <div class="card rounded-10px" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="card-header bg-primary">
                                <h6 class="card-text h4 text-light">
                                    Residents
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr class="table-sm text-center">
                                                <th class="text-center">Photo</th>
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
                                                    <tr class="table-sm overflow-auto align-middle">
                                                        <td class="text-center"><img src="<?php echo "resources/images/resident_image/".$residents["residentImage"]; ?>" alt='' width="100px" height="100px"></td>
                                                        <td class="text-center"><?=$residents["residentLName"] ?></td>
                                                        <td class="text-center"><?=$residents["residentFName"] ?></td>
                                                        <td class="text-center"><?=$residents["residentMName"] ?></td>
                                                        <td class="text-center"><?=$residents["residentAge"] ?></td>
                                                        <td class="text-center"><?=$residents["residentCivilStatus"] ?></td>
                                                        <td class="text-center"><?=$residents["residentGender"] ?></td>
                                                        <td class="text-center"><?=$residents["residentZoneNumber"] ?></td>
                                                        <td class="text-center">
                                                            <a href="<?=root_url('residents')?>?edit=<?=$residents['residentID']?>" class="btn btn-sm btn-primary" title="View/Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <a href="#delete-items" class="btn btn-sm btn-danger" title="Delete" data-bs-toggle="modal" data-itemid=<?=$residents['residentID']?>>
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a href="<?=root_url('generate_resident')?>?view=<?=$residents['residentID']?>" title="Generate" class="btn btn-sm btn-success" ><i class="fi fi-rr-print"></i></a>
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



   


                        <!-- Modal -->
                        <form method="POST" id="add-modal"  enctype="multipart/form-data" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-lg">


                            <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Resident</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                    <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label for="residentFName" class="form-label fw-bold">First Name:</label>
                                        <input type="text" name="residentFName" id="residentFName" class="form-control" maxlength="255" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentMName" class="form-label fw-bold">Middle Name:</label>
                                        <input type="text" name="residentMName" id="residentMName" class="form-control" maxlength="225" required >
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentLName" class="form-label fw-bold">Last Name:</label>
                                        <input type="text" name="residentLName" id="residentLName" class="form-control" maxlength="225" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentBdate" class="form-label fw-bold">Birthdate:</label>
                                        <input type="date" name="residentBdate" id="residentBdate" placeholder="mm/dd/yyyy" class="form-control" max=<?=date('Y-m-d')?> required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentAge" class="form-label fw-bold">Age:</label>
                                        <input type="number" name="residentAge" id="residentAge" class="form-control" maxlength="3" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentOccupation" class="form-label fw-bold">Occupation:</label>
                                        <input type="text" name="residentOccupation" id="residentOccupation" class="form-control" maxlength="25" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentZoneNumber" class="form-label fw-bold">Zone Number:</label>
                                        <select class="form-select" name="residentZoneNumber" id="residentZoneNumber" required>
                                            <option selected value="">Select Zone Number</option>
                                            <option value="1-A">1-A</option>
                                            <option value="1-B" >1-B</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                            <option value="6" >6</option>
                                            <option value="7" >7</option>
                                            <option value="8" >8</option>
                                            <option value="9" >9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentGender" class="form-label fw-bold">Gender:</label>
                                        <select class="form-select" name="residentGender" id="residentGender" required>
                                            <option selected value="">Select Gender</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentCivilStatus" class="form-label fw-bold">Civil Status:</label>
                                        <select class="form-select" name="residentCivilStatus" id="residentCivilStatus" required>
                                                <option selected value="">Select Civil Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="residentContactNumber" class="form-label fw-bold">Contact Number:</label>
                                        <input type="tel" name="residentContactNumber" id="residentContactNumber" value="+639" class="form-control" maxlength="13" required><span class="error text-danger"><?php if (isset($has_error)) { echo "Invalid phone number"; } ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="residentImage" class="form-label fw-bold">Resident Photo:</label>
                                    <input type="file" accept="image/*" class="form-control" id="residentImage" name="residentImage" aria-describedby="" aria-label="Upload">
                                    </div>    
                             </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" name="add-residents">Save</button>
                            </div>
                            </div>
                            </div>
                        </div>
                        </form>
                            

<!-- Modal delete Item -->
<div class="modal fade has-itemid" id="delete-items">
    <div class="modal-dialog animate__animated animate__bounceInDown">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h5 modal-title text-primary">Delete Resident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="text-danger">Are you sure you want to delete this resident?</div>
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="itemid" class="d-none" value="0" />
                    <button type="submit" name="delete-residents" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

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