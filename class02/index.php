<?php

	// this is single line comment
	
	/* this is a comment
		that spans multiple lines */

	# this is also a single line comment

	$integer_type = 100;
	$decimal_type = 100.50;
	$string_type = 'Hello';
	$string_2_type = "Ramesh";
	$bool_type = false;

	$msg = $string_type . ' ' . $string_2_type;

	$msg2 = "$string_type $string_2_type";

	echo $integer_type;
	echo '\n';
	echo $decimal_type;
	echo "\n";
	echo $string_type;
	echo '<br />';
	echo $string_2_type;
	echo '<br />';
	echo $bool_type;
	echo $msg;
	echo $msg2;

	echo '<pre>';
	print_r($_SERVER);
	echo '</pre>';

	echo '<pre>';
	print_r($_POST);
	echo '</pre>';

	$n1 = 100;
	$n2 = 200;

	echo $n1 + $n2;
	echo "\n";
	echo $n1 - $n2;
	echo "\n";
	echo $n1 * $n2;
	echo "\n";
	echo $n1 / $n2;
	echo "\n";
	echo $n1 % $n2;
	echo "\n";


?>