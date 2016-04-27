<html>
<head>
	<title>Books</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>
<body>

	<div class="container">
		
		<?php
			if( ! empty( $_POST['book_title'] ) && ! empty( $_POST['book_authors'] )
				&& ! empty( $_POST['category'] ) && ! empty( $_POST['isbn'] )
				&& ! empty( $_POST[ 'price' ] ) && ! empty( $_POST[ 'publisher'] )
				&& ! empty( $_POST[ 'published_on' ] ) && ! empty( $_POST[ 'description'] ) ) {

				if( ! is_numeric( $_POST['price']) ) {
					//echo 'Price should be a number';
					header( 'Location: books.php?e=Price should be a number' );
				}else {

					$title = $_POST['book_title'];
					$author = $_POST['book_authors'];
					$category = $_POST['category'];
					$isbn = $_POST['isbn'];
					$price = $_POST['price'];
					$publisher = $_POST['publisher'];
					$published_on = $_POST['published_on'];
					$description = $_POST['description'];

					//$category = 4;
					//$publisher = 3;

					if( empty( $_POST['available']) )
						$availability = 0;
					else
						$availability = 1;
					

					$user = 'user';
					$pass = '12345';
					$host = '127.0.0.1';
					$database = 'apexweb';

					$conn = @mysqli_connect( $host, $user, $pass, $database )
								OR die( 'Connection error ' . mysqli_connect_error() );

					$query = "INSERT INTO books(book_name,book_author,book_price,book_category_id,publisher_id,book_description,isbn_number,published_year) "
							. "VALUES('$title', '$author', '$price','$category','$publisher','$description','$isbn','$published_on')";

					//echo $query;

					$result = @mysqli_query( $conn, $query );

					if( $result ) {
						echo 'Book inserted successfully.';
					}else {
						echo 'Could not insert the data.';
					}

					mysqli_close( $conn );
				}

			}else {
				//echo 'Values were empty';

				header( 'Location: books.php?e=Fields cannot be empty' );
			}
			
			
		?>
	</div>

</body>
</html>