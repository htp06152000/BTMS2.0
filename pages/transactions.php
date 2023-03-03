<?php
    if (user_is_loggedin()) {}
    else {
        $_SESSION['message'] = "Login First!";
        $_SESSION['messagetype'] = "danger";

        redirect_to("login");}
?>
<?php include_once('./layout/sidebar.php');   ?>
<?php if (isset($_GET['edit']) ) : ?>


<!-- Edit datas from Tables -->
<?php $get_transaction = $DB->prepare("SELECT concat(rs.residentFName,' ',rs.residentMName,' ',rs.residentLName) AS requester, tr.*, s.services AS tod FROM transaction tr JOIN resident rs ON tr.residentID = rs.residentID JOIN services s ON tr.servicesID = s.servicesID WHERE transactionID = ? LIMIT 0, 1");
$get_transaction->execute([ $_GET['edit'] ]);  ?>

<?php if ($get_transaction && $get_transaction->rowCount() > 0) :
        $transaction = $get_transaction->fetch(); ?>

    <form method="POST" class="row py-5" style="margin-left: 260px; margin-right: 20px">

    <div class="row g-3 mb-4">
        <div class="col-12">
            <h2 class="h2 text-primary">Update Transaction</h2>
            <hr class="hr" />
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="requester" class="form-label fw-bold">Requestor:</label>
                <input type="text" name="requester" id="requester" class="form-control" value="<?=$transaction['requester']?>" maxlength="255" disabled />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tod" class="form-label fw-bold">Type of Document:</label>
                <input type="text" name="tod" id="tods" class="form-control" value="<?=$transaction['tod']?>" maxlength="255" disabled />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="pickupdate" class="form-label fw-bold">Pick-Up Date:</label>
                <input type="pickupdate" name="pickupdate" id="pickupdate" class="form-control" value="<?=$transaction['pickupdate']?>" maxlength="11" disabled />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="daterecorde" class="form-label fw-bold">Date Recorded:</label>
                <input type="text" name="daterecorded" id="daterecorded" class="form-control" value="<?=$transaction['dateRecorded']?>" maxlength="255" disabled />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="status" class="form-label fw-bold">Request Status:</label>
                <select name="status" id="status" class="form-select">
                    <option <?=$transaction['status']=='Pending' ? 'selected' : '' ?> value="Pending" >Pending</option>
                    <option <?=$transaction['status']=='Ready to Pick Up' ? 'selected' : '' ?> value="Ready to Pick Up" >Ready to Pick Up</option>
                    <option <?=$transaction['status']=='Released' ? 'selected' : '' ?> value="Released" >Released</option>
                </select>
            </div>
        </div> 
        
        <div class="col-12">
            <hr class="hr" />
            <a href="<?=root_url('transactions')?>" class="btn btn-light text-danger rounded-50px px-4">Cancel</a>
            <input type="hidden" name="transactionID" value="<?=$transaction['transactionID']?>" class="d-none">
            <button type="submit" name="update-transactions" class="btn btn-primary rounded-50px px-4">Update</button>
        </div>
    </div>
    </form>
<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>

    
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
                                <div class="card-header bg-warning">
                                    <h6 class="card-text h4 text-light">
                                        Transactions
                                    </h6>
                                </div>
                                <!-- Table Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr class="table-sm text-center">
                                                    <th class="text-center">Transaction ID</th>
                                                    <th class="text-center">Requestor</th>
                                                    <th class="text-center">Type of Document</th>
                                                    <th class="text-center">Pick up Date</th>
                                                    <th class="text-center">Date Recorded</th>
                                                    <th class="text-center">Status of request</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $transaction = $DB->query("SELECT concat(rs.residentFName,' ',rs.residentMName,' ',rs.residentLName) AS requester, tr.*, s.services AS tod FROM transaction tr JOIN resident rs ON tr.residentID = rs.residentID JOIN services s ON tr.servicesID = s.servicesID ORDER BY status ASC");
                                                    foreach ($transaction as $transactions) : ?>                      
                                                        <tr class="table-sm">
                                                            <td class="text-center"><?=$transactions["transactionID"]?></td>
                                                            <td class="text-center"><?=$transactions["requester"]?></td>
                                                            <td class="text-center"><?=$transactions["tod"]?></td>
                                                            <td class="text-center"><?=$transactions["pickupdate"] ?></td>
                                                            <td class="text-center"><?=$transactions["dateRecorded"] ?></td>
                                                            <td class="text-center">
                                                                
                                                            <?php if($transactions['status']=='Ready to Pick Up'): ?>
																<h5><span class="badge rounded-pill text-bg-warning">Ready to Pick Up</span></h5>
															<?php elseif($transactions['status']=='Pending'): ?>
																<h5><span class="badge rounded-pill text-bg-danger">Pending</span></h5>
															<?php else: ?>
																<h5><span class="badge rounded-pill text-bg-success">Released</span></h5>
															<?php endif ?>
                                                            

                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?=root_url('transactions')?>?edit=<?=$transactions['transactionID']?>" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                                <a href="#delete-items" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-itemid=<?=$transactions['transactionID']?>>
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
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

                    
                    <!-- The Modal -->
                    <div class="modal fade" id="add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog">
                            <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-warning text-white">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Select Type of Document</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-success btn-md btn-block" data-bs-target="#add-modal-clearance" data-bs-toggle="modal">Barangay Clearance</button>
                                    <button class="btn btn-info btn-md btn-block" data-bs-target="#add-modal-indigency" data-bs-toggle="modal">Certificate of Indigency</button>
                                    <button class="btn btn-primary btn-md btn-blocky" data-bs-target="#add-modal-permit" data-bs-toggle="modal">Business Permit</button>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            </div>
                     </div>
                    </div>

            <?php 
                $get_res = $DB->query("SELECT * FROM resident ORDER BY residentLName ASC");
                $residents = $get_res->fetchAll();
            ?>

            <?php
                $get_ser = $DB->query("SELECT * FROM services WHERE servicesID = 1");
                $services = $get_ser->fetchall();
            ?>
          
        
            <script src="library/dselect.js"></script>
            
