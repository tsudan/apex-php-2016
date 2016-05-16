<?php
	
	session_start();

	if( empty( $_SESSION ) )
		header( 'Location: ../login.php?redir=' . 'buy.php?' . $_SERVER['QUERY_STRING'] );

	$title = 'Home';

	require_once( '../res/config.php' );
	require_once( '../res/functions.php' );

	include_once( '../res/inc/header.php' );

	$res = get_books( " book_id={$_GET['id']}" );

	$book = $res[0];

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

		if( empty( $_POST['shipping_city'] ) || empty( $_POST['shipping_address'] ) || empty( $_POST['phone']) ) {
			echo 'All fields are required';
		}else {

			$city = $_POST['shipping_city'];
			$address = $_POST['shipping_address'];
			$phone = $_POST['phone'];

			$quantity = 1;

			if( ! empty( $_POST['quantity'] ) )
				$quantity = $_POST['quantity'];

			//var_dump( $_SESSION );

			$customer_id = $_SESSION['userid'];
			$book_id = $book['id'];

			$res = add_order( compact( 'city', 'address', 'phone', 'quantity', 'customer_id', 'book_id' ) );

			if( $res ) {

				$body = 'Dear ' . $_SESSION['first_name'] . '<br />'
							. '<p>Your order for ' . $book['book_name' ] . ' has been placed.</p><p>Thank you</p>';
				$email = array( 
						'from' => 'sales@bookstore.com',
						'from_name' => 'BookStore',
						'to' => $_SESSION['email'],
						'to_name' => $_SESSION['first_name'] . ' ' . $_SESSION['last_name'],
						'subject' => 'BookStore [Order has been placed]',
						'body' => $body
					);

				send_email( $email );

				echo '<p>Order placed successfully.</p><br /><a href="../index.php">Go back</a>';
			}else
				echo 'Could not place order';
		}
	}
?>
	
	<div class="row">

		<form class='form-horizontal' method="POST" action="">

			<div class="form-group">
				<label for="city" class="col-sm-2 control-label">Shipping City</label>
				<div class="col-sm-8">
					<input type="text" name="shipping_city" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label for="last_name" class="col-sm-2 control-label">Shipping Address</label>
				<div class="col-sm-8">
					<input type="text" name="shipping_address" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label for="phone" class="col-sm-2 control-label">Phone Number</label>
				<div class="col-sm-8">
					<input type="text" name="phone" size="10" maxlength="10" class="form-control" />
				</div>
			</div>
			
			<div class="form-group">
			    <label for="quantity" class="col-sm-2 control-label">Quantity</label>
			    <div class="col-sm-8">
			      <input type="text" size="3" maxlength="3" class="form-control" name="quantity" />
			    </div>
			</div>

			<div class="form-group">
				
				<button type="submit" class="btn btn-primary col-sm-offset-2">Submit</button>
			</div>

		</form>
	</div>
<?php

	include_once( '../res/inc/footer.php' );
?>