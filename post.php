<?php  
	
	require './config/config.php';
	require './config/db.php';

	$id = mysqli_real_escape_string($connection, filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

	//actual query
	$query = "SELECT * FROM posts WHERE id = $id";

	//performs query on selected database and returns a msqli_result object
	$result = mysqli_query($connection, $query);

	//var_dump($result);

	$post = mysqli_fetch_assoc($result);

	session_set_cookie_params(60 * 60, '/', 'localhost', false, true);

	session_start();

	$_SESSION['b']['title'] = $post['title'];
	$_SESSION['b']['author'] = $post['author'];
	$_SESSION['b']['body'] = $post['body'];

	//print_r($posts);

	//frees memory allocated associated with result
	mysqli_free_result($result);

	//closes the connection to the data base
	mysqli_close($connection);

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">
	<title>PHP BLOG</title>

	<style>

		.container{
			width: 80%;
			/* height: 100%; */
			margin: auto;
		}

		.container h1,h2,h3,h4,h5,h6{
			color: rgb(80,130,255);
		}

		.btn{
			padding: 10px 15px;
			text-decoration: none;
			display: inline-block;
		}

		.btn-default{
			color: black;
			background-color: rgb(253,253,253,0);
			border: 2px solid rgb(240,240,240);
			border-radius: 5px;
			margin: 5px 0;
			transition: box-shadow;
			transition-duration: 0.2s;
		}

		a.btn:visted{

		}

		.btn-default:hover{
			box-shadow: -1px -1px 2px lightblue,1px 1px 2px lightblue;
		}

		.back-btn{
			width: 30px;
			height: 30px;
			background-size: contain;
			background-image: url(./back3.png);
			display: inline-block;
		}

	</style>

</head>

	<body>

		<div class="container">

			<a href="<?php echo(ROOT_URL) ?>" class = ""><div class="back-btn"></div></a>

			<h1><?php echo $post['title']; ?></h1>

			<small> created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>

			<p><?php echo $post['body']; ?></p>
			
			<form action="update-post.php" method="POST">

				<input type="hidden" value="<?php echo $id; ?>" name="id">
				<input type="submit" name="edit" class="btn btn-default" value="Edit post">

			</form>

		</div>
		
	</body>

</html>