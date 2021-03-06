<script src="<?php echo base_url(); ?>assets/plugins/js/single_custom.js"></script>
<div class="container single_product_container">
    <div class="row">
        <div class="col">

            <!-- Breadcrumbs -->

            <div class="breadcrumbs d-flex flex-row align-items-center">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/wall-tiles/"><i class="fa fa-angle-right" aria-hidden="true"></i>Wall Tiles</a></li>
                    <li class="active"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo $product_name; ?></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="single_product_image">
                <div class="row">
                    <div class="col-lg-12 image_col order-lg-2 order-1">
                        <div class="single_product_image">
                            <div class="single_product_image_background" style="background-image:url(<?php echo $img_path; ?>)"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="product_details">
                <div class="product_details_title">
                    <h2><?php echo $product_name; ?></h2>
                </div>
                <div class="product_color">
                    <span><b>Color</b> : </span>
                    <span><?php echo $tile_details['colour']; ?></span>
                </div>
                <div class="product_color">
                    <span><b>Finish</b> : </span>
                    <span><?php echo $tile_details['finish']; ?></span>
                </div>
                <div class="product_color">
                    <span><b>Size</b> : </span>
                    <span><?php echo $tile_details['size']; ?></span>
                </div>
                <div class="product_color">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <th><b>Product Code</b></th>
                                <th><b>Coverage (Sq Mtr)</b></th>
                                <th><b>Qty Per Box (Sq Ft)</b></th>
                            </thead>
                            <tbody>
                                <td><?php echo str_replace(' ', '-', $product_name); ?></td>
                                <td><?php echo round((($tile_details['length_in_mm'] * $tile_details['width_in_mm']) / 1000000), 4); ?></td>
                                <td><?php echo ceil(((($tile_details['length_in_mm'] * $tile_details['width_in_mm']) / 1000000) * 10.76) * $number_of_pieces_per_box); ?> </td>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="product_color">
                    <span>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#wheretobuy">Where to buy?</button>
                    </span>
                    <span>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tilecalc">Tile Calculator <i class="fa fa-calculator"></i></button>
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="tilecalc">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calculatorModalLabel">Tile Calculator</h5>
                <label class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </label>
            </div>
            <div class="modal-body" id="calculator">
                <div class="calc">
                    <input class="calc-input" type="number" name="length" min="1" placeholder="Length (ft)"> X <input class="calc-input" type="number" name="width" min="1" placeholder="Width (ft)"> = <input class="calc-input" type="text" name="result" readonly="readonly" placeholder="Area (sq. ft)">
                    <button class="btn btn-sm btn-primary" id="tilecalcbtn">Calculate</button>
                </div>
                <div>
                    <b>You will need <span id="boxes" class="tile-boxes">0</span> box(s).</b>
                </div>
                <br>
                <div>
                    <input type="checkbox" id="extra"> <label for="extra"><b>Add extra 10% boxes</b></label>
                    (We always recommend you to order an extra 10% of tiles to allow for cuts & wastage as you might not get the same shade again in future.)
                </div>
                <br>
                <div>
                    <b>Looking for more help?</b>
                    <p>
                        <b>Call</b> : +91-8369807001
                        <br>
                        <b>Email</b> : mail@ceramicskart.com
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tilecalcbtn').on('click', function(){
        var length = $('input[name="length"]').val();
        var width = $('input[name="width"]').val();
        if(length && width) {
            var area = (length * width);
            var tiles_boxes = (length * width) / <?php echo $number_of_pieces_per_box; ?>;
            $('input[name="result"]').val(area);
            $('#boxes').html(Math.ceil(tiles_boxes));
        }
    });
    $('#extra').on('click', function(){
        var length = $('input[name="length"]').val();
        var width = $('input[name="width"]').val();

        if($('#extra:checkbox:checked').length > 0) {
            if(length && width) {
                var tiles_boxes = Math.ceil((length * width) / <?php echo $number_of_pieces_per_box; ?>);
                $('#boxes').html(Math.ceil(tiles_boxes * 1.1));
            }
        } else {
            if(length && width) {
                var tiles_boxes = Math.ceil((length * width) / <?php echo $number_of_pieces_per_box; ?>);
                $('#boxes').html(tiles_boxes);
            }
        }
    });
</script>

