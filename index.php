<?php  
	
	require './config/config.php';
	require './config/db.php';

	//actual query
	$query = 'SELECT * FROM posts';

	//performs query on selected database and returns a msqli_result object
	$result = mysqli_query($connection, $query);

	//var_dump($result);

	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

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

		.well{
			padding: 10px 25px;
			background-color: rgb(245,245,245);
			border: 2px solid rgb(240,240,240);
			border-radius: 2px;
			margin: 10px 0;
		}

		.well p{
			margin: 5px 0;
		}

		.well .btn{
			padding: 10px 15px;
			text-decoration: none;
			display: inline-block;
		}

		.btn{
			padding: 10px 15px;
			text-decoration: none;
			display: inline-block;
		}

		.btn:hover{
			cursor: pointer;
		}

		.btn-default{
			color: rgb(60,100,200);
			background-color: rgb(252,252,252);
			border: 2px solid rgb(240,240,240);
			border-radius: 5px;
			margin: 5px 0;
			transition: box-shadow;
			transition-duration: 0.2s;
			background-image: linear-gradient(rgba(0,0,0,0.0), rgba(0,0,0,0.0), rgba(50,50,50,0.1));
		}

		.btn-primary{
			background-color: rgb(90,150,255);
			color: white;
			font-weight: bold;
			border-radius: 3px;
			margin: 5px 0;
			transition: box-shadow;
			transition-duration: 0.2s;
			background-image: linear-gradient(rgba(0,0,0,0.0), rgba(0,0,0,0.0), rgba(0,0,0,0.3));
		}

		.btn-danger{
			background-color: rgb(255,50,50);
			color: white;
			font-weight: bold;
			border: 0;
			border-radius: 3px;
			margin: 5px 0;
			transition: box-shadow;
			transition-duration: 0.2s;
			background-image: linear-gradient(rgba(0,0,0,0.0), rgba(0,0,0,0.0), rgba(0,0,0,0.3));
		}

		.btn-default:visited{
			color: grey;
		}

		.btn-default:hover{
			box-shadow: -1px -1px 2px lightblue,1px 1px 2px lightblue;
		}

	</style>

</head>

	<body>

		<div class="container">

			<a href="<?php echo ROOT_URL; ?>add-post.php" class="btn btn-primary">Add post</a>

			<h1>Posts</h1>

			<?php foreach ($posts as $post): ?>

				<div class="well">
					
					<h3><?php echo $post['title']; ?></h3>

					<small> created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>

					<p><?php echo $post['body']; ?></p>

					<a href="<?php echo(ROOT_URL) ?>post.php?id=<?php echo $post['id'] ?>" class="btn btn-default">Read more</a>

					<form action="delete-post.php" method="POST" style="float: right;">
						<input type="hidden" name="id" value="<?php echo $post['id'] ?>">
						<input type="submit" name="delete" value="Delete post" class="btn btn-danger">
					</form>


				</div>
				
			<?php endforeach ?>

		</div>
		
	</body>

</html>