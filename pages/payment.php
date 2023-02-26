<?php

    if (isset($_POST['pay'])) {
        $site_url = 'http://localhost/BTMS2.0/home.php'; // the url of your website
        $enable_sandbox = false; // enable sandbox for test payments.
        // paypal configurations
        $paypal_conf = [
            'cmd' => '_xclick', // use '_xclick' for purchase or pay now button
            'email' => 'ferlynfrenal@gmail.com', // paypal emai where payments will be sent
            'return_url' => $site_url . '?paypal-response=successful',
            'cancel_url' => $site_url . '?paypal-response=cancelled',
            'notify_url' => $site_url
        ];
        // set data to be sent to paypal
        $data = [];
        $data['amount'] = $_POST['donation-amount'];                // amount to be paid
        $data['currency_code'] = $_POST['donation-currency'];       // payment currency
        $data['item_name'] = "Donation";                            // name of paid item
        $data['cmd'] = $paypal_conf['cmd'];                         // paypal check out type
        $data['business'] = $paypal_conf['email'];                  // merchant email
        $data['return'] = stripslashes($paypal_conf['return_url']);
        $data['notify_url'] = stripslashes($paypal_conf['notify_url']);
        $data['cancel_return'] = stripslashes($paypal_conf['cancel_url']);
        // build query string
        $query_string = http_build_query($data);
        // prepare paypal url
        $paypal_url = $enable_sandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
        // redirect to paypal
        header('location:' . $paypal_url . '?' . $query_string);
        exit();
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pay with paypal - a demo page for paying with paypal">
    <meta name="author" content="Service payment">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">    
    <title>Pay with Paypal</title>
</head>
    <body style="font-family:sans-serif;background-color:#cae5ff;display:flex;align-items:center;justify-content:center;height:95vh;flex-direction:column;">
        <?php if(isset($_GET['paypal-response']) && $_GET['paypal-response']=="successful" ):?>
            <h1 style="font-size:3.3rem;margin-bottom:0;">Request & payment successfully submitted</h1>
            <p></p>
            <a href="./">go to home</a>
        <?php else:?>
            <div>
                <h2 class="fw-bolder" style="font-size: 60px; color:coral; text-transform: uppercase; ">Barangay Clearance</h2>
                <h4 class="text-center fst-italic">Pay via Paypal click the pay button to pay</h4>
                <h6 class="text-center">Make sure you have paypal account before proceeding</h6>

            </div>
            <form method="post" style="display:flex;margin-top:3em;">
                <select name="donation-currency" id="currency" style="padding:0.5em 0.2em 0.5em 1em;font-size:1.3rem;border:none;border-radius:10px 0 0 10px;">
                    <option value="PHP">₱</option>
                    <option value="USD">$</option>
                </select>
                <input type="number" name="donation-amount" id="amount" value="25" style="border:0;padding:0.3em 0.3em 0.3em 0.5em;font-size:18px;font-weight:bold;" />
                <button type="submit" name="pay" style="background-color:#0027c1;border:none;border-radius:0 10px 10px 0;padding:0.3em 1.5em 0.3em 1.2em;color:#f1f1f1;cursor:pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" height="20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
                </button>
            </form>
            <a class="btn btn-primary btn-sm" role="button" href="<?=root_url('home')?>" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px; margin-top: 10px;">Back to Home</a>
        <?php endif;?>
    </body>
</html>