<div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="wheretobuy">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="retailersModalLabel">List of Dealers and Retailers</h5>
                <label class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </label>
            </div>
            <div class="modal-body" id="retailers">
                <div class="form-group">
                    <?php foreach($retailer_details as $retailer) { ?>
                        <div class="card">
                            <div class="card-body">
                                <label class="col-form-label"><b>Retailer Name</b>: <?php echo $retailer['retailer_name'];?></label><br>
                                <label class="col-form-label"><b>Address</b>: <?php echo implode(", ",array($retailer['address_01'],$retailer['address_02'],$retailer['address_03'],$retailer['address_04'], $retailer['city'],$retailer['state'],$retailer['country']));?></label><br>
                                <label class="col-form-label"><b>Phone</b>: <?php echo implode(", ",array($retailer['land_line_phone_1'],$retailer['land_line_phone_2'],$retailer['mobile_1'],$retailer['mobile_2']));?></label><br>
                                <label class="col-form-label"><b>Email</b>: <?php echo $retailer['dealer_email'];?></label><br>
                                <label class="col-form-label"><b>Website</b>: <?php echo $retailer['dealer_website'];?></label><br>
                                <label class="col-form-label"><b>Working Hours</b>: <?php echo $retailer['retailer_name'];?></label><br>
                                <label class="col-form-label"><b>Closed On</b>: <?php echo $retailer['day_close'];?></label><br>
                            </div>
                        </div>
                        <br>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="tabs_section_container">

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabs_container">
                    <ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
                        <li class="tab active" data-active-tab="tab_1"><span>Description</span></li>
                        <li class="tab" data-active-tab="tab_2"><span>Reviews</span></li>
                        <li class="tab" data-active-tab="tab_3"><span>Add Review</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">

                <!-- Tab Description -->

                <div id="tab_1" class="tab_container active">
                    <div class="row">
                        <div class="col-lg-12 desc_col">
                            <h4>Description</h4>
                            <div class="tab_text_block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><b>Brand</b>: <?php echo $manufacturer_details['manufacturer_name']; ?></p>
                                        <p><b>Product Name</b>: <?php echo $product_name; ?></p>
                                        <p><b>Series</b>:</p>
                                        <p><b>Size (mm)</b>: <?php echo $tile_details['length_in_mm'] . ' X '. $tile_details['width_in_mm']; ?></p>
                                        <p><b>Material Type</b>:</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><b>Category</b>: <?php echo $tile_details['product_type']; ?></p>
                                        <p><b>Finish</b>: <?php echo $tile_details['finish']; ?></p>
                                        <p><b>Applications</b>: <?php echo $tile_details['application']; ?></p>
                                        <p><b>Coverage (sq. ft)</b>: <?php echo round(($tile_details['length_in_mm'] * 0.0033 ) * ($tile_details['width_in_mm'] * 0.0033 ), 2); ?></p>
                                        <p><b>Coverage (sq. metre)</b>: <?php echo round(($tile_details['length_in_mm'] * 0.001 ) * ($tile_details['width_in_mm'] * 0.001 ), 6); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab_2" class="tab_container">
                    <div class="row">
                        <div class="col-lg-5 desc_col">
                            <h4>Reviews</h4>
                            <div class="tab_text_block">
                                <?php if(!empty($reviews)) {
                                    foreach($reviews as $review) { ?>
                                    <div class="user">
                                        <div class="user_rating">
                                            <ul class="star_rating user_rating_<?php echo $review['id']; ?>">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <script>
                                        star_rating('user_rating_<?php echo $review['id']; ?>', <?php echo $review['rating']; ?>);
                                    </script>
                                    <div class="review">
                                        <div class="review_date"><?php echo date('d M Y', $review['created_at']);?></div>
                                        <div class="user_name"><?php echo $review['email']; ?></div>
                                        <p><?php echo $review['message']; ?></p>
                                    </div>
                                    <?php }
                                    } else { ?>
                                        <div class="review">
                                            No reviews found.
                                        </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab Reviews -->

                <div id="tab_3" class="tab_container">
                    <div class="row">

                    <!-- Add Review -->

                        <div class="col-lg-12 add_review_col">

                            <div class="add_review">
                                <div class="alert alert-success" id="review-success">
                                    <strong>Success!</strong> Your review was submitted successfully.
                                </div>
                                <form id="review_form">
                                    <input type="hidden" name="tile_code" value="<?php echo str_replace(' ', '-', $product_name);?>">
                                    <div>
                                        <h1>Add Review</h1>
                                        <input id="review_name" class="form_input input_name" type="text" name="name" placeholder="Name*" required="required" data-error="Name is required.">
                                        <input id="review_email" class="form_input input_email" type="email" name="email" placeholder="Email*" required="required" data-error="Valid email is required.">
                                    </div>
                                    <div>
                                        <h1>Your Rating:</h1>
                                        <ul class="user_star_rating">
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        </ul>
                                        <input type="hidden" name="review_rating" value="1">
                                        <textarea id="review_message" class="input_review" name="message"  placeholder="Your Review" rows="4" required data-error="Please, leave us a review."></textarea>
                                    </div>
                                    <div class="text-left text-sm-right">
                                        <button id="review_submit" type="button" class="red_button review_submit_btn trans_300" value="Submit">submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="best_sellers">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="section_title new_arrivals_title">
                                <h2>Recently Viewed</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="product_slider_container">
                                <div class="owl-carousel owl-theme product_slider">

                                <?php 
                                    foreach($recently_viewed_tiles as $tile) {
                                        if(!empty($tile['img_path'])) {
                                        ?>
                                        <div class="owl-item product_slider_item">
                                            <div class="product-item" onclick='location.href="/wall-tiles/details/<?php echo $tile['id'];?>"'>
                                                <div class="product discount">
                                                    <div class="product_image">
                                                        <img src="<?php echo $tile['img_path'];?>" alt="">
                                                    </div>
                                                    <div class="product_info">
                                                        <h6 class="product_name"><a href="/wall-tiles/details/<?php echo $tile['id'];?>"><?php echo $tile['product_name'].' ('.$tile['colour'].')'; ?></a></h6>
                                                        <div class="product_price"><?php echo $tile['size'];?></div>
                                                        <h6 class="product_name">Application : <?php echo $tile['application']; ?></h6>
                                                    </div>
                                                </div>
                                                <div class="red_button add_to_cart_button"><a href="/wall-tiles/details/<?php echo $tile['id'];?>">View Details</a></div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Slider Navigation -->

                                <div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </div>
                                <div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/zoomify.js"></script>
<script>
    $(document).ready(function(){
        $('.single_product_image_background').zoomify();
        $('#review-success').hide();
    });

    $('#review_submit').on('click', function(){
        $.ajax({
            url: "/product/review",
            type: "POST",
            data: $('#review_form').serialize(),
            dataType: "json",
            success: function(data) {
                if(data.status == 'success') {
                    $('#review-success').show();
                }
            },
            error: function(e) {
            }          
        });
    });
</script>