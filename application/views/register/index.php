<div class="register-box">
<div class="register-box-body">
    <p class="login-box-msg">Register a new user</p>

    <form id="signupForm" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="username" name="username" placeholder="First and last name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input id="is_admin" name="is_admin" value="1" type="checkbox"> Grant this user admin priviledges?
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="submitSignup" class="btn btn-primary btn-block btn-flat">Create User</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
</div>
</div>
<style>
#signupForm label.error {
    margin-left: 10px;
    width: 75px;
    display: inline;
  }
</style>
<script>
  $.validator.setDefaults({
    submitHandler: function() {
      alert("submitted!");
    }
  });

  $().ready(function() {
    // validate the comment form when it is submitted
    $("#commentForm").validate();

    // validate signup form on keyup and submit
    $("#signupForm").validate({
      rules: {
        // firstname: "required",
        // lastname: "required",
        username: {
          required: true
        },
        password: {
          required: true,
          minlength: 6
        },
        confirm_password: {
          required: true,
          minlength: 6,
          equalTo: "#password"
        },
        email: {
          required: true,
          email: true
        }

      },
      messages: {
        firstname: "Please enter your firstname",
        lastname: "Please enter your lastname",
        username: {
          required: "Please enter a name"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long"
        },
        confirm_password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long",
          equalTo: "Password does not match"
        },
        email: "Please enter a valid email address"
      }
    });

    // propose username by combining first- and lastname
    $("#username").focus(function() {
      var firstname = $("#firstname").val();
      var lastname = $("#lastname").val();
      if (firstname && lastname && !this.value) {
        this.value = firstname + "." + lastname;
      }
    });

  });
  </script>

<script>
$(document).ready(function() {

  $("#submitSignup").click(function(e) { // if submit button is clicked
    e.preventDefault();
    var username = $("input#username").val();
    if (username == "") {
       $('.login-box-msg').html('<div class="alert alert-danger">Please enter the first and last name</div>');
       return false; // stop the script
    }
    var password = $("input#password").val();
    if (password == "") {
       $('.login-box-msg').html('<div class="alert alert-danger">Please enter the password</div>');
       return false; // stop the script
    }
    var email = $("input#email").val();
    if (email == "") {
       $('.login-box-msg').html('<div class="alert alert-danger">Please enter the email address</div>');
       return false; // stop the script
    }
    if( $('input#is_admin').prop('checked') )
    {
      var is_admin = '1';
    } else {
      var is_admin = '0';
    }

    $.ajax({
      type: "POST",
      url: '<?php echo base_url(); ?>register/signup_submit',
      data: 'username='+ username + '&password=' + password + '&email=' + email + '&is_admin=' + is_admin, // the data that will be sent to php processor
      dataType: "html",
      success: function(data) {
        if (data == 0) {
        $('.login-box-msg').html('<div class="alert alert-danger">Invalid login credentials</div>');
        } else {
        $('.login-box-msg').html('<div class="alert alert-success">Login successful.<br><a href="<?php echo base_url(); ?>dashboard">Click here</a> if your browser does not redirect you.</div>');
          document.location.href = '<?php echo base_url(); ?>dashboard';
        }
      }
    });
    return false;
  });
});
</script>