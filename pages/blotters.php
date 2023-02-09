<?php include_once('./layout/sidebar.php');   ?>
<?php if (isset($_GET['edit']) ) : ?>
    
<!-- Edit datas from Tables -->
<?php $get_blotters = $DB->prepare("SELECT * FROM blotter WHERE blotterID = ? LIMIT 0, 1");
$get_blotters->execute([ $_GET['edit'] ]);  ?>

<?php if ($get_blotters && $get_blotters->rowCount() > 0) :
        $blotters = $get_blotters->fetch(); ?>

<?php 
    $get_res = $DB->query("SELECT DISTINCT * FROM resident ORDER BY residentLName ASC");
    $residents = $get_res->fetchAll();
?> 
    <script src="library/dselect.js"></script>
    <form method="POST" class="row py-4" style="margin-left: 260px; margin-right: 20px">
    
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h2 class="h2 text-primary">Edit Blotter Report</h2>
            <hr class="hr" />
        </div>
      
        <div class="col-md-4">
            <div class="form-group">
                <label for="complainant" class="form-label fw-bold">Complainanant:</label>
                <select class="form-select" name="complainant" id="complainant" required>
                    <option value="<?=$blotters['complainant']?>"><?=$blotters['complainant']?></option>
                    <?php foreach($residents as $resident) :?>
                        <option value="<?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?>"><?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?></option>
                    <?php endforeach; ?>
                </select>  

                    <script>
                        var complainant_element = document.querySelector('#complainant');
                        dselect( complainant_element, {
                        search: true
                        });
                    </script>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="c_contact" class="form-label fw-bold" >Complainant Contact Number: <span class="text-danger"></span></label>
                <input type="number" name="c_contact" id="c_contact" class="form-control" value="<?=$blotters['c_contact']?>" maxlength="11" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="c_address" class="form-label fw-bold" >Complainant Address:</label>
                <input type="text" name="c_address" id="c_address" class="form-control" value="<?=$blotters['c_address']?>" maxlength="255" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="person_to_complain" class="form-label fw-bold">Complainee: <span class="text-danger"></span></label>
                <select class="form-select" name="person_to_complain" id="person_to_complain" required>
                    <option value="<?=$blotters['person_to_complain']?>" ><?=$blotters['person_to_complain']?></option>
                        <?php foreach($residents as $resident) :?>
                    <option value="<?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?>"><?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?></option>
                        <?php endforeach; ?>
                </select>  

                    <script>
                        var complainant_element = document.querySelector('#person_to_complain');
                        dselect( complainant_element, {
                        search: true
                        });
                    </script>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_contact" class="form-label fw-bold">Complainee Contact Number:</label>
                <input type="number" name="p_contact" id="p_contact" class="form-control" value="<?=$blotters['p_contact']?>" maxlength="11" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_address" class="form-label fw-bold">Complainee Address:</label>
                <input type="text" name="p_address" id="p_address" class="form-control" value="<?=$blotters['p_address']?>" maxlength="255" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="location_of_incidence" class="form-label fw-bold">Location of Incidence: <span class="text-danger"></span></label>
                <input type="text" name="location_of_incidence" id="location_of_incidence" class="form-control" value="<?=$blotters['location_of_incidence']?>" maxlength="50" required />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="date_recorded" class="form-label fw-bold">Date Recorded: <span class="text-danger"></span></label>
                <input type="date" name="date_recorded" id="date_recorded" class="form-control" placeholder="mm/dd/yyyy" value="<?=$blotters['date_recorded']?>" maxlength="10" disabled />
            </div>
        </div>  
        <div class="col-md-3">
            <div class="form-group">
                <label for="complaint_status" class="form-label fw-bold">Status of Report:</label>
                    <select name="complaint_status" id="complaint_status" class="form-select">
                        <option <?=$blotters['complaint_status']=='Pending' ? 'selected' : '' ?> value="Pending" >Pending</option>
                        <option <?=$blotters['complaint_status']=='Scheduled' ? 'selected' : '' ?> value="Scheduled" >Scheduled</option>
                        <option <?=$blotters['complaint_status']=='Solved' ? 'selected' : '' ?> value="Solved" >Solved</option>
                    </select>
            </div>
        </div>        
        <div class="col-md-6">
            <label for="complaint"  class="form-label fw-bold">Report Details:</label>
            <textarea name="complaint" id="complaint" class="form-control" rows="6" maxlength="100" required><?=$blotters['complaint']?></textarea>
        </div>
        <div class="col-md-6">
            <label for="exampleFormControlTextarea1"  class="form-label fw-bold">Action Taken</label>
            <textarea name="action_taken" id="action_taken" class="form-control" rows="6" maxlength="100" required><?=$blotters['action_taken']?></textarea>
        </div>

        <div class="col-12">
            <hr class="hr" />
            <a href="<?=root_url('blotters')?>" class="btn btn-light text-danger rounded-50px px-4">Cancel</a>
            <input type="hidden" name="blotterID" value="<?=$blotters['blotterID']?>" class="d-none">
            <button type="submit" name="update-blotters" class="btn btn-primary rounded-50px px-4">Update</button>
        </div>
    </div>
    </form>

