
<div class="login-box">
  <div class="login-logo">
      <span class="logo-lg">
        <b>C</b>eramics<b>K</b>art
      </span>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Forgot Password</p>
    <p class="login-box-msg">Please enter your Email so we can send you an email to reset your password.</p>

    <form action="/admin/forgot_password" method="post" accept-charset="utf-8">
      <div class="form-group has-feedback">
          <input type="text" name="identity" value="" id="identity" class="form-control" placeholder="Email" />
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    <a href="/admin/login">I have a login</a><br>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
