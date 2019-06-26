<div class="container single_product_container">
    <div class="row">
        <div class="col">

            <!-- Breadcrumbs -->

            <div class="breadcrumbs d-flex flex-row align-items-center">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/floor-tiles/"><i class="fa fa-angle-right" aria-hidden="true"></i>Floor Tiles</a></li>
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
                    <input class="calc-input" type="text" name="length" placeholder="Length (ft)"> X <input class="calc-input" type="text" name="width" placeholder="Width (ft)"> = <input class="calc-input" type="text" name="result" readonly="readonly" placeholder="Area (sq. ft)">
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
                    <?php foreach($dealer_details as $dealer) { ?>
                        <div class="card">
                            <div class="card-body">
                                <label class="col-form-label"><b>Dealer Name</b>: <?php echo $dealer['dealer_name'];?></label><br>
                                <label class="col-form-label"><b>Address</b>: <?php echo implode(", ",array($dealer['address_01'],$dealer['address_02'],$dealer['address_03'],$dealer['address_04'], $dealer['city'],$dealer['state'],$dealer['country']));?></label><br>
                                <label class="col-form-label"><b>Phone</b>: <?php echo implode(", ",array($dealer['land_line_phone_1'],$dealer['land_line_phone_2'],$dealer['mobile_1'],$dealer['mobile_2']));?></label><br>
                                <label class="col-form-label"><b>Email</b>: <?php echo $dealer['dealer_email'];?></label><br>
                                <label class="col-form-label"><b>Website</b>: <?php echo $dealer['dealer_website'];?></label><br>
                                <label class="col-form-label"><b>Working Hours</b>: <?php echo $dealer['dealer_name'];?></label><br>
                                <label class="col-form-label"><b>Closed On</b>: <?php echo $dealer['day_close'];?></label><br>
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
                                <div class="user">
                                    <div class="user_pic"></div>
                                    <div class="user_rating">
                                        <ul class="star_rating">
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="review">
                                    <div class="review_date">27 Aug 2016</div>
                                    <div class="user_name">Brandon William</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
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
                                <form id="review_form" action="post">
                                    <div>
                                        <h1>Add Review</h1>
                                        <input id="review_name" class="form_input input_name" type="text" name="name" placeholder="Name*" required="required" data-error="Name is required.">
                                        <input id="review_email" class="form_input input_email" type="email" name="email" placeholder="Email*" required="required" data-error="Valid email is required.">
                                    </div>
                                    <div>
                                        <h1>Your Rating:</h1>
                                        <ul class="user_star_rating">
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        </ul>
                                        <textarea id="review_message" class="input_review" name="message"  placeholder="Your Review" rows="4" required data-error="Please, leave us a review."></textarea>
                                    </div>
                                    <div class="text-left text-sm-right">
                                        <button id="review_submit" type="submit" class="red_button review_submit_btn trans_300" value="Submit">submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/js/single_custom.js"></script>