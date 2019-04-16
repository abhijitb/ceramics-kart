<section class="content-header">
    <h1> File Management</h1>
    <ol class="breadcrumb">
        <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="active">File Management</a></li>
    </ol>
</section>
    
<section class="content">
	<?php if(!empty($this->session->userdata('error'))) { ?>
        <div class="alert alert-danger"><?php echo $this->session->userdata('error'); ?></div>
    <?php } ?>
    <?php if(!empty($this->session->userdata('success'))) { ?>
        <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
    <?php } ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">List</a></li>
                <li><a href="#tab_2" data-toggle="tab">Upload</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box-header">
                            <h3 class="box-title">File List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive ">
                            <table id="tracking-info" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th>Width</th>
                                        <th>Height</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($file_list as $key => $file) { ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $file['name']; ?></td>
                                        <td><?php echo $file['type']; ?></td>
                                        <td><?php echo $file['size']; ?> KB</td>
                                        <td><?php echo $file['width']; ?></td>
                                        <td><?php echo $file['height']; ?></td>
                                        <td>
                                            <a class="btn-xs bg-purple" href="/admin/file-delete?name=<?php echo $file['name'];?>"> Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                        <div class="box-header">
                            <h3 class="box-title">File Uploader</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form name="form_id" id="form_id" action="javascript:void(0);" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" name="vasplus_multiple_files" id="vasplus_multiple_files" multiple="multiple"/>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" value="Upload"/>
                                </div>
                            </form>

                            <table class="table table-striped table-bordered" id="add_files">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Status</th>
                                        <th>File Size</th>
                                        <th>Action</th>
                                    <tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>assets/js/vpb_uploader.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	// Call the main function
	new vpb_multiple_file_uploader
	({
		vpb_form_id: "form_id", // Form ID
		autoSubmit: true,
		vpb_server_url: "/admin/file_upload" 
	});
});

$(function () {
    $('#tracking-info').DataTable({
        "pageLength": 25
    });
});
</script>
