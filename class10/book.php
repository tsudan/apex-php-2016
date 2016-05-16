<?php
	
	$title = 'Home';

	require_once( 'res/config.php' );
	require_once( 'res/functions.php' );

	if( empty( $_GET['id'] ) ) 
		header( 'Location: index.php' );

	$result = get_books( ' book_id=' . $_GET['id'] );

	$book = $result[0];

	/*if( empty( $book ) )
		header( 'Location: index.php' );*/

	include_once( 'res/inc/header.php' );	

	//var_dump( $book ); 
?>
	
	<div class="row book_details">
		
		<h3><?= $book['book_name'] ?></h3>
		<hr />
			
		<div class="book_image">
			<img src="<?=APP_HOME_URL?>/img/thumb/<?=$book['book_image']?>" alt="<?=$book['book_name']?>" class="book_image" />

			<hr />
			<h4>Rs.<?= $book['price'] ?></h4>
			<a class="buy" href="users/buy.php?id=<?=$book['id']?>">BUY</a>
		</div>
		
		<div class="book_info">	
			
			<p><?= $book['book_description'] ?></p>
			<ul>
				<li><strong>Author:</strong> <?= $book['author'] ?></li>
				<li><strong>Category:</strong> <?= $book['author'] ?></li>
				<li><strong>Published:</strong> <?= $book['published_year'] ?></li>
		</div>
		
	</div>
<?php
	
	include_once( 'res/inc/footer.php' );