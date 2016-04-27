<?php
	
	if( ! empty( $_POST['id'] ) ) {

		$id = $_POST['id'];

		$user = 'user';
		$pass = '12345';
		$host = '127.0.0.1';
		$database = 'apexweb';

		$conn = @mysqli_connect( $host, $user, $pass, $database )
				OR die( 'Connection Error: ' . mysqli_connect_error() );

		
		$title = $_POST['book_title'];
		$author = $_POST['book_authors'];
		$category = $_POST['category'];
		$isbn = $_POST['isbn'];
		$price = $_POST['price'];
		$publisher = $_POST['publisher'];
		$published_on = $_POST['published_on'];
		$description = $_POST['description'];

		$query = "UPDATE books SET book_name='$title', book_author='$author', book_price='$price', category_id=2, publisher_id=1, book_description='$description', isbn_number='$isbn', published_year='$published_on' WHERE book_id=$id";

		//echo $query;

		$res = mysqli_query( $conn, $query );

		if( $res ) {
			echo 'Data updated successfully.';
		}else {
			echo 'Data could not be updated.';
		}

		mysqli_close( $conn );
	}
?>