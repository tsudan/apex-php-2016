<?php
	
	$title = 'Home';

	require_once( 'res/config.php' );
	require_once( 'res/functions.php' );

	include_once( 'res/inc/header.php' );

	$books = get_books();

	$c = 0;
	
	foreach( $books as $book ) {
		
		if( $c % 6 == 0 ) {
			if( $c != 0 ) {
				echo '</div>' . "\n" . '<hr />';
			}
			echo '<div class="row row_top_margin">';
		}
?>
		
		<div class="col-sm-2 book_item">
			<a href="book.php?id=<?= $book['id'] ?>">
				<img src="<?=APP_HOME_URL?>/img/thumb/<?=$book['book_image']?>" alt="<?=$book['book_name']?>" class="book_image" />
				<h3><?= $book['book_name'] ?></h3>
				<h4>Rs.<?= $book['price'] ?></h4>
			</a>
			<a class="buy" href="users/buy.php?id=<?=$book['id']?>">BUY</a>
		</div>

<?php 
		$c++;
	}

	if( $c % 6 != 0 ) {
		echo '</div>';
	}
?>
	
	

		
	
<?php
	include_once( 'res/inc/footer.php' );
?>