<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>








    <?php if (isset($_GET['view']) ) : ?>
    
    <!-- Edit datas from Tables -->
    <?php $get_blotters = $DB->prepare("SELECT * FROM blotter WHERE blotterID = ? LIMIT 0, 1");
    $get_blotters->execute([ $_GET['view'] ]);  ?>
    
    <?php if ($get_blotters && $get_blotters->rowCount() > 0) :
            $blotters = $get_blotters->fetch(); ?>
    
    <form class="row py-5" style="margin-left: 260px; margin-right: 20px">
    <div class="col-12">
        <h2 class="h2 text-primary">Blotter Report Details</h2>
        <hr class="hr" />
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Complainant: <span class="font-weight-normal"><?=$blotters["complainant"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Complainant Address: <span class="font-weight-normal"><?=$blotters["c_address"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Complainant Contact#: <span class="font-weight-normal"><?=$blotters["c_contact"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Complainee: <span class="font-weight-normal"><?=$blotters["person_to_complain"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Complainee Address: <span class="font-weight-normal"><?=$blotters["p_address"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Complainee Contact#: <span class="font-weight-normal"><?=$blotters["p_contact"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Date of Incident: <span class="font-weight-normal"><?=$blotters["date_recorded"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Action Taken: <span class="font-weight-normal"><?=$blotters["action_taken"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Location of Incident: <span class="font-weight-normal"><?=$blotters["location_of_incidence"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Complaint Status: <span class="font-weight-normal"><?=$blotters["complaint_status"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Complaint: <span class="font-weight-normal"><?=$blotters["complaint"] ?></span></p>
    </div>
    <div class="col-12">
            <hr class="hr" />
            <a href="<?=root_url('blotters')?>" class="btn btn-secondary text-light rounded-50px px-4">Close</a>
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
            <div class="card-header bg-danger">
                <h6 class="card-text h4 text-light">
                    Blotter
                </h6>
            </div>
            <!-- Table Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr class="table-sm text-center">
                                <th class="text-center">Complainant</th>
                                <th class="text-center">Complainee</th>
                                <th class="text-center">Date recorded</th>
                                <th class="text-center">Status of report</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $blotter = $DB->query("SELECT * FROM blotter ORDER BY complaint_status ASC");
                                foreach ($blotter as $blotters) : ?>
                                
                                
                                    <tr class="table-sm">
                                        <td class="text-center"><?=$blotters["complainant"] ?></td>
                                        <td class="text-center"><?=$blotters["person_to_complain"] ?></td>
                                        <td class="text-center"><?=$blotters["date_recorded"] ?></td>
                                        <td class="font-weight-bold text-center">

                                        <?php if($blotters['complaint_status']=='Scheduled'): ?>
																<h5><span class="badge rounded-pill text-bg-warning">Scheduled</span></h5>
															<?php elseif($blotters['complaint_status']=='Pending'): ?>
																<h5><span class="badge rounded-pill text-bg-danger">Pending</span></h5>
															<?php else: ?>
																<h5><span class="badge rounded-pill text-bg-success">Solved</span></h5>
															<?php endif ?>

                                        </td>
                                        <td class="text-center">
                                            <a href="<?=root_url('blotters')?>?view=<?=$blotters['blotterID']?>" class="btn btn-sm btn-warning" ><i class="fas fa-eye"></i></a>
                                            <a href="<?=root_url('blotters')?>?edit=<?=$blotters['blotterID']?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#delete-items" type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-itemid=<?=$blotters['blotterID']?>>
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="<?=root_url('generate_blotter')?>?view=<?=$blotters['blotterID']?>" title="Generate" class="btn btn-sm btn-success" ><i class="fi fi-rr-print"></i></a>
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


    <?php 
        $get_res = $DB->query("SELECT * FROM resident ORDER BY residentLName ASC");
        $residents = $get_res->fetchAll();
    ?>   
    
    
    <script src="library/dselect.js"></script>

                       <!-- Modal -->
                        <form method="POST" id="add-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-lg">


                            <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Blotter</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                   <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label for="complainant" class="form-label fw-bold">Complainant:</label>
                                        <select class="form-select" name="complainant" id="complainant" required>
                                                <option value="" >Select Resident</option>
                                                    <?php foreach($residents as $resident) :?>
                                                        <option value="<?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?>"><?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?></option>
                                                    <?php endforeach; ?>
                                        </select>  

                                        <script>
                                            var complainant_element = document.querySelector('#complainant');
                                            dselect( complainant_element, {
                                            search: true
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="c_contact" class="form-label fw-bold">Complainant's Contact Number:</label>
                                        <input type="number" name="c_contact" id="c_contact" class="form-control" maxlength="25" required>
                                    </div>    
                                    <div class="col-md-4">
                                        <label for="c_address" class="form-label fw-bold">Complainant's Address:</label>
                                        <input type="text" name="c_address" id="c_address" class="form-control" maxlength="225" required >
                                    </div>
                                    <div class="col-md-4">
                                        <label for="person_to_complain" class="form-label fw-bold">Complainee:</label>
                                        <select class="form-select" name="person_to_complain" id="person_to_complain" required>
                                                <option value="" >Select Resident</option>
                                            <?php foreach($residents as $resident) :?>
                                                <option value="<?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?>"><?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>  

                                        <script>
                                            var person_to_complain_element = document.querySelector('#person_to_complain');
                                            dselect( person_to_complain_element, {
                                            search: true
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="p_contact" class="form-label fw-bold">Complainee's Contact Number:</label>
                                        <input type="number" name="p_contact" id="p_contact" class="form-control" maxlength="25" required>
                                    </div>    
                                    <div class="col-md-4">
                                        <label for="p_address" class="form-label fw-bold">Complainee's Address:</label>
                                        <input type="text" name="p_address" id="p_address" class="form-control" maxlength="255" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="location_of_incidence" class="form-label fw-bold">Location of Incidence:</label>
                                        <input type="text" name="location_of_incidence" id="location_of_incidence" class="form-control" maxlength="225" required >
                                    </div>
                                    <div class="col-md-3">
                                        <label for="date_recorded" class="form-label fw-bold">Date Recorded:</label>
                                        <input type="date" name="date_recorded" id="date_recorded" placeholder="mm/dd/yyyy" class="form-control" max=<?=date('Y-m-d')?> required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="complaint_status" class="form-label fw-bold">Complain Status:</label>
                                        <select class="form-select" name="complaint_status" id="complaint_status" required>
                                                <option selected value="">Select Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Scheduled">Scheduled</option>
                                                <option value="Solved">Solved</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="complaint" class="form-label fw-bold">Report Details:</label>
                                        <textarea class="form-control" name="complaint" id="complaint" placeholder="Type here......" rows="3" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="action_taken" class="form-label fw-bold">Action Taken:</label>
                                        <textarea class="form-control" name="action_taken" id="action_taken" placeholder="Type here......" rows="3" required></textarea>
                                    </div>
                                   
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="add-blotters">Save</button>
                                    </div>
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
                <h5 class="h5 modal-title text-primary">Delete Blotter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="text-danger">Are you sure you want to delete this blotter?</div>
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="itemid" class="d-none" value="0" />
                    <button type="submit" name="delete-blotters" class="btn btn-primary">Confirm</button>
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