<!-- add modal for clearance -->
<form method="POST" class="modal fade" id="add-modal-clearance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable">

     <!-- Modal Content -->
    <div class="modal-content">
      <div class="modal-header bg-success text-white">

         <!-- Modal Header -->
        <h5 class="modal-title">Add Barangay Clearance Request</h5>
        <button type="button" class="btn-close" data-bs-target="#add-modal" data-bs-toggle="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

            <div class="mb-3">
                <div class="form-group">
                <label for="tod" class="form-label fw-bold">Type of Document:</label>
                    <select class="form-select" name="tod" id="tod" readonly>
                        <?php foreach($services as $service) :?>
                            <option value="<?=$service['servicesID'];?>"><?=$service['services'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
            <div class="form-group">
            <label for="servicesname" class="form-label fw-bold">Requestor's Full Name:</label>
            <select class="form-select" name="requester" id="requester" required>
                            <option value="" >Select Resident</option>
                        <?php foreach($residents as $resident) :?>
                            <option value="<?=$resident["residentID"]?>"><?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?></option>
                        <?php endforeach; ?>
                    </select>  

                    <script>
                        var requester_element = document.querySelector('#requester');
                        dselect( requester_element, {
                        search: true
                            });
                    </script>
            </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="pickupdate" class="form-label fw-bold">Pick up Date:</label>
                    <input type="date" name="pickupdate" id="pickupdate" class="form-control" placeholder="mm/dd/yyyy" min="<?=date('Y-m-d')?>" required >
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="amount" class="form-label fw-bold">Amount:</label>
                    <input type="text" value="25" class="form-control" name="amount" id="amount" placeholder="Amount" maxlength="255" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="dateRecorded" class="form-label fw-bold">Date Recorded:</label>
                    <input type="date" name="dateRecorded" id="dateRecorded" class="form-control" placeholder="mm/dd/yyyy" max="<?=date('y-m-d')?>" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="status" class="form-label fw-bold">Status:</label>
                    <input type="text" value="Pending" class="form-control" name="status" id="status" placeholder="Status" maxlength="255" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="purpose" class="form-label fw-bold">Purpose:</label>
                    <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose" maxlength="255" required>
                </div>
            </div>
      
            <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-target="#add-modal" data-bs-toggle="modal">Back</button>
        <button type="submit" class="btn btn-primary" name="add-clearances">Save</button>
      </div>
      </div>
    </div>
  </div>
</form>


            <?php 
                $get_res = $DB->query("SELECT * FROM resident ORDER BY residentLName ASC");
                $residents = $get_res->fetchAll();
            ?>

            <?php
                $get_ser = $DB->query("SELECT * FROM services WHERE servicesID = 2");
                $services = $get_ser->fetchall();
            ?>
                
            <script src="library/dselect.js"></script>

<!-- add modal for indigency -->
<form method="POST" class="modal fade" id="add-modal-indigency" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable">

     <!-- Modal Content -->
    <div class="modal-content">
      <div class="modal-header bg-info text-white">

         <!-- Modal Header -->
        <h5 class="modal-title">Add Certificate of Indigency Request</h5>
        <button type="button" class="btn-close" data-bs-target="#add-modal" data-bs-toggle="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

            <div class="mb-3">
                <div class="form-group">
                <label for="tod" class="form-label fw-bold">Type of Document:</label>
                    <select class="form-select" name="tod" id="tod" readonly>
                        <?php foreach($services as $service) :?>
                            <option value="<?=$service['servicesID'];?>"><?=$service['services'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
            <div class="form-group">
            <label for="servicesname" class="form-label fw-bold">Requestor's Full Name:</label>
            <select class="form-select" name="requester" id="requester1" required>
                            <option value="" >Select Resident</option>
                        <?php foreach($residents as $resident) :?>
                            <option value="<?=$resident["residentID"]?>"><?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?></option>
                        <?php endforeach; ?>
                    </select>  

                    <script>
                        var requester1_element = document.querySelector('#requester1');
                        dselect( requester1_element, {
                        search: true
                         });
                    </script>
            </div>
            </div>

            <div class="mb-3">
                <div class="form-">
                    <label for="pickupdate" class="form-label fw-bold">Pick up Date:</label>
                    <input type="date" name="pickupdate" id="pickupdate" class="form-control" placeholder="mm/dd/yyyy" min="<?=date('Y-m-d')?>" required >
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="amount" class="form-label fw-bold">Amount:</label>
                    <input type="text" value="25" class="form-control" name="amount" id="amount" placeholder="Amount" maxlength="255" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="dateRecorded" class="form-label fw-bold">Date Recorded:</label>
                    <input type="date" name="dateRecorded" id="dateRecorded" class="form-control" placeholder="mm/dd/yyyy" max="<?=date('y-m-d')?>" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="status" class="form-label fw-bold">Status:</label>
                    <input type="text" value="Pending" class="form-control" name="status" id="status" placeholder="Status" maxlength="255" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="purpose" class="form-label fw-bold">Purpose:</label>
                    <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose" maxlength="255" required>
                </div>
            </div>
      
            <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-target="#add-modal" data-bs-toggle="modal">Back</button>
        <button type="submit" class="btn btn-primary" name="add-indigencies">Save</button>
      </div>
      </div>
    </div>
  </div>
</form>

            <?php 
                $get_res = $DB->query("SELECT * FROM resident ORDER BY residentLName ASC");
                $residents = $get_res->fetchAll();
            ?>

            <?php
                $get_ser = $DB->query("SELECT * FROM services WHERE servicesID = 3");
                $services = $get_ser->fetchall();
            ?>

                
            <script src="library/dselect.js"></script>

<!-- add modal for permit -->
<form method="POST" class="modal" id="add-modal-permit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable">

     <!-- Modal Content -->
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">

         <!-- Modal Header -->
        <h5 class="modal-title">Add Business Permit Request</h5>
        <button type="button" class="btn-close" data-bs-target="#add-modal" data-bs-toggle="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

            <div class="mb-3">
                <div class="form-group">
                <label for="tod" class="form-label fw-bold">Type of Document:</label>
                    <select class="form-select" name="tod" id="tod" readonly>
                        <?php foreach($services as $service) :?>
                            <option value="<?=$service['servicesID'];?>"><?=$service['services'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
            <div class="form-group">
            <label for="servicesname" class="form-label fw-bold">Requestor's Full Name:</label>
            <select class="form-select" name="requester" id="requester2" style="text-align: start;" required>
                            <option value="" >Select Resident</option>
                        <?php foreach($residents as $resident) :?>
                            <option value="<?=$resident["residentID"]?>"><?=$resident['residentFName']." ".$resident['residentMName']." ".$resident['residentLName']; ?></option>
                        <?php endforeach; ?>
                    </select>  

                    <script>
                        var requester2_element = document.querySelector('#requester2');
                        dselect( requester2_element, {
                        search: true
                         });
                    </script>
            </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="business_name" class="form-label fw-bold">Business Name:</label>
                    <input type="text" name="business_name" id="business_name" placeholder="Business Name" class="form-control" maxlength="100" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="type_of_business" class="form-label fw-bold">Business Type:</label>
                    <input type="text" name="type_of_business" id="type_of_business" placeholder="Business Type" class="form-control" maxlength="100" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="business_address" class="form-label fw-bold">Business Address:</label>
                    <input type="text" name="business_address" id="business_address" placeholder="Business Address" class="form-control" maxlength="100" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="pickupdate" class="form-label fw-bold">Pick up Date:</label>
                    <input type="date" name="pickupdate" id="pickupdate" class="form-control" placeholder="mm/dd/yyyy" min="<?=date('Y-m-d')?>" required >
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="amount" class="form-label fw-bold">Amount:</label>
                    <input type="text" value="25" class="form-control" name="amount" id="amount" placeholder="Amount" maxlength="255" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="dateRecorded" class="form-label fw-bold">Date Recorded:</label>
                    <input type="date" name="dateRecorded" id="dateRecorded" class="form-control" placeholder="mm/dd/yyyy" max="<?=date('y-m-d')?>" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="status" class="form-label fw-bold">Status:</label>
                    <input type="text" value="Pending" class="form-control" name="status" id="status" placeholder="Status" maxlength="255" readonly>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="purpose" class="form-label fw-bold">Purpose:</label>
                    <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose" maxlength="255" required>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-target="#add-modal" data-bs-toggle="modal">Back</button>
        <button type="submit" class="btn btn-primary" name="add-permits">Save</button>
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
                <h5 class="h5 modal-title text-primary">Delete Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="text-danger">Are you sure you want to delete this transaction?</div>
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="itemid" class="d-none" value="0" />
                    <button type="submit" name="delete-transactions" class="btn btn-primary">Confirm</button>
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