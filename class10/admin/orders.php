<?php
	
	$title = 'Books';
	
	require_once( '../res/config.php' );
	require_once( '../res/functions.php' );

	include_once( '../res/inc/header.php' );

	session_start();

	if( empty( $_SESSION['userid'] ) ) {

		header( 'Location: logout.php' );
	}

	//print_r( $_SESSION );

	$orders = get_orders();

	//var_dump( $orders );

	if( ! empty( $orders ) ) {
		$sn = 1;
?>

		<table class="table table-bordered table-striped">
			<tr>
				<td>S.N.</td>
				<td>Book</td>
				<td>Customer</td>
				<td>Email</td>
				<td>Quantity</td>
				<td>Total Price</td>
				<td>Shipping Addr.</td>
				<td>Phone</td>
				<td>Ordered On</td>
				<td>Status</td>
			</tr>
<?php
		foreach( $orders as $order ) {
?>

			<tr>
				<td><?= $sn++ ?></td>
				<td>
					<img src="<?= APP_HOME_URL . '/img/thumb/' . $order['book_image'] ?>" alt="<?= $order['book_name'] ?>" class="book_thumb" /><br />
					<?= $order['book_name'] ?></td>
				<td><?= $order['customer_name'] ?></td>
				<td><?= $order['email'] ?></td>
				<td><?= $order['quantity'] ?></td>
				<td>Rs. <?= $order['price'] ?></td>
				<td><?= $order['address'] ?></td>
				<td><?= $order['phone'] ?></td>
				<td><?= $order['order_date'] ?></td>
				<td><?= $order['order_status'] ?></td>
			</tr>
<?php
		}
?>
		</table>

<?php
	}else {
		echo 'No orders yet';
	}
?>

<?php
	include_once( '../res/inc/footer.php' );
?>