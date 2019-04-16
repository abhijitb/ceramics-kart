
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#api" data-toggle="tab">API</a></li>
              <li><a href="#change-password" data-toggle="tab">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="api">
					<form class="form-horizontal">
						<div class="form-group">
							<label for="inputName" class="col-sm-2 control-label">API KEY</label>

							<div class="col-sm-6">
								<input type="text" class="form-control" id="api-key" value="<?php echo $api_key['key'];?>" readonly>
							</div>
							<div class="col-sm-4">
								<button type="button" id="generate-key" class="btn btn-info">Generate New Key</button>
							</div>
						</div>
					</form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="change-password">
                <h4>Set a new password</h4>

                <?php if(!empty($this->session->userdata('error'))) { ?>
                      <div class="alert alert-danger"><?php echo $this->session->userdata('error'); ?></div>
                <?php } ?>

                <?php if(!empty($this->session->userdata('success'))) { ?>
                      <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
                <?php } ?>

                <?php if(!empty($this->session->userdata('message'))) { ?>
                      <div class="alert alert-info"><?php echo $this->session->userdata('message'); ?></div>
                <?php } ?>


                <form action="/admin/change_password" method="post" accept-charset="utf-8">
                      <div class="form-group">
                            <label for="old_password">Old Password</label> <br />
                            <input type="password" name="old" value="" id="old" class="form-control">
                      </div>

                      <div class="form-group">
                            <label for="new_password">New Password (at least 8 characters long)</label> <br />
                            <input type="password" name="new" value="" id="new" pattern="^.{8}.*$" class="form-control">
                      </div>

                      <div class="form-group">
                            <label for="new_password_confirm">Confirm New Password</label> <br />
                            <input type="password" name="new_confirm" value="" id="new_confirm" pattern="^.{8}.*$" class="form-control">
                      </div>
                      <div class="form-group">
                            <input type="hidden" name="user_id" value="<?php echo $user_id['value']; ?>" id="user_id">
                            <p>
                                  <input type="submit" class="btn btn-info" name="submit" value="Change">
                            </p>
                      </div>

                </form> 
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
<script>
$('#generate-key').on('click', function() {
    var report_button = $(this);
    var userid = $('input[name="user_id"]').val();
    if(userid != 0) {
        report_button.button('loading');
        $.ajax({
            url: "/admin/generate-api-key",
            type: "POST",
            data: {"user_id" : userid},
            dataType: "json",
            success: function(data) {
                if(data.status == 'success') {
                    $('#api-key').val(data.api_key);
                    report_button.button('reset');
                }
            },
            error: function(e) {
            }
        });
    }
});
</script>