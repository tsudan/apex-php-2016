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
				$book_image = $row['book_image'];

				$data[] = compact( "id", "book_name", "author", "price", 
					"category_id", "category_name",
					"publisher_id", "publisher_name",
					"isbn", "published_year", "book_description", "book_image" );
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

		
		//echo $query;

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

	// validate user

	function validate_user( $email, $password ) {

		$conn = connect_db();

		$query = "SELECT * FROM users WHERE email_address='$email' AND password=MD5('$password')";

		echo $query;

		$res = @mysqli_query( $conn, $query );

		$data = array();

		if( $res ) {

			/*while( $row = @mysqli_fetch_array( $res, MYSQLI_ASSOC ) ) {

				$data['email_address'] = $row[]
			}*/

			$data = @mysqli_fetch_array( $res, MYSQLI_ASSOC );

		}

		close_db( $conn );

		return $data;
	}

	function register_user( $user ) {

		$conn = connect_db();

		$query = "INSERT INTO customers(f_name, l_name, email_address, password) VALUES( '{$user['first_name']}', '{$user['last_name']}', '{$user['email_address']}', MD5('{$user['password']}') )";

		echo $query;

		$result = @mysqli_query( $conn, $query );

		close_db( $conn );

		return $result;
	}

	// validate user

	function validate_customer( $email, $password ) {

		$conn = connect_db();

		$query = "SELECT * FROM customers WHERE email_address='$email' AND password=MD5('$password')";

		//echo $query;

		$res = @mysqli_query( $conn, $query );

		$data = array();

		if( $res ) {

			/*while( $row = @mysqli_fetch_array( $res, MYSQLI_ASSOC ) ) {

				$data['email_address'] = $row[]
			}*/

			$data = @mysqli_fetch_array( $res, MYSQLI_ASSOC );

		}

		close_db( $conn );

		return $data;
	}

	function get_last_added_book_id() {

		$conn = connect_db();

		$query = "SELECT book_id FROM books ORDER BY book_id DESC LIMIT 1";

		$res = @mysqli_query( $conn, $query );

		if( $res ) {
			$data = @mysqli_fetch_array( $res, MYSQLI_ASSOC );

			return $data['book_id'];

		}else {
			return 0;
		}

	}

	// upload book
	function upload_book( $book, $book_name, $book_id ) {

		$book_name = str_replace( ' ', '_', $book_name );

		//echo $book_name;

		$file_err = array();

		$image_name = $book['name'];
        $image_size = $book['size'];
        $image_file_tmp = $book['tmp_name'];
        $image_type = $book['type'];

        $pieces = explode('.', $book['name']);

        $image_file_ext = strtolower(end($pieces));

        $allowed_ext = array('jpg', 'jpeg', 'png');

        if (in_array($image_file_ext, $allowed_ext) === false) {
            $file_err[] = "Image type not allowed. Please upload JPG or PNG Image";
        }

        if ($image_size > 2097152) { // greater than 2mb
            $file_err[] = "File size cannot be more than 2MB";
        }

        if (empty($file_err) == true) {
            move_uploaded_file( $image_file_tmp, FILE_SAVE_LOCATION . $book_name);

            $conn = connect_db();

		    $query = "UPDATE books SET book_image='$book_name' WHERE book_id=$book_id";

		    $r = @mysqli_query( $conn, $query );

		    close_db( $conn );

            return $r;
        }else {
        	
        	return false;
        }
	}

	function add_order( $order ) {

		$conn = connect_db();

		$query = "INSERT INTO orders(customer_id, book_id, shipping_city, shipping_address, phone_number, ordered_date, order_status, order_quantity) VALUES( {$order['customer_id']}, {$order['book_id']}, '{$order['city']}', '{$order['address']}', '{$order['phone']}', NOW(), 1, {$order['quantity']})";

		//echo $query;

		$result = @mysqli_query( $conn, $query );

		close_db( $conn );

		return $result;
	}

	function get_orders( $filter = '' ) {

		$conn = connect_db();

		$query = "SELECT * FROM orders INNER JOIN books USING (book_id) INNER JOIN customers USING (customer_id) ORDER BY order_status, ordered_date DESC";

		$result = @mysqli_query( $conn, $query );

		$data = array();

		if( $result ) {

			while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {

				$customer_id = $row['customer_id'];
				$book_id = $row['book_id'];
				$customer_name = $row['f_name'] . ' ' . $row['l_name'];
				$book_name = $row['book_name'];
				$email = $row['email_address'];
				$quantity = $row['order_quantity'];
				$price = $row['book_price'] * $quantity;
				$book_image = $row['book_image'];
				$address = $row['shipping_city'] . ',<br />' . $row['shipping_address'];
				$phone = $row['phone_number'];
				$order_date = $row['ordered_date'];
				$order_status = $row['order_status'];

				$data[] = compact( 'customer_id', 'customer_name', 'book_id', 'book_name', 'email', 'quantity', 'price', 'book_image', 'address', 'phone', 'order_date', 'order_status' );
			}
		}

		close_db( $conn );

		return $data;

	}

	function send_email( $email ) {
		//var_dump( $email );

		require_once('../res/lib/phpmailer/class.smtp.php');
		require_once('../res/lib/phpmailer/class.phpmailer.php');
		
		$mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch

		$mail->IsSMTP(); // telling the class to use SMTP
	
		$mail->SMTPDebug  = 0;      // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;   // enable SMTP authentication
		$mail->SMTPSecure = "tls";  // sets the prefix to the servier
		$mail->Host       = GMAIL_SMTP_HOST;      // sets GMAIL as the SMTP server
		$mail->Port       = 587; 	// set the SMTP port for the GMAIL server
		$mail->Username   = GMAIL_EMAIL;  		// GMAIL username
		$mail->Password   = GMAIL_PASSWORD;     // GMAIL password
	  

	  	//Set who the message is to be sent from
		$mail->setFrom($email['from'], $email['from_name']);
		//Set who the message is to be sent to
		$mail->addAddress($email['to'], $email['to_name']);

		//Set the subject line
		$mail->Subject = $email['subject'];
		//Read an HTML message body from an external file, convert referenced images to embedded,
		
		$mail->Body    = $email['body'];
		$mail->isHTML(true); 	// Set email format to HTML

		if (! $mail->send() ) {
		    echo $mail->ErrorInfo;
		    return false;
		} else {
		    return true;
		}
	}
