<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
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

	<link rel="stylesheet" href="<?php echo base_url('assets/css/argon.css?v=1.2.0s') ?>" type="text/css">

</head>

<body class="bg-default">
	<!-- Navbar -->
	<!-- <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
		<div class="container">
			<a class="navbar-brand" href="dashboard.html">
				<img src="<?php echo base_url('assets/img/brand/white.png') ?>">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
				<div class="navbar-collapse-header">
					<div class="row">
						<div class="col-6 collapse-brand">
							<a href="dashboard.html">
								<img src="<?php echo base_url('assets/img/brand/blue.png') ?>">
							</a>
						</div>
						<div class="col-6 collapse-close">
							<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
								<span></span>
								<span></span>
							</button>
						</div>
					</div>
				</div>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a href="dashboard.html" class="nav-link">
							<span class="nav-link-inner--text">Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="login.html" class="nav-link">
							<span class="nav-link-inner--text">Login</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="register.html" class="nav-link">
							<span class="nav-link-inner--text">Register</span>
						</a>
					</li>
				</ul>
				<hr class="d-lg-none" />
				<ul class="navbar-nav align-items-lg-center ml-lg-auto">
					<li class="nav-item">
						<a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
							<i class="fab fa-facebook-square"></i>
							<span class="nav-link-inner--text d-lg-none">Facebook</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
							<i class="fab fa-instagram"></i>
							<span class="nav-link-inner--text d-lg-none">Instagram</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link nav-link-icon" href="https://twitter.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Twitter">
							<i class="fab fa-twitter-square"></i>
							<span class="nav-link-inner--text d-lg-none">Twitter</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Star us on Github">
							<i class="fab fa-github"></i>
							<span class="nav-link-inner--text d-lg-none">Github</span>
						</a>
					</li>
					<li class="nav-item d-none d-lg-block ml-lg-4">
						<a href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=ad_upgrade_pro" target="_blank" class="btn btn-neutral btn-icon">
							<span class="btn-inner--icon">
								<i class="fas fa-shopping-cart mr-2"></i>
							</span>
							<span class="nav-link-inner--text">Upgrade to PRO</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav> -->
	<!-- Main content -->
	<div class="main-content">
		<!-- Header -->
		<div class="header bg-gradient-primary py-5 py-lg-5 pt-lg-5">
			<div class="container">
				<div class="header-body text-center mb-7">
					<div class="row justify-content-center">
						<div class="col-xl-5 col-lg-6 col-md-8 px-5">
							<h1 class="text-white">Welcome!</h1>
							<p class="text-lead text-white">Neque porro quisquam est qui ipsum quia dolor amet, consectetur, adipisci velit.</p>

							<!-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Page content -->
		<div class="container mt--8 pb-5">
			<div class="row justify-content-center">
				<div class="col-lg-5 col-md-7">
					<div class="card bg-secondary border-0 mb-0">
						<div class="card-header bg-transparent pb-3">
							<div class="text-muted text-center card-title mt-2 mb-0">Sign In</div>
							<!-- <div class="btn-wrapper text-center">
								<a href="#" class="btn btn-neutral btn-icon">
									<span class="btn-inner--icon"><img src="<?php echo base_url('assets/img/icons/common/github.svg') ?>"></span>
									<span class="btn-inner--text">Github</span>
								</a>
								<a href="#" class="btn btn-neutral btn-icon">
									<span class="btn-inner--icon"><img src="<?php echo base_url('assets/img/icons/common/google.svg') ?>"></span>
									<span class="btn-inner--text">Google</span>
								</a>
							
							
							</div> -->
						</div>
						<div class="card-body px-lg-5 py-lg-2">
							<form role="form" action="<?php echo base_url('/auth/show') ?>" method="POST">

								<?php
								if (validation_errors() != false) {
									echo '<div class="bg-danger text-white border-1 rounded mb-3 p-3">';
									echo validation_errors();
									echo '</div>';
								}
								?>

								<?php echo form_open(); ?>
								<div class="form-group mb-3">
									<div class="input-group input-group-merge input-group-alternative">
										<!-- <div class="input-group-prepend">
											<span class="input-group-text"><i class="ni ni-email-83"></i></span>
										</div> -->
										<input class="form-control" value="<?php echo set_value('email'); ?>" name="email" placeholder="Email" type="email" required>
									</div>
								</div>
								<div class="form-group mb-1">
									<div class="input-group input-group-merge input-group-alternative">
										<!-- <div class="input-group-prepend">
											<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
										</div> -->
										<input class="form-control" value="<?php echo set_value('password'); ?>" name="password" placeholder="Password" type="password" required minlength="8">
									</div>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-primary my-4">Sign in</button>
								</div>
							</form>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">
							<!-- <a href="#" class="text-light"><small>Forgot password?</small></a> -->
						</div>
						<div class="col-6 text-right">
							<a href="<?php echo base_url('/auth/create') ?>" class="text-light"><small>Create new account</small></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<!-- <footer class="py-5" id="footer-main">
		<div class="container">
			<div class="row align-items-center justify-content-xl-between">
				<div class="col-xl-6">
					<div class="copyright text-center text-xl-left text-muted">
						&copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
					</div>
				</div>
				<div class="col-xl-6">
					<ul class="nav nav-footer justify-content-center justify-content-xl-end">
						<li class="nav-item">
							<a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
						</li>
						<li class="nav-item">
							<a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
						</li>
						<li class="nav-item">
							<a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
						</li>
						<li class="nav-item">
							<a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer> -->
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
					var msg = " <?php echo $message; ?>"
					console.log(msg);
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
		}
	}
	?>

</body>

</html>