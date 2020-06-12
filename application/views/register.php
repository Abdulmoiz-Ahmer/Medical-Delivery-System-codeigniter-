<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
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
    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/argon.css?v=1.2.0') ?>" type="text/css">

</head>

<body class="bg-default">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-5 py-lg-5 pt-lg-5">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Create an account!</h1>
                            <p class="text-lead text-white">Neque porro quisquam est qui ipsum quia dolor amet, consectetur, adipisci velit.</p>

                            <!-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div> -->
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="<?php echo base_url('/auth/store') ?>" method="POST">

                                <?php
                                if (validation_errors() != false) {
                                    echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
                                    echo validation_errors();
                                    echo '</div>';
                                }
                                ?>
                                <?php echo form_open(); ?>
                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                    </div> -->
                                    <label for="name">Full Name</label>
                                    <input class="form-control" placeholder="John Doe" name="name" value="<?php if (!isset($clear)) {
                                                                                                                echo set_value('name');
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>" type="text" pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" required>
                                    <!-- pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" -->
                                    <!-- required -->
                                </div>

                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                    </div> -->
                                    <label for="email">Email</label>
                                    <input class="form-control" placeholder="johndoe@mail.domain" name="email" value="<?php if (!isset($clear)) {
                                                                                                                            echo set_value('email');
                                                                                                                        } else {
                                                                                                                            echo "";
                                                                                                                        }
                                                                                                                        ?>" type="email" required>

                                </div>

                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                    </div> -->
                                    <label for="password">Password</label>
                                    <input class="form-control" placeholder="Password" value="<?php if (!isset($clear)) {
                                                                                                    echo set_value('password');
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>" name="password" type="password" minlength="8" required>

                                </div>

                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                    </div> -->
                                    <label for="cnic">CNIC</label>
                                    <input class="form-control" placeholder="12345-1234567-8" value="<?php if (!isset($clear)) {
                                                                                                            echo set_value('cnic');
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>" name="cnic" type="text" required pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$">
                                </div>

                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                    </div> -->
                                    <label for="department">Department</label>
                                    <input class="form-control" placeholder="Administration" value="<?php if (!isset($clear)) {
                                                                                                        echo set_value('department');
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>" name="department" type="text" required pattern="[A-Za-z]+">

                                </div>

                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                    </div> -->
                                    <label for="designation">Designation</label>
                                    <input class="form-control" placeholder="Doctor" name="designation" value="<?php if (!isset($clear)) {
                                                                                                                    echo set_value('designation');
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                }
                                                                                                                ?>" type="text" required pattern="[A-Za-z]+">

                                </div>

                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>

                                    </div> -->
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role" required>
                                        <option disabled>Role</option>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?php echo $role['id']; ?>" <?php if (set_value('role') == $role['id']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $role['role_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                    </div> -->
                                    <label for="salary">Salary</label>
                                    <input class="form-control" placeholder="100000" value="<?php if (!isset($clear)) {
                                                                                                echo set_value('salary');
                                                                                            } else {
                                                                                                echo "";
                                                                                            }
                                                                                            ?>" name="salary" type="text" pattern="^[1-9]\d*(\.\d+)?$" required>

                                </div>


                                <div class="form-group">
                                    <!-- <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                    </div> -->
                                    <label for="jdate">Date</label>
                                    <input class="form-control" name="jdate" value="<?php if (!isset($clear)) {
                                                                                        echo set_value('jdate');
                                                                                    } else {
                                                                                        echo "";
                                                                                    }
                                                                                    ?>" type="date" required>

                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Create account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Argon Scripts -->
    <!-- Core -->

    <script src="<?php echo base_url('assets/vendor/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/js-cookie/js.cookie.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') ?>"></script>
    <!-- Argon JS -->
    <script src="<?php echo base_url('assets/js/argon.js?v=1.2.0') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.bootstrap-growl.min.js') ?>"></script>
    <?php
    if (isset($growl)) {
        if ($growl == -1) {

    ?>
            <script type="text/javascript">
                $(function() {
                    var msg = "<?php echo $message; ?>"
                    setTimeout(function() {
                        $.bootstrapGrowl(msg, {
                            type: 'danger',
                            width: 'auto',
                            allow_dismiss: true
                        });
                    }, 1000);
                });
            </script>
        <?php
        } else if ($growl == 1) {
        ?>
            <script type="text/javascript">
                $(function() {
                    var msg = "<?php echo $message; ?>"
                    setTimeout(function() {
                        $.bootstrapGrowl(msg, {
                            type: 'success',
                            width: 'auto',
                            allow_dismiss: true
                        });
                    }, 1000);
                });
            </script>
    <?php
        }
    }
    ?>
</body>

</html>