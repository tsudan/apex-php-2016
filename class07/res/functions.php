<?php
	
	// database connection initiate and close
	function connect_db() {

		$conn = @mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME )
				OR die( 'Connection Error: ' . mysqli_connect_error() );
		
		return $conn;
	}

	function close_db( $conn ) {

		mysqli_close( $conn );

	}


	// get books

	function get_books( $where = '' ) {

		$conn = connect_db();

		$query = "SELECT * FROM books INNER JOIN categories USING (category_id) INNER JOIN publishers USING (publisher_id)";
		
		if( $where != '' )
			$query .= " WHERE $where";

		$query .= ' ORDER BY book_name';

		//echo $query;

		$res = @mysqli_query( $conn, $query );

		$data = array();

		if( $res ) {

			while( $row = mysqli_fetch_array( $res, MYSQLI_ASSOC ) ) {

				$id = $row['book_id'];
				$book_name = $row['book_name'];
				$author = $row['book_author'];
				$price = $row['book_price'];
				$category_id = $row['category_id'];
				$category_name = $row['category_name'];
				$publisher_id = $row['publisher_id'];
				$publisher_name = $row['publisher_name'];
				$isbn = $row['isbn_number'];
				$published_year = $row['published_year'];
				$book_description = $row['book_description'];

				$data[] = compact( "id", "book_name", "author", "price", 
					"category_id", "category_name",
					"publisher_id", "publisher_name",
					"isbn", "published_year", "book_description" );
			}
		}

		close_db( $conn );

		return $data;
	}

	// add book

	function add_book( $book ) {

		//print_r( $book );

		$conn = connect_db();

		$query = "INSERT INTO books(book_name,book_author,book_price,category_id,publisher_id,book_description,isbn_number,published_year) "
				. "VALUES('{$book['title']}', '{$book['author']}', '{$book['price']}','{$book['category']}','{$book['publisher']}','{$book['description']}','{$book['isbn']}','{$book['published_on']}')";

		
		$result = @mysqli_query( $conn, $query );

		close_db( $conn );

		return $result;
	}

	// update book

	function update_book( $book ) {

		$conn = connect_db();


		$query = "UPDATE books SET book_name='${book['title']}', book_author='${book['author']}', book_price='${book['price']}', category_id=${book['category']}, publisher_id=${book['publisher']}, book_description='${book['description']}', isbn_number='${book['isbn']}', published_year='${book['published_on']}' WHERE book_id=${book['id']}";

		//echo $query;

		$res = @mysqli_query( $conn, $query );
		
		close_db( $conn );
		
		return $res;
	}

	// delete book

	function delete_book( $id ) {

		$conn = connect_db();

		$query = "DELETE FROM books WHERE book_id=$id";

		$res = @mysqli_query( $conn, $query );

		close_db( $conn );

		return $res;
	}
