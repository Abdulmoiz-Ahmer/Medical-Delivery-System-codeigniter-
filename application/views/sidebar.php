<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>MDS</title>
    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url('assets/img/brand/favicon.png') ?>" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/nucleo/css/nucleo.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') ?>" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/argon.css?v=1.2.0') ?>" type="text/css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <!-- <img src="" class="navbar-brand-img" alt="..."> -->
                    <h6 class="h2 text-info">MDS</h6>
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">

                        <?php
                        if (isset($user)) {
                            if ($user['role_id'] == 1) {
                        ?>
                                <li class="nav-item">
                                    <a class="<?php
                                                echo 'nav-link';
                                                if ($this->uri->segment(2) == 'allDoctors') {
                                                    echo ' active';
                                                }
                                                ?>" href="<?php echo base_url('/dashboard/assign') ?>">
                                        <i class="ni ni-tag text-orange"></i>
                                        <span class="nav-link-text">Assign</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="<?php
                                                echo "nav-link";
                                                if ($this->uri->segment(2) == 'allpatients') {
                                                    echo " active";
                                                }
                                                ?>" href="<?php echo base_url('/dashboard/allpatients/0') ?>">
                                        <i class="ni ni-single-02 text-primary"></i>
                                        <span class="nav-link-text">Patients</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="<?php
                                                echo "nav-link";
                                                if ($this->uri->segment(2) == 'session') {
                                                    echo " active";
                                                }
                                                ?>" href="<?php echo base_url('/dashboard/session') ?>">
                                        <i class="ni ni-camera-compact text-primary"></i>
                                        <span class="nav-link-text">Session</span>
                                    </a>
                                </li>
                            <?php
                            } else if ($user['role_id'] == 2) { ?>
                                <li class="nav-item">
                                    <a class="<?php
                                                echo "nav-link";
                                                if ($this->uri->segment(2) == 'mypatients') {
                                                    echo " active";
                                                }
                                                ?>" href="<?php echo base_url('/dashboard/mypatients') ?>">
                                        <i class="ni ni-badge text-info"></i>
                                        <span class="nav-link-text">My Patients</span>
                                    </a>
                                </li>

                            <?php
                            } else if ($user['role_id'] == 3) {
                            ?>
                                <li class="nav-item">
                                    <a class="<?php
                                                echo "nav-link";
                                                if ($this->uri->segment(2) == 'patients') {
                                                    echo " active";
                                                }
                                                ?>" href="<?php echo base_url('/dashboard/patients') ?>">
                                        <i class="ni ni-single-02 text-primary"></i>
                                        <span class="nav-link-text">Patients</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="<?php
                                                echo "nav-link";
                                                if ($this->uri->segment(2) == 'prescription') {
                                                    echo " active";
                                                }
                                                ?>" href="<?php echo base_url('/dashboard/prescription') ?>">
                                        <i class="ni ni-single-copy-04 text-yellow"></i>
                                        <span class="nav-link-text">Prescription</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="<?php
                                                echo "nav-link";
                                                if ($this->uri->segment(2) == 'requests') {
                                                    echo " active";
                                                }
                                                ?>" href="<?php echo base_url('/dashboard/requests') ?>">
                                        <i class="ni ni-ambulance text-info"></i>
                                        <span class="nav-link-text">Requests</span>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a class="<?php
                                                echo "nav-link";
                                                if ($this->uri->segment(2) == 'stock') {
                                                    echo " active";
                                                }
                                                ?>" href="<?php echo base_url('/dashboard/stock') ?>">
                                        <i class="ni ni-archive-2 text-default"></i>
                                        <span class="nav-link-text">Stock</span>
                                    </a>
                                </li>
                            <?php
                            } else if ($user['role_id'] == 4) {
                            ?>
                                <li class="nav-item">
                                    <a class="<?php
                                                echo "nav-link";
                                                if ($this->uri->segment(1) == 'admin') {
                                                    echo " active";
                                                }
                                                ?>" href="<?php echo base_url('admin/') ?>">
                                        <i class="ni ni-single-copy-04 text-yellow"></i>
                                        <span class="nav-link-text">Employees</span>
                                    </a>
                                </li>
                        <?php
                            }
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </nav>