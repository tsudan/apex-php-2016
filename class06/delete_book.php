<?php
	
	if( ! empty( $_GET['id'] ) ) {

		$id = $_GET['id'];

		$user = 'user';
		$pass = '12345';
		$host = '127.0.0.1';
		$database = 'apexweb';

		$conn = @mysqli_connect( $host, $user, $pass, $database )
				OR die( 'Connection Error: ' . mysqli_connect_error() );

		$query = "DELETE FROM books WHERE book_id=$id";

		$res = mysqli_query( $conn, $query );

		if( $res ) {
			echo 'Data deleted successfully';
		}else {
			echo 'Could not delete the data.';
		}

		mysqli_close( $conn );
	}
?>