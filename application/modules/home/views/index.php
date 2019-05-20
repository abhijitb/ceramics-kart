
	<!-- Banner -->

	<div class="main_slider" style="background-image:url(<?php echo base_url();?>assets/images/home/home-banner.jpg)">
		<div class="container fill_height">
			<div class="row align-items-center fill_height">
				<div class="col">
					<div class="main_slider_content">
						<div class="red_button shop_now_button"><a href="https://3dvisualizer.ceramicskart.com/">3D Visualizer</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- products -->

	<div class="banner">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title" style="margin-bottom: 50px;">
						<h2>Choose Products By Application</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(<?php echo base_url();?>assets/images/home/bathroom.jpg)">
						<div class="banner_category">
							<a href="categories.html">Bathroom</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(<?php echo base_url();?>assets/images/home/bedroom.jpg)">
						<div class="banner_category">
							<a href="categories.html">Bedroom</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(<?php echo base_url();?>assets/images/home/living_room.jpg)">
						<div class="banner_category">
							<a href="categories.html">Drawing Room</a>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(<?php echo base_url();?>assets/images/home/kitchen.jpg)">
						<div class="banner_category">
							<a href="categories.html">Kitchen</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(<?php echo base_url();?>assets/images/home/outdoor.jpg)">
						<div class="banner_category">
							<a href="categories.html">Outdoor</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(<?php echo base_url();?>assets/images/home/office.jpg)">
						<div class="banner_category">
							<a href="categories.html">Office</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    $.ajax({
        type:'POST',
        url:'getLocation.php',
        data:'latitude='+latitude+'&longitude='+longitude,
        success:function(msg){
            if(msg){
               $("#location").html(msg);
            }else{
                $("#location").html('Not Available');
            }
        }
    });
}
</script>