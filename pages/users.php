<?php include_once('./layout/sidebar.php');   ?>
<?php if (isset($_GET['edit']) ) : ?>


<?php $get_user = $DB->prepare("SELECT * FROM users WHERE user_id = ? LIMIT 0, 1");
$get_user->execute([ $_GET['edit'] ]);  ?>

<?php if ($get_user && $get_user->rowCount() > 0) :
        $user = $get_user->fetch(); ?>
    <form method="POST" class="row py-5" style="margin-left: 260px; margin-right: 20px">
    
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h2 class="h2 text-primary">Edit User</h2>
            <hr class="hr" />
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="c_address" class="form-label fw-bold" >First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?=$user['first_name']?>" maxlength="255" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_contact" class="form-label fw-bold">Middle Name:</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control" value="<?=$user['middle_name']?>" maxlength="255" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_address" class="form-label fw-bold">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?=$user['last_name']?>" maxlength="255" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="username" class="form-label fw-bold">Username:</label>
                <input type="text" name="username"  class="form-control" value="<?=$user['username']?>" maxlength="30" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="role" class="form-label fw-bold">Position in Barangay Office:</label>
                <select name="role" id="role" class="form-select">
                    <option <?=$user['role']=='BarangayCaptain' ? 'selected' : '' ?> value="Barangay Captain" >Barangay Captain</option>
                    <option <?=$user['role']=='Chairman' ? 'selected' : '' ?> value="Chairman" >Chairman</option>
                    <option <?=$user['role']=='Councilor' ? 'selected' : '' ?> value="Councilor" >Councilor</option>
                    <option <?=$user['role']=='Secretary' ? 'selected' : '' ?> value="Secretary" >Secretary</option>
                </select>
            </div>
        </div> 
        <div class="col-md-4">
            <div class="form-group">
                <label for="p_address" class="form-label fw-bold">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?=$user['email']?>" maxlength="255" required />
            </div>
        </div>

        <div class="col-12">
            <hr class="hr" />
            <a href="<?=root_url('users')?>" class="btn btn-light text-danger rounded-50px px-4">Cancel</a>
            <input type="hidden" name="user_id" value="<?=$user['user_id']?>" class="d-none">
            <button type="submit" name="update-user" class="btn btn-primary rounded-50px px-4">Update</button>
        </div>
        </div>
    </form>
<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>

<!-- View Modal -->
<?php if (isset($_GET['view']) ) : ?>


<?php $get_user = $DB->prepare("SELECT * FROM users WHERE user_id = ? LIMIT 0, 1");
$get_user->execute([ $_GET['view'] ]);  ?>

<?php if ($get_user && $get_user->rowCount() > 0) :
        $user = $get_user->fetch(); ?>
<form class="row py-5" style="margin-left: 260px; margin-right: 20px">
    <div class="col-12">
        <h2 class="h2 text-primary">Users Info</h2>
        <hr class="hr" />
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">First Name: <span class="font-weight-normal"><?=$user["first_name"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Middle Name: <span class="font-weight-normal"><?=$user["middle_name"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Last Name: <span class="font-weight-normal"><?=$user["last_name"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Email: <span class="font-weight-normal"><?=$user["email"] ?></span></p>
    </div>
    <div class="col-lg-4">
    <p class="fs-5 font-weight-bold">Role: <span class="font-weight-normal"><?=$user["role"] ?></span></p>
    </div>
    <div class="col-12">
            <hr class="hr" />
            <a href="<?=root_url('users')?>" class="btn btn-secondary text-light rounded-50px px-4">Close</a>
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
                                        Users
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-sm table-striped table-hover table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="text-center">Firstname</th>
                                                    <th class="text-center">Lastname</th>
                                                    <th class="text-center">Position</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $users = $DB->query("SELECT * FROM users ORDER BY role ASC");
                                                    foreach ($users as $user) : ?>
                                                        <tr class="table-sm text-center">
                                                            <td><?=$user["first_name"] ?></td>
                                                            <td><?=$user["last_name"] ?></td>
                                                            <td><?=$user["role"] ?></td>
                                                            <td><?=$user["email"] ?></td>
                                                            <td>
                                                            <a href="<?=root_url('users')?>?view=<?=$user['user_id']?>" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                                                                <a href="<?=root_url('users')?>?edit=<?=$user['user_id']?>" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                                <a href="#delete-item" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-itemid=<?=$user['user_id']?>>
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

<form method="POST" class="modal fade" id="add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable">

     <!-- Modal Content -->
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">

         <!-- Modal Header -->
        <h5 class="modal-title">Add New User</h5>
        <button type="button" class="btn-close" data-bs-target="#add-modal" data-bs-toggle="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <div class="mb-3">
                <div class="form-group">
                    <label for="first_name" class="form-label fw-bold">First Name:</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" maxlength="255" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="middle_name" class="form-label fw-bold">Middle Name:</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control" maxlength="255" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="last_name" class="form-label fw-bold">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" maxlength="255" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="role" class="form-label fw-bold">Position:</label>
                    <select class="form-select" name="role" id="role" required>
                        <option selected value="">Select Position</option>
                        <option value="Barangay Captain">Barangay Captain</option>
                        <option value="Chairman">Chairman</option>
                        <option value="Councilor">Councilor</option>
                        <option value="Secretary">Secretary</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="email" class="form-label fw-bold">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" maxlength="255" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="username" class="form-label fw-bold">Username:</label>
                    <input type="text" name="username"  class="form-control" maxlength="255" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="password" class="form-label fw-bold">Password:</label>
                    <input type="password" name="password" class="form-control" maxlength="1000" required>
                </div>
            </div>
            
      
            <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-target="#add-modal" data-bs-toggle="modal">Back</button>
        <button type="submit" class="btn btn-primary" name="add-user">Save</button>
      </div>
      </div>
    </div>
  </div>
</form>





















                <!-- The Modal -->
<form method="POST" class="modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add User</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-group">
                <label for="username" class="text-muted font-weight-bold">Username:</label>
                <input type="text" name="username" id="username" class="form-control" maxlength="255" required />
            </div>
            <div class="form-group">
                <label for="password" class="text-muted font-weight-bold">Password:</label>
                <input type="password" name="password" id="password" class="form-control" maxlength="1000" required />
            </div>
            <div class="form-group">
                <label for="role" class="text-muted font-weight-bold">Role:</label>
                <select name="role" id="role" class="form-control">
                    <option value="BarangayCaptain">Barangay Captain</option>
                    <option value="Chairmain">Chairmain</option>
                    <option value="Councilor">Councilor</option>
                    <option value="Secretary">Secretary</option>
                </select>
            </div>
            <div class="form-group">
                <label for="first_name" class="text-muted font-weight-bold">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" maxlength="255" required />
            </div>
            <div class="form-group">
                <label for="middle_name" class="text-muted font-weight-bold">Middle Name:</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control" maxlength="255" />
            </div>
            <div class="form-group">
                <label for="last_name" class="text-muted font-weight-bold">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" maxlength="255" required />
            </div>
            <div class="form-group">
                <label for="email" class="text-muted font-weight-bold">Email:</label>
                <input type="email" name="email" id="email" class="form-control" maxlength="255" required />
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="add-user">Submit</button>
        </div>

        </div>
    </div>
</form>

<div class="modal fade has-itemid" id="delete-item">
    <div class="modal-dialog animate__animated animate__bounceInDown">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="h5 modal-title text-primary">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="text-danger">Are you sure you want to delete this user?</div>
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="itemid" class="d-none" value="0" />
                    <button type="submit" name="delete-user" class="btn btn-primary">Confirm</button>
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

