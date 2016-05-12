<?php
	
	$title = 'Register';

	require_once( 'res/config.php' );
	require_once( 'res/functions.php' );

	include_once( 'res/inc/header.php' );

	$msg = '';
	$cls = '';

	if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

		// form has been submitted

		if( empty( $_POST['first_name'] ) || empty( $_POST['last_name']) || empty( $_POST['email_address']) || empty( $_POST['password']) || empty( $_POST['repassword'])) {

			$msg = 'All fields are required';
			$cls = 'alert alert-danger';
		}else {

			$password = $_POST['password'];
			$repass = $_POST['repassword'];

			if( $password == $repass ) {
				// both passwords match

				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$email_address = $_POST['email_address'];

				$result = register_user( compact( 'first_name', 'last_name', 'email_address', 'password' ) );

				if( $result ) {
					$msg = 'Registration was successful.';
					$cls = 'alert alert-success';
				}else {
					$msg = 'Could not complete the registration';
					$cls = 'alert alert-danger';
				}
			}else {

				$msg = 'Both passwords should match';
				$cls = 'alert alert-danger';
			}
		}
	}
?>
	<h3>Register</h3>

	<hr />
<?php
		if( $msg != '' ) {
			echo '<p class="' . $cls . '">';
			echo $msg;
			echo '</p>';
		}
?>
	<form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">

		<div class="form-group">
			<label for="first_name" class="col-sm-2 control-label">First Name</label>
			<div class="col-sm-8">
				<input type="text" name="first_name" class="form-control" />
			</div>
		</div>

		<div class="form-group">
			<label for="last_name" class="col-sm-2 control-label">Last Name</label>
			<div class="col-sm-8">
				<input type="text" name="last_name" class="form-control" />
			</div>
		</div>

		<div class="form-group">
			<label for="email_address" class="col-sm-2 control-label">Email Address</label>
			<div class="col-sm-8">
				<input type="text" name="email_address" class="form-control" />
			</div>
		</div>
		
		<div class="form-group">
		    <label for="password" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-8">
		      <input type="password" class="form-control" name="password" />
		    </div>
		</div>

		<div class="form-group">
		    <label for="repassword" class="col-sm-2 control-label">Retype Password</label>
		    <div class="col-sm-8">
		      <input type="password" class="form-control" name="repassword" />
		    </div>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary col-sm-offset-2">Submit</button>
		</div>
	</form>

<?php
	
	include_once( 'res/inc/footer.php' );