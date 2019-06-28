<div class="container product_section_container">
	<div class="row">
		<div class="col product_section clearfix">

			<!-- Breadcrumbs -->

			<div class="breadcrumbs d-flex flex-row align-items-center">
				<ul>
					<li><a href="/">Home</a></li>
					<li class="active"><i class="fa fa-angle-right" aria-hidden="true"></i>Floor Tiles	</li>
				</ul>
			</div>

			<!-- Sidebar -->

			<div class="sidebar">
				<?php if(!empty($tile_colours)) { ?>
				<!-- Color -->
				<div class="sidebar_section">
					<div class="sidebar_title">
						<h5>Color</h5>
					</div>
					<ul class="checkboxes" data-group="colour">
						<?php foreach($tile_colours as $color) { ?>
							<li>
								<label><input type="checkbox" name="colour" value="<?php echo strtolower($color['colour']); ?>" class="filter-checkboxes" aria-hidden="true"><?php echo $color['colour']; ?></label>
							</li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>

				<?php if(!empty($tile_sizes)) { ?>
				<!-- Size -->
				<div class="sidebar_section">
					<div class="sidebar_title">
						<h5>Size</h5>
					</div>
					<ul class="checkboxes" data-group="size">
						<?php foreach($tile_sizes as $size) { ?>
							<li>
								<label><input type="checkbox" name="size" value="<?php echo str_replace(' ', '-', strtolower($size['size'])); ?>" class="filter-checkboxes" aria-hidden="true"><?php echo $size['size']; ?></label>
							</li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>

				<?php if(!empty($tile_finishes)) { ?>
				<!-- Finish Type -->
				<div class="sidebar_section">
					<div class="sidebar_title">
						<h5>Finish Type</h5>
					</div>
					<ul class="checkboxes" data-group="finish">
						<?php foreach($tile_finishes as $finish) { ?>
							<li>
								<label><input type="checkbox" name="finish" value="<?php echo strtolower($finish['finish']); ?>" class="filter-checkboxes" aria-hidden="true"><?php echo $finish['finish']; ?></label>
							</li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>

				<!-- Application -->
				<?php if(!empty($tile_applications)) { ?>
				<div class="sidebar_section">
					<div class="sidebar_title">
						<h5>Application</h5>
					</div>
					<ul class="checkboxes" data-group="application">
						<?php foreach($tile_applications as $application) { ?>
							<li>
								<label><input type="checkbox" name="application" value="<?php echo str_replace(' ', '-', strtolower($application['application'])); ?>" class="filter-checkboxes" aria-hidden="true"><?php echo $application['application']; ?></label>
							</li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>
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
									foreach($floor_tiles as $tile) {
										if(!empty($tile['img_path'])) {
										?>
											<div class="product-item <?php echo strtolower($tile['colour']).' '.strtolower($tile['finish']).' '.str_replace(' ', '-', strtolower($tile['size'])).' '.str_replace(' ', '-', strtolower($tile['application'])) ;?>">
												<div class="product discount product_filter">
													<div class="product_image">
														<img src="<?php echo $tile['img_path'];?>" alt="">
													</div>
													<div class="product_info">
														<h6 class="product_name"><a href="/<?php echo strtolower(str_replace(' ', '_', $tile['product_type']));?>s/details/<?php echo $tile['id'];?>"><?php echo $tile['product_name'].' ('.$tile['colour'].')'; ?></a></h6>
														<div class="product_price"><?php echo $tile['size'];?></div>
														<h6 class="product_name">Application : <?php echo $tile['application']; ?></h6>
													</div>
												</div>
												<div class="red_button add_to_cart_button"><a href="/<?php echo strtolower(str_replace(' ', '_', $tile['product_type']));?>s/details/<?php echo $tile['id'];?>">View Details</a></div>
											</div>
										<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/js/categories_custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tile_filters.js"></script>
