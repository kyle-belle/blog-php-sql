<?php 
	
	require './config/config.php';
	require './config/db.php';

	if(isset($_POST['delete'])){
		$id = mysqli_real_escape_string($connection, $_POST['id']);

		//actual query
		$query = 'DELETE FROM posts WHERE id = ' . $id . ';';

		//performs query on selected database and returns a msqli_result object
		if(mysqli_query($connection, $query)){
			header('location: ' . ROOT_URL);
		}

		//var_dump($result);

		//$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

		//print_r($posts);

		//frees memory allocated associated with result
		//mysqli_free_result($result);

		//closes the connection to the data base
		mysqli_close($connection);

	}
?>