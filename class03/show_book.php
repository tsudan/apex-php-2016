<html>
<head>
	<title>Books</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>
<body>

	<div class="container">
		
		<h3>Book Info</h3>

		<pre>
			<?php print_r( $_POST ); ?>
		</pre>

		<?php
			/*
			if( empty( $_POST['fruit'] ) ) {
				echo 'Empty fruits';
			}else {
				var_dump( $_POST['fruit'] );
			}

			if( empty( $_POST['cover']) )
				echo '<br />Empty cover';
			else
				var_dump($_POST['cover']);
			*/

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

					if( empty( $_POST['available']) )
						$availability = 0;
					else
						$availability = 1;
		?>

					<div>
						<h2><?= $title ?></h2>
						<div>
							<?php
								echo ucfirst($publisher) . ' ' . $published_on
									. '<br />' . $author . '<br />' . strtoupper($category);

								if( $availability )
									echo '<br />In Stock';
							?>
						</div>
					</div>
		<?php
				}

			}else {
				//echo 'Values were empty';

				header( 'Location: books.php?e=Fields cannot be empty' );
			}
			
			
		?>
	</div>

</body>
</html>