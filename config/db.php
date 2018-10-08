<?php 
	
	function echo_n($value='')
	{
		echo "$value <br>";
	}

	# CREATE CONNECTION
	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if(mysqli_connect_errno()){
		echo_n ("failed to connetct to database :" . mysqli_connect_error());
	}

?>