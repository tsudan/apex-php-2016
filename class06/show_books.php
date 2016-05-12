<html>
<head>
	<title>Books</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>
<body>
	<h2>Books</h2>

	<table class="table table-bordered">

	<?php
		$user = 'user';
		$pass = '12345';
		$host = '127.0.0.1';
		$database = 'apexweb';

		$conn = @mysqli_connect( $host, $user, $pass, $database )
				OR die( 'Connection Error: ' . mysqli_connect_error() );
		$query = "SELECT * FROM books";

		$query1 = "SELECT * FROM books INNER JOIN categories USING (category_id)";
		
		$query2 = "SELECT * FROM books INNER JOIN categories USING (category_id) INNER JOIN publishers USING (publisher_id)";
		
		$res = mysqli_query( $conn, $query2 );

		if( $res ) {

			while( $row = mysqli_fetch_array( $res, MYSQLI_ASSOC ) ) {

				$edit = "<a href='books.php?id={$row['book_id']}'>edit</a>";
				$delete = "<a href='delete_book.php?id={$row['book_id']}'>delete</a>";
				echo "<tr>"
						. "<td>{$row['book_name']}</td>"
						. "<td>{$row['book_author']}</td>"
						. "<td>{$row['book_price']}</td>"
						//. "<td>{$row['category_id']}</td>"
						. "<td>{$row['category_name']}</td>"
						//. "<td>{$row['publisher_id']}</td>"
						. "<td>{$row['publisher_name']}</td>"
						. "<td>{$row['isbn_number']}</td>"
						. "<td>{$row['published_year']}</td>"
						. "<td>{$row['book_description']}</td>"
						. "<td>$edit | $delete</td>"
					 .'<tr>';
			}
		}

		mysqli_close( $conn );
	?>
	</table>
</body>
</html>