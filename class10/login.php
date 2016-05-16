<?php
	
	$title = 'Login';

	require_once( 'res/config.php' );
	require_once( 'res/functions.php' );

	include_once( 'res/inc/header.php' );

	$msg = '';

	if( $_SERVER[ 'REQUEST_METHOD'] == 'POST' ) {

		// form has been submitted

		if( empty( $_POST['email_address'] ) || empty( $_POST['password' ] ) ) {

			$msg = 'Enter both email address and password';
		}else {

			$email = $_POST['email_address'];
			$password = $_POST['password'];

			$result = validate_customer( $email, $password );

			if( $result ) {

				// user login success
				//print_r( $result );

				session_start();

				$_SESSION['email'] = $result[ 'email_address' ];
				$_SESSION['userid'] = $result['customer_id'];
				$_SESSION['first_name'] = $result['f_name'];
				$_SESSION['last_name'] = $result['l_name'];

				if( empty( $_POST['redir'] ) )
					header( 'Location: users/index.php' );
				else
					header( 'Location: users/' . $_POST['redir'] );

			}else {

				$msg = 'Could not validate the user';

			}
		}
	}

?>		
	<h3>Login</h3>

	<hr />
	
<?php
		if( $msg != '' ) {
			echo '<p class="alert alert-danger">';
			echo $msg;
			echo '</p>';
		}
?>
	<form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
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

		<?php
			if( ! empty( $_GET['redir'] ) ) {

				echo '<input type="hidden" name="redir" value="' . $_GET['redir'] . '" />';
			}
		?>
		<button type="submit" class="btn btn-primary col-sm-offset-2">Submit</button>
	</form>

	<div>
		<a href="register.php">Register</a>
	</div>
<?php
	
	include_once( 'res/inc/footer.php' );