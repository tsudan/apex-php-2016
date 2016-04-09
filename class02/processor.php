<?php
	
	print '<pre>';
	print_r( $_POST );
	print '</pre>';

	$title = $_POST[ 'title' ];
	$category = $_POST[ 'category' ];
    $author = $_POST[ 'author' ];
    $isbn = $_POST[ 'isbn' ];
    $price = $_POST[ 'price' ];
    $publisher = $_POST[ 'publisher' ];
    $published_on = $_POST[ 'published_on' ];
    $action = $_POST[ 'action' ];

    echo "$title \n $category \n $author \n $isbn \n$price \n$publisher \n$published_on \n$action";
?>