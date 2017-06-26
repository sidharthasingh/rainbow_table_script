<?php
	// error_reporting(0);
	define('PASSWORD_MAX_LEN',3); // The maximum length of the combination to be tried
	define("TRY_ALL", true);  // To try all lengths from 1 to PASSWORD_MAX_LEN or not
	define("TO_JSON",true);

	// remove according to usage.
	$token = array('a','A','1'); // What to be included in the combinations : 
	/*
		'a' : small alphabets
		'A' : capital alphabets
		'1' : numbers
		'*' : all the 256 characters
	*/

	require("combination.php");

	echo "Script started . . .\n";

	start_build();

	echo "Script ended . . .\n";

?>