<?php
	
	require_once( '../res/config.php' );
	require_once( '../res/functions.php' );

	include_once( '../res/inc/header.php' );

?>		
	<h3>Add Book</h3>

	<hr />
		<?php

			$error = '';

			$title = '';
			$author = '';
			$category = '';
			$publisher = '';
			$price = '';
			$isbn = '';
			$published_on = '';
			$description = '';

			if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

				print_r( $_POST );

				// either add or edit

				if( empty( $_POST['id'] ) ) {

					// add new book

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
							

							$result = add_book( compact( 'title', 'author', 'category', 'isbn', 'price', 'publisher', 'published_on', 'description') );

							if( $result ) {
								echo 'Book inserted successfully.';
							}else {
								$error = 'Could not insert the data.';
							}
						}

					}else {
						//echo 'Values were empty';

						$error = 'Fields cannot be empty';
					}
				}else {

					// edit existing book

					$id = $_POST['id'];

					$title = $_POST['book_title'];
					$author = $_POST['book_authors'];
					$category = $_POST['category'];
					$isbn = $_POST['isbn'];
					$price = $_POST['price'];
					$publisher = $_POST['publisher'];
					$published_on = $_POST['published_on'];
					$description = $_POST['description'];

					$result = update_book( compact( 'id', 'title', 'author', 'category', 'isbn', 'price', 'publisher', 'published_on', 'description') );

					if( $result ) {
						echo 'Book updated successfully.';
					}else {
						$error = 'Could not update the book data.';
					}

				}
			}else if( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ){

				// in case of get method

				if( ! empty( $_GET['id'] ) && ! empty( $_GET['action'] ) ) {
				
					$id = $_GET['id'];
					$action = $_GET['action'];

					if( $action == 'edit' ) {
						
						// requesting to edit, display edit form
						
						$where = "book_id=$id";

						$book_edit = get_books( $where );

						if( $book_edit ) {

							$row = $book_edit[0];

							$title = $row['book_name'];
							$author = $row['author'];
							$price = $row['price'];
							$category = $row['category_id'];
							$publisher = $row['publisher_id'];
							$isbn = $row['isbn'];
							$published_on = $row['published_year'];
							$description = $row['book_description'];
							
						}
					}else {

						// requesting delete

						$res = delete_book( $id );

						if( $res ) {
							echo 'Success';
						}else {
							$error = 'Could not delete data.';
						}
					}
				}
			}
			

			if( $error != '' )
				echo "<p class='text-danger'>{$error}</p><hr />";
		?>

		<form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
			<div class="form-group">
				<label for="book_title" class="col-sm-2 control-label">Book Title</label>
				<div class="col-sm-8">
					<input type="text" name="book_title" class="form-control" value='<?= $title ?>' />
				</div>
			</div>
			
			<div class="form-group">
			    <label for="book_authors" class="col-sm-2 control-label">Author(s)</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" name="book_authors" value='<?= $author ?>'>
			    </div>
			</div>

			<div class="form-group">
			    <label for="category" class="col-sm-2 control-label">Category</label>
			    <div class="col-sm-8">
			      <select name="category" class="form-control">
			      	<option value="">-- SELECT CATEGORY --</option>
			      	<option value="1">C Programming</option>
			      	<option value="2">C++ Programming</option>
			      	<option value="3">C# Programming</option>
			      	<option value="4">Java Programming</option>
			      	<option value="5">HTML</option>
			      </select>
			    </div>
			</div>

			<div class="form-group">
			    <label for="isbn" class="col-sm-2 control-label">ISBN Number</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" name="isbn" value='<?= $isbn ?>'>
			    </div>
			</div>

			<div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Price (NRs)</label>
			    <div class="col-sm-2">
			      <input type="text" class="form-control" name="price" value='<?= $price ?>'>
			    </div>
			</div>

			<div class="form-group">
			    <label for="publisher" class="col-sm-2 control-label">Publisher</label>
			    <div class="col-sm-8">
			      	<select name="publisher" class="form-control">
				      	<option value="">-- SELECT PUBLISHER --</option>
				      	<?php
				      		$publishers = array(
				      				'1' 	=> "O'Reilly",
				      				'2'		=> 'Wiley',
				      				'3'		=> 'Wrox',
				      				'4'		=> 'Tata McGraw Hill',
				      				'5'	=> 'Pearson'
				      			);

				      		foreach( $publishers as $key=>$val ) {

				      			echo "<option value='$key'>$val</option>\n";
				      		}
				      	?>
			      	</select>
			    </div>
			</div>

			<div class="form-group">
			    <label for="published_year" class="col-sm-2 control-label">Published On</label>
			    <div class="col-sm-8">
			      	<select name="published_on" class="form-control">
				      	<option value="">-- SELECT PUBLISHED YEAR --</option>
				      	<?php
				      		$years = range( 1970, 2016 );

				      		foreach( $years as $year ) {
				      			$sel = '';
				      			//echo $year . ' ' . $published_on;

				      			if( $year == $published_on ) {
				      				$sel = 'selected="selected"';
				      			}
				      			echo "<option value='$year' $sel>$year</option>\n";
				      		}
				      	?>
			      	</select>
			    </div>
			</div>

			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-8">
			      	<div class="checkbox">
				        <label>
				          	<input type="checkbox" name="available" value="1"> Is Available?
				        </label>
			      	</div>
			    </div>
			</div>

			<div class="form-group">
			    <label for="published_year" class="col-sm-2 control-label">Description</label>
			    <div class="col-sm-8">
			      	<textarea class="form-control" rows="4" name="description"><?= $description ?></textarea>
			    </div>
			</div>

			<!--
			<div>
				<input type="checkbox" name="fruit[]" value="apple" />Apple<br />
				<input type="checkbox" name="fruit[]" value="orange" />Orange<br />
				<input type="checkbox" name="fruit[]" value="grape" />Grape<br />
				<input type="checkbox" name="fruit[]" value="guava" />Guava<br />
				<input type="checkbox" name="fruit[]" value="lemon" />Lemon<br />
			</div>
			<div>
				<input type="radio" name="cover" value="paperback">Paperback<br />
				<input type="radio" name="cover" value="hardcover">Hardcover<br />
			<div>
			-->
			<?php
				if( ! empty( $_GET['id'] ) ) {
			?>
					<input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
			<?php		
				}
			?>
			<button type="submit" class="btn btn-primary col-sm-offset-2">Submit</button>
		</form>

		<hr />

		<?php

			$books = get_books();

			if( count( $books ) > 0 ) {
		?>

				<table class="table table-bordered">
		<?php
				foreach( $books as $book ) {
					$edit = "<a href='books.php?action=edit&id={$book['id']}'>edit</a>";
					$delete = "<a href='books.php?action=delete&id={$book['id']}'>delete</a>";
					echo "<tr>"
							. "<td>{$book['book_name']}</td>"
							. "<td>{$book['author']}</td>"
							. "<td>{$book['price']}</td>"
							//. "<td>{$row['category_id']}</td>"
							. "<td>{$book['category_name']}</td>"
							//. "<td>{$row['publisher_id']}</td>"
							. "<td>{$book['publisher_name']}</td>"
							. "<td>{$book['isbn']}</td>"
							. "<td>{$book['published_year']}</td>"
							. "<td>{$book['book_description']}</td>"
							. "<td>$edit | $delete</td>"
						 .'<tr>';
				}
			?>
				</table>
			<?php

			}else {

			}

		?>
<?php
	
	include_once( '../res/inc/footer.php' );
	