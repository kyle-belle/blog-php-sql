<?php  
	
	require './config/config.php';
	require './config/db.php';

	$msg = '';
	$msgclass = '';

	if(isset($_POST['submit'])){
		$title = mysqli_real_escape_string($connection, htmlspecialchars($_POST['title']));
		$author = mysqli_real_escape_string($connection, htmlspecialchars($_POST['author']));
		$body = mysqli_real_escape_string($connection, htmlspecialchars($_POST['body']));

		session_set_cookie_params((60 * 5), '/', 'localhost', false, true);

		session_start();

		$_SESSION['a']['title'] = htmlspecialchars($title);
		$_SESSION['a']['author'] = htmlspecialchars($author);
		$_SESSION['a']['body'] = htmlspecialchars($body);


		//actual query
		$query = "INSERT INTO posts (title, author, body) VALUES ('$title', '$author', '$body');";

		//performs query on selected database and returns a msqli_result object
		if(mysqli_query($connection, $query)){

			$msg = 'Successfully posted to database!!';
			$msgclass = 'alert alert-success';

			unset($_SESSION['a']);
			session_destroy();

		}else if($title === '' || $author === '' || $body === ''){

			$msg = 'All fields required!!!';
			$msgclass = 'alert alert-warning';

		}else{
			$msg = 'Failed to post to database!! with error message : ' . mysqli_error($connection);
			$msgclass = 'alert alert-danger';
		}

	}

	if (isset($_POST['redirect'])) {
		# code...
		header('location:'.ROOT_URL);
	}



	//var_dump($result);

	//frees memory allocated associated with result
	//mysqli_free_result($result);

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

		.form-control{
			width: 40%;
			height: 30px;
		}

		.form-group{
			margin: auto;
			text-align: center;
		}

		.form-group .btn{
			margin-top: 20px;
		}

		.form-group textarea{
			height: 60px;
			border: 1px rgb(200,200,200) solid;
			padding: 5px 10px;
			border-radius: 2px;
		}

		.form-group input{
			height: 40px;
			border: 1px rgb(200,200,200) solid;
			padding: 2px 10px;
			border-radius: 2px;
		}

		.form-group label{
			margin: 20px auto;
			margin-bottom: 10px;
			display: block;
			width: 42%;
			text-align: left;
		}

		.container h1,h2,h3,h4,h5,h6{
			color: rgb(80,130,255);
		}

		/* .well{
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
		} */

		.btn{
			padding: 10px 15px;
			text-decoration: none;
			display: inline-block;
			border: 0;
		}

		.btn-default{
			color: rgb(60,100,200);
			background-color: rgb(252,252,252);
			border: 2px solid rgb(240,240,240);
			border-radius: 3px;
			margin: 5px 0;
			transition: box-shadow;
			transition-duration: 0.2s;
		}

		.btn-default:visited{
			color: grey;
		}

		.btn-default:hover{
			box-shadow: -1px -1px 2px lightblue,1px 1px 2px lightblue;
		}

		.btn-primary{
			background-color: rgb(60,100,255);
			color: white;
			font-weight: bold;
		}

		.alert{
			padding: 20px 10px 20px 10px;
			margin: 20px auto 0 auto;
		}

		.alert p{
			padding:0;
			margin: 5px 0 0 0;
		}

		.alert-danger{
			background-color: rgb(255,80,80);
			color: white;
			text-transform: capitalize;
			text-align: center;
		}

		.alert-success{
			background-color: rgb(0,220,0);
			color: white;
			text-transform: capitalize;
			text-align: center;
		}

		.alert-warning{
			background-color: rgb(255,215,0);
			color: white;
			text-transform: capitalize;
			text-align: center;
		}

	</style>

</head>

	<body>

		<div class="container">

			<h1>Add Posts</h1>
			
			<form action="" method="POST">

				<?php if (isset($msg)): ?>
				<div class="<?php echo $msgclass; ?> form-control">
					
					<p><?php echo $msg; ?></p>

				</div>
			<?php endif ?>

			<?php if ($msgclass === 'alert alert-success'): ?>
				
				<form action="" method="POST">

					<div class="form-group">
			
						<input type="submit" name='redirect' value='See post on website' class="btn btn-primary">

					</div>

				</form>
					
			<?php endif ?>
				
				<div class="form-group">
					
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="<?php echo (isset($_SESSION['a']['title']) ? $_SESSION['a']['title'] : ''); ?>">

				</div>

				<div class="form-group">
					
					<label>Author</label>
					<input type="text" name="author" class="form-control" value="<?php echo (isset($_SESSION['a']['author']) ? $_SESSION['a']['author'] : ''); ?>">

				</div>

				<div class="form-group">
					
					<label>Title</label>
					<textarea name="body" class="form-control"><?php echo (isset($_SESSION['a']['body']) ? $_SESSION['a']['body'] : ''); ?></textarea>

				</div>

				<div class="form-group">
				
					<input type="submit" name="submit" value="Add Post" class="btn btn-primary">

				</div>

			</form>

		</div>
		
	</body>

</html>