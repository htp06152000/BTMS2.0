<?php

    if (isset($_GET['trackingnumber']) ) 

        $numbr = sanitize_input($_GET['trackingnumber']);
        $result = $DB->prepare("SELECT * FROM transaction WHERE trackingnumber = ? LIMIT 0, 1");	
        $result->execute([ $numbr ]);

        if ($result && $result->rowCount() > 0) :
            $resulta = $result->fetch();
?>

<section class="row justify-content-center vh-100">
    <div class="card justify-content-center text-center bg-light text-light" style="width: 45rem; box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px; margin-top: 110px; width: 350px; border-radius: 5px; height: 20rem;">
        <div class="card-body">
            <p class="fw-bold">You paid your request and the current status is currently             
            <?php if($resulta['status']=='Ready to Pick Up'): ?>
				<h5><span class="badge text-bg-light text-dark">Ready to Pick Up</span></h5>
			<?php elseif($resulta['status']=='Pending'): ?>
				<h5><span class="badge text-bg-warning">Pending</span></h5>
			<?php elseif($resulta['status']=='Released'): ?>
				<h5><span class="badge text-bg-success">Released</span></h5>
            <?php elseif($resulta['status']=='Paid'): ?>
                <h5><span class="badge text-bg-primary">Paid</span></h5>
            <?php else : ?>
                <h5><span class="badge text-bg-secondary">Unpaid</span></h5>
			<?php endif ?>
            You can track your request through this tracking code</p>
            <?php  ?>
                <span class="badge text-bg-success"><?php if (isset($_GET['trackingnumber'])) $trk = sanitize_input($_GET['trackingnumber']); echo $trk; ?></span><br>

            <span style="font-size: 16px;"><a style="text-decoration:none; width: 7rem; height:1.8rem; margin-top:2rem;" class="btn btn-danger btn-sm text-light" href="<?=root_url("home")?>">Home</a></span>
            </h3>
            </h3>
        </div>
    </div>
</section>

<?php endif ?>