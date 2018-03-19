<script>
$(document).ready(function() {

  $("#submit_login").click(function(e) { // if submit button is clicked
    e.preventDefault();
    var username = $("input#username").val();
    if (username == "") {
       $('.login-box-msg').html('<div class="alert alert-danger">Please enter your username or email</div>');
       return false; // stop the script
    }
    var password = $("input#password").val();
    if (password == "") {
       $('.login-box-msg').html('<div class="alert alert-danger">Please enter your password</div>');
       return false; // stop the script
    }

    $.ajax({
      type: "POST",
      url: '<?php echo base_url(); ?>login/validate',
      data: 'username='+ username + '&password=' + password,
      dataType: "html",
      success: function(data) {
        if (data == 0 || data == 'Invalid login credentials' || data == 'Password does not match record found for this user') {
          $('#login-msg-box').removeClass("login-box-msg").addClass("alert alert-danger text-center");
        $('#login-msg-box').load("<?php echo base_url(); ?>login/validate");
        return false;
        } else {
        $('.login-box-msg').html('<div class="alert alert-success">Login successful.<br><a href="<?php echo base_url(); ?>dashboard">Click here</a> if your browser does not redirect you.</div>');
          document.location.href = '<?php echo base_url(); ?>dashboard/index';
        }
      }
    });
    return false;
  });
});
</script>

<?php
	/**
	 * Password reset form was submitted and successfully completed
	 */
	if (strpos($_SERVER['REQUEST_URI'], 'login/password_reset_complete'))
	{
	?>

<section class="container">
  <div class="row">
    <?php echo '<h1>Password successfully reset</h1>'; ?>
    <!-- LOGIN -->
    <div>
      <h2><small>You may now login with your new password</small></h2>
        <form method="post">
    <!-- LOGIN -->
    <div class="login-box-body">
    <p class="login-box-msg"><h4>Sign in to start your session</h4></p>

      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Email or Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="submit_login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    </div>
</div></section>
<?php
	}
	else
	{
		// Previous login attempt failed
	?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="row">
    <form method="post">
    <!-- LOGIN -->
    <div class="login-box-body">
    <p id="login-msg-box" class="login-box-msg">Sign in to start your session</p>

      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Email or Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="submit_login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <a href="#">I forgot my password</a><br>
    <a href="<?php echo base_url(); ?>register" class="text-center">Register a new user</a>

  </div>

<?php
	if (strpos($_SERVER['REQUEST_URI'], 'login/?error'))
		{

			echo '<div class="alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Error: </strong>Email or password incorrect</div>';
	}
	?>      </form>
    <!-- /LOGIN -->

  </div>
<?php }?>