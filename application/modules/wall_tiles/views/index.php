<div class="container product_section_container">
		<div class="row">
			<div class="col product_section clearfix">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="/">Home</a></li>
						<li class="active"><i class="fa fa-angle-right" aria-hidden="true"></i>Wall Tiles	</li>
					</ul>
				</div>

				<!-- Sidebar -->

				<div class="sidebar">
					<!-- Color -->
					<div class="sidebar_section">
						<div class="sidebar_title">
							<h5>Color</h5>
						</div>
						<ul class="checkboxes">
							<?php foreach($tile_colours as $color) { ?>
								<li><i class="fa fa-square-o" aria-hidden="true"></i><span><?php echo $color['colour']; ?></span></li>
							<?php } ?>
						</ul>
					</div>

					<!-- Size -->
					<div class="sidebar_section">
						<div class="sidebar_title">
							<h5>Size</h5>
						</div>
						<ul class="checkboxes">
							<?php foreach($tile_sizes as $size) { ?>
								<li><i class="fa fa-square-o" aria-hidden="true"></i><span><?php echo $size['size']; ?></span></li>
							<?php } ?>
						</ul>
					</div>

					<!-- Finish Type -->
					<div class="sidebar_section">
						<div class="sidebar_title">
							<h5>Finish Type</h5>
						</div>
						<ul class="checkboxes">
							<?php foreach($tile_finishes as $finish) { ?>
								<li><i class="fa fa-square-o" aria-hidden="true"></i><span><?php echo $finish['finish']; ?></span></li>
							<?php } ?>
						</ul>
					</div>

					<!-- Application -->
					<div class="sidebar_section">
						<div class="sidebar_title">
							<h5>Application</h5>
						</div>
						<ul class="checkboxes">
							<?php foreach($tile_applications as $application) { ?>
								<li><i class="fa fa-square-o" aria-hidden="true"></i><span><?php echo $application['application']; ?></span></li>
							<?php } ?>
						</ul>
					</div>
				</div>

				<!-- Main Content -->

				<div class="main_content">

					<!-- Products -->

					<div class="products_iso">
						<div class="row">
							<div class="col">

								<!-- Product Grid -->

								<div class="product-grid">
									<?php 
										foreach($wall_tiles as $tile) {

											if(!empty($tile['img_path'])) {
											?>
												<div class="product-item">
													<div class="product discount product_filter">
														<div class="product_image">
															<img src="<?php echo $tile['img_path'];?>" alt="">
														</div>
														<div class="product_info">
															<h6 class="product_name"><a href="/wall-tiles/details/<?php echo $tile['id'];?>"><?php echo $tile['product_name'].' ('.$tile['colour'].')'; ?></a></h6>
															<div class="product_price"><?php echo $tile['size'];?></div>
														</div>
													</div>
													<div class="red_button add_to_cart_button"><a href="/wall-tiles/details/<?php echo $tile['id'];?>">View Details</a></div>
												</div>
											<?php
											}
										}
									?>		
									<!-- Product 1 -->

									

									<!-- Product 2 -->

									<!-- <div class="product-item women">
										<div class="product product_filter">
											<div class="product_image">
												<img src="<?php echo base_url();?>assets/images/product_2.png" alt="">
											</div>
											<div class="favorite"></div>
											<div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>new</span></div>
											<div class="product_info">
												<h6 class="product_name"><a href="single.html">Samsung CF591 Series Curved 27-Inch FHD Monitor</a></h6>
												<div class="product_price">$610.00</div>
											</div>
										</div>
										<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
									</div> -->

									<!-- Product 3 -->

									<!-- <div class="product-item women">
										<div class="product product_filter">
											<div class="product_image">
												<img src="<?php echo base_url();?>assets/images/product_3.png" alt="">
											</div>
											<div class="favorite"></div>
											<div class="product_info">
												<h6 class="product_name"><a href="single.html">Blue Yeti USB Microphone Blackout Edition</a></h6>
												<div class="product_price">$120.00</div>
											</div>
										</div>
										<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
									</div> -->

									<!-- Product 4 -->

									<!-- <div class="product-item accessories">
										<div class="product product_filter">
											<div class="product_image">
												<img src="<?php echo base_url();?>assets/images/product_4.png" alt="">
											</div>
											<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
											<div class="favorite favorite_left"></div>
											<div class="product_info">
												<h6 class="product_name"><a href="single.html">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
												<div class="product_price">$410.00</div>
											</div>
										</div>
										<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
									</div> -->


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>assets/plugins/js/categories_custom.js"></script>
