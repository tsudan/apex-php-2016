<?php

	
	$dates = range(1,31);

	echo 'Day: <select>';
	echo '<option>--DAYS--</option>';

	for( $i=0; $i<count($dates);$i++) {
		echo '<option>' . $dates[$i] . '</option>';
	}
	echo '</select>';

	echo '<br />';
	// year
	$year = range(1970,2010);

	echo 'Year: <select>';
	echo '<option>--YEAR--</option>';

	for( $i=0; $i<count($year);$i++) {
		echo '<option>' . $year[$i] . '</option>';
	}
	echo '</select>';
?>