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
                    <div class="card-header bg-primary">
                        <h6 class="card-text h4 text-light">
                            Business Permit
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr class="table-sm text-center">
                                        <th class="text-center">Transaction ID</th>
                                        <th class="text-center">Requestor</th>
                                        <th class="text-center">Business Type</th>
                                        <th class="text-center">Business Name</th>
                                        <th class="text-center">Business Address</th>
                                        <th class="text-center">Pick Up Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $transaction = $DB->query("SELECT concat(rs.residentFName,' ',rs.residentMName,' ',rs.residentLName) AS requester, tr.*, s.services AS tod FROM transaction tr JOIN resident rs ON tr.residentID = rs.residentID JOIN services s ON tr.servicesID = s.servicesID WHERE s.servicesID = 3 ORDER BY dateRecorded ASC");
                                        foreach ($transaction as $transactions) : ?>                      
                                            <tr class="table-sm">
                                                <td class="text-center"><?=$transactions["transactionID"]?></td>
                                                <td class="text-center"><?=$transactions["requester"]?></td>
                                                <td class="text-center"><?=$transactions["type_of_business"] ?></td>
                                                <td class="text-center"><?=$transactions["business_name"] ?></td>
                                                <td class="text-center"><?=$transactions["business_address"] ?></td>
                                                <td class="text-center"><?=$transactions["pickupdate"] ?></td>
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
                                                    <a href="<?=root_url('generate_permit')?>?view=<?=$transactions['transactionID']?>" title="Generate" class="btn btn-sm btn-success" ><i class="fi fi-rr-print"></i></a>
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