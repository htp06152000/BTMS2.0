<?php

if ( isset($_GET['tr-number']) ) {

	$numbr = sanitize_input($_GET['tr-number']);
	

	$result = $DB->prepare("SELECT * FROM transaction WHERE TransactionID = ? LIMIT 0, 1");	
	$result->execute([ $numbr ]);
    
    if ($result && $result->rowCount() > 0) {

    }

    else {
    $_SESSION ['message'] = 'Wala kapa ka request day!';
    $_SESSION ['messagetype'] = 'danger';

}
}
?>
<?php 
    
    if ($result && $result->rowCount() > 0) :
        $resulta = $result->fetch();
?>
<section class="row justify-content-center vh-100">
    <div class="card justify-content-center text-center bg-info text-light" style="width: 45rem; box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px; margin-top: 110px; width: 350px; border-radius: 5px; height: 10rem;">
        <div class="card-body">
            <h3>Your request status is currently <h3 class="fw-bold" >
            <?php if($resulta['status']=='Ready to Pick Up'): ?>
				<h5><span class="badge text-bg-warning">Ready to Pick Up</span></h5>
			<?php elseif($resulta['status']=='Pending'): ?>
				<h5><span class="badge text-bg-danger">Pending</span></h5>
			<?php else: ?>
				<h5><span class="badge text-bg-success">Released</span></h5>
			<?php endif ?>
            </h3>
            </h3>
        </div>
    </div>
</section>
<?php endif ?>

