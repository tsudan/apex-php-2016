<html>
<head>
	<title>Books</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>
<body>

	<div class="container">
		
		<h3>Add Book</h3>

		<hr />
			<?php
				if( ! empty( $_GET['e']) )
					echo "<p class='text-danger'>{$_GET['e']}</p><hr />";
			?>

			<form class="form-horizontal" method="post" action="show_book.php">
				<div class="form-group">
					<label for="book_title" class="col-sm-2 control-label">Book Title</label>
					<div class="col-sm-8">
						<input type="text" name="book_title" class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
				    <label for="book_authors" class="col-sm-2 control-label">Author(s)</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" name="book_authors">
				    </div>
				</div>

				<div class="form-group">
				    <label for="category" class="col-sm-2 control-label">Category</label>
				    <div class="col-sm-8">
				      <select name="category" class="form-control">
				      	<option value="">-- SELECT CATEGORY --</option>
				      	<option value="c">C Programming</option>
				      	<option value="cpp">C++ Programming</option>
				      	<option value="csharp">C# Programming</option>
				      	<option value="java">Java Programming</option>
				      	<option value="html">HTML</option>
				      </select>
				    </div>
				</div>

				<div class="form-group">
				    <label for="isbn" class="col-sm-2 control-label">ISBN Number</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" name="isbn">
				    </div>
				</div>

				<div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Price (NRs)</label>
				    <div class="col-sm-2">
				      <input type="text" class="form-control" name="price">
				    </div>
				</div>

				<div class="form-group">
				    <label for="publisher" class="col-sm-2 control-label">Publisher</label>
				    <div class="col-sm-8">
				      	<select name="publisher" class="form-control">
					      	<option value="">-- SELECT PUBLISHER --</option>
					      	<?php
					      		$publishers = array(
					      				'oreilly' 	=> "O'Reilly",
					      				'wiley'		=> 'Wiley',
					      				'wrox'		=> 'Wrox',
					      				'tmh'		=> 'Tata McGraw Hill',
					      				'pearson'	=> 'Pearson'
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

					      			echo "<option value='$year'>$year</option>\n";
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
				      	<textarea class="form-control" rows="4" name="description"></textarea>
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

				<button type="submit" class="btn btn-primary col-sm-offset-2">Submit</button>
			</form>
	</div>
</body>
</html>