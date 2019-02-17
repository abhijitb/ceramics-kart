    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-5">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h1 class="box-title">Create User</h1>
              <br>
              <small>Please enter the user's information below.</small>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/admin/create_user" method="post" accept-charset="utf-8">
              <div class="box-body">
                <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" name="first_name" class="form-control" id="firstname" autofocus>
                </div>
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" name="last_name" class="form-control" id="lastname">
                </div>
                <div class="form-group">
                  <label for="company">Company Name</label>
                  <input type="text" name="company" class="form-control" id="company">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" class="form-control" id="phone">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                  <label for="password_confirm">Company Name</label>
                  <input type="password" name="password_confirm" class="form-control" id="password_confirm">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
  </div>
</section>
