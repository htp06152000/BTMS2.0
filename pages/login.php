<?php if ( ! defined('ACCESS') ) die("Direct access not allowed."); ?>

<!-- Log in form -->
<div class="row justify-content-center vh-100">
    <div class="login text-center text-light shadow-sm animate__animated animate__<?=(isset($_SESSION['message'])?'swing':'slideInDown')?>" method="post"  style="margin-top: 110px; width: 350px; border-radius: 5px;">
        <a href="<?=root_url("home")?>" class="img align-items-center">
            <img src="./resources/images/logins.jpg" alt="" style="border-radius: 55px;">
        </a>
        <form method="post">
            <div class="mb-3">
                <label name="username" class="form-label" style="font-weight: 450; font-size:16px;">Username</label>
                <input type="text" name="username" class="form-control form-control-sm" maxlength="50" placeholder="Enter username" required>
            </div>
        <div class="mb-3">
            <label name="password"  class="form-label">Password</label>
            <input type="password" class="form-control form-control-sm" name="password" placeholder="Enter password" required>
        </div>
            <button type="submit" class="btn btn-success w-75 text-light" name="login">Login</button>
        </form>
    </div>
</div>