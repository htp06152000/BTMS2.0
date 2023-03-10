<?php if ( ! defined('ACCESS') ) die("Direct access not allowed."); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- Nav Title -->
        <section class="sidebar sidebar-expand d-flex flex-column align-items-center" style="width: 240px; " id="sidebar ">
            
            <div class="sidebar-brand text-light mt-5">
                <h4 class="heading font-weight-bold text">ADMINISTRATOR</h4>
                <hr class="hr" />
        </div>

        <!-- Nav Links and items -->
            <ul class="nav d-flex flex-column mt-3 w-100">
                <li class="nav-items w-100">
                    <a href="<?=root_url('dashboard')?>" class="nav-link text-light pl-4 <?=($pagetitle=='dashboard'?' active':'')?>"><i class="fi fi-rr-layout-fluid"></i> Dashboard</a>
                </li>
                <li class="nav-items w-100">
                    <a href="<?=root_url('users')?>" class="nav-link text-light pl-4 <?=($pagetitle=='users'?' active':'')?>"><i class="bi bi-people"></i> Users</a>
                </li>
                <li class="nav-items w-100">
                    <a href="<?=root_url('residents')?>" class="nav-link text-light pl-4 <?=($pagetitle=='residents'?' active':'')?>"><i class="fi fi-rr-users"></i> Residents</a>
                </li>
                <li class="nav-items w-100">
                    <a href="<?=root_url('blotters')?>" class="nav-link text-light pl-4 <?=($pagetitle=='blotters'?' active':'')?>"><i class="fi fi-rr-engine-warning"></i> Blotter Reports</a>
                </li>
                <li class="nav-items w-100">
                    <a href="<?=root_url('transactions')?>" class="nav-link text-light pl-4<?=($pagetitle=='transactions'?' active':'')?>"><i class="fi fi-rr-file-invoice"></i> Transactions</a>
                </li>
                <li class="nav-items w-100">
                    <a href="<?=root_url('clearances')?>" class="nav-link text-light pl-4<?=($pagetitle=='clearances'?' active':'')?>"><i class="fi fi-rr-file-invoice"></i> Barangay Clearance</a>
                </li>
                <li class="nav-items w-100">
                    <a href="<?=root_url('indigencies')?>" class="nav-link text-light pl-4<?=($pagetitle=='indigencies'?' active':'')?>"><i class="fi fi-rr-file-invoice"></i> Certificate of Indigency</a>
                </li>
                <li class="nav-items w-100">
                    <a href="<?=root_url('permits')?>" class="nav-link text-light pl-4<?=($pagetitle=='permits'?' active':'')?>"><i class="fi fi-rr-file-invoice"></i> Business Permit</a>
                </li>
                </li>
                <li class="nav-items w-100">
                    <a href="<?=root_url('logout')?>" class="nav-link text-light pl-4"><i class="fi fi-rr-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </section>