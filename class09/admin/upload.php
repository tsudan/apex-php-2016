<?php
	
	$title = 'Upload';
	
	require_once( '../res/config.php' );
	require_once( '../res/functions.php' );

	session_start();

	if( empty( $_SESSION['userid'] ) ) {

		header( 'Location: logout.php' );
	}


	if( empty( $_GET['action']) || empty( $_GET['id'] ) ) {

		header( 'Location: books.php' );
	}else {

		if( $_SERVER[ 'REQUEST_METHOD'] == 'POST' ) {
			if( empty( $_POST['nonce'] ) ) {
				
				header( 'Location: books.php' );
			
			}else {

				if (isset($_FILES['book_image'])) {

					$book = get_books( " book_id={$_GET['id']}" );

					//print_r( $book );

					$book_name = $book[0]['book_name'] . '_' . $book[0]['isbn'];
					
					$res = upload_book( $_FILES['book_image'], $book_name, $book[0]['id'] );

					if( $res ) {
						header( 'Location: books.php?e=Book inserted successfully.' );
					}else {
						echo 'Could not upload the book image';
					}

				}

			}
		}
	}

	include_once( '../res/inc/header.php' );

?>
	
	<h2>Upload File</h2>

	<form class="form-horizontal"  method="POST" action="" enctype="multipart/form-data">

		<div class="form-group">
		    <label for="image" class="col-sm-2 control-label">Upload Image</label>
		    <div class="col-sm-8">
		      <input type="file" class="form-control" name="book_image">
		    </div>
		</div>

		<div class="form-group">

			<input type="hidden" name="nonce" value="<?= md5( session_id() ) ?>" />

			<button type="submit" class="btn btn-primary col-sm-offset-2">Submit</button>
		</div>
	</form>

<?php
	include_once( '../res/inc/footer.php' );
?>