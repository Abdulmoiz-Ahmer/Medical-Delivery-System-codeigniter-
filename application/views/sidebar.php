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
                                    <a class="nav-link" href="/dashboard/assign">
                                        <i class="ni ni-tag text-orange"></i>
                                        <span class="nav-link-text">Assign</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" href="/dashboard/allpatients">
                                        <i class="ni ni-single-02 text-primary"></i>
                                        <span class="nav-link-text">Patients</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard/session">
                                        <i class="ni ni-camera-compact text-primary"></i>
                                        <span class="nav-link-text">Session</span>
                                    </a>
                                </li>
                            <?php
                            } else if ($user['role_id'] == 2) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard/mypatients">
                                        <i class="ni ni-badge text-info"></i>
                                        <span class="nav-link-text">My Patients</span>
                                    </a>
                                </li>

                            <?php
                            } else if ($user['role_id'] == 3) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/dashboard/patients">
                                        <i class="ni ni-single-02 text-primary"></i>
                                        <span class="nav-link-text">Patients</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard/prescription">
                                        <i class="ni ni-single-copy-04 text-yellow"></i>
                                        <span class="nav-link-text">Prescription</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard/requests">
                                        <i class="ni ni-ambulance text-info"></i>
                                        <span class="nav-link-text">Requests</span>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard/stock">
                                        <i class="ni ni-archive-2 text-default"></i>
                                        <span class="nav-link-text">Stock</span>
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