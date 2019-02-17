    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                  <h1 class="box-title">Edit User</h1>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/admin/edit_user/<?php echo $user->id;?>" method="post" accept-charset="utf-8">
              <div class="box-body">
                  <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="firstname" value="<?php echo $first_name['value']; ?>" autofocus>
                  </div>
                  <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $last_name['value']; ?>" id="lastname">
                  </div>
                  <div class="form-group">
                        <label for="company">Company Name</label>
                        <input type="text" name="company" class="form-control" value="<?php echo $company['value']; ?>" id="company">
                  </div>
                  <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $phone['value']; ?>" id="phone">
                  </div>
                  <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                  </div>
                  <div class="form-group">
                        <label for="password_confirm">Company Name</label>
                        <input type="password" name="password_confirm" class="form-control" id="password_confirm">
                  </div>
                  <?php if ($this->ion_auth->is_admin()): ?>

                  <label><?php echo lang('edit_user_groups_heading');?></label>
                  <div class="checkbox">
                        <?php foreach ($groups as $group):?>
                              <label class="checkbox">
                              <?php
                                    $gID=$group['id'];
                                    $checked = null;
                                    $item = null;
                                    foreach($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                          $checked= ' checked="checked"';
                                    break;
                                    }
                                    }
                              ?>
                              <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                              <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                              </label>
                        <?php endforeach?>
                  </div>
                  <?php endif ?>
                  <?php echo form_hidden('id', $user->id);?>
                  <?php echo form_hidden($csrf); ?>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
  </div>
</section>
