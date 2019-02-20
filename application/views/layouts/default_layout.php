<!DOCTYPE html>
<html lang="en">
<head>
<title>CeramicsKart</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/contact_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/contact_responsive.css">


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header trans_300">

		<!-- Top Navigation -->

		<div class="top_nav">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-10 text-right">
						<div class="top_nav_right">
							<ul class="top_nav_menu">

								<!-- Location -->
                <li class="currency">
									<a href="#">
                    <i class="fa fa-email"></i>
                    mail@ceramicskart.com
									</a>
								</li>
                <li class="account">
                  <a href="">
                    <i class="fa fa-phone"></i>
                      +918369807001
                  </a>
                </li>
								<li class="language">
									<a href="#">
                    <i class="fa fa-location-arrow"></i>
										  Select Location
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="language_selection">
                    <li><a href="#">Mumbai</a></li>
										<li><a href="#">Thane</a></li>
										<li><a href="#">Nashik</a></li>
										<li><a href="#">Pune</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						  <div class="logo_container">
							  <a href="/">ceramics<span>kart</span></a>
              </div>
	  					<nav class="navbar">
  							<ul class="navbar_menu">
								  <li><a href="/">home</a></li>
							  	<li><a href="#">floor tiles</a></li>
						  		<li><a href="#">wall tiles</a></li>
					  			<li><a href="http://3dvisualizer.ceramicskart.com/" target="_blank">3d visualizer</a></li>
                  <li><a href="#">sanitaryware</a></li>
                  <li><a href="#">augmented reality</a></li>
		  						<li><a href="#">other products</a></li>
	  						</ul>
  							<div class="hamburger_container">
								  <i class="fa fa-bars" aria-hidden="true"></i>
							  </div>
              </nav>
					</div>
				</div>
			</div>
		</div>

	</header>

	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item">
          <a href="#">
            <i class="fa fa-email"></i>
            mail@ceramicskart.com
          </a>
				</li>
				<li class="menu_item">
          <a href="">
            <i class="fa fa-phone"></i>
              +918369807001
          </a>
				</li>
        <li class="menu_item has-children">
            <a href="#">
              <i class="fa fa-location-arrow"></i>
                Select Location
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="menu_selection">
              <li><a href="#">Mumbai</a></li>
              <li><a href="#">Thane</a></li>
              <li><a href="#">Nashik</a></li>
              <li><a href="#">Pune</a></li>
            </ul>
          </li>
        <li class="menu_item"><a href="/">home</a></li>
        <li class="menu_item"><a href="#">floor tiles</a></li>
        <li class="menu_item"><a href="#">wall tiles</a></li>
        <li class="menu_item"><a href="#">3d visualizer</a></li>
        <li class="menu_item"><a href="#">sanitaryware</a></li>
        <li class="menu_item"><a href="#">augmented reality</a></li>
        <li class="menu_item"><a href="#">other products</a></li>
			</ul>
		</div>
	</div>

  <!-- Content -->
    <?php echo $contents;?>
  <!-- /Content -->
	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
						<ul class="footer_nav">
							<li><a href="#">FAQs</a></li>
							<li><a href="/contact">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer_nav_container">
						<div class="cr">&copy; 2019 All Rights Reserverd. CeramicsKart</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<script src="<?php echo base_url(); ?>assets/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/easing/easing.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/js/custom.js"></script>
</body>

</html>
