<?php 
	
	require './config/config.php';
	require './config/db.php';

	if(isset($_POST['edit'])){
		$id = mysqli_real_escape_string($connection, $_POST['id']);

		session_set_cookie_params(60 * 60, '/', 'localhost', false, true);
		session_start();

		$title = mysqli_real_escape_string($connection, $_SESSION['b']['title']);
		$author = mysqli_real_escape_string($connection, $_SESSION['b']['author']);
		$body = mysqli_real_escape_string($connection, $_SESSION['b']['body']);

		$msg = '';
		$msgclass = '';

		session_destroy();

	}

	if(isset($_POST['submit'])){

		$title = mysqli_real_escape_string($connection, $_POST['title']);
		$author = mysqli_real_escape_string($connection, $_POST['author']);
		$body = mysqli_real_escape_string($connection, $_POST['body']);

		$id = mysqli_real_escape_string($connection, $_POST['id']);

		//actual query
		$query = "UPDATE posts SET title = '$title', author = '$author' , body = '$body' WHERE id =  $id;";

		//performs query on selected database and returns a msqli_result object
		if(mysqli_query($connection, $query)){

			$msg = 'Successfully updated post!!';
			$msgclass = 'alert alert-success';


		}else if($title === '' || $author === '' || $body === ''){

			$msg = 'All fields required!!!';
			$msgclass = 'alert alert-warning';

		}else{
			$msg = 'Failed to update post!! with error message : ' . mysqli_error($connection);
			$msgclass = 'alert alert-danger';
		}


		//var_dump($result);

		//$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

		//print_r($posts);

		//frees memory allocated associated with result
		//mysqli_free_result($result);

		//closes the connection to the data base
		mysqli_close($connection);

	}

	if (isset($_POST['redirect'])) {
		# code...
		header('location:'.ROOT_URL);
	}
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
			min-width: 150px;
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

		.btn-danger{
			background-color: rgb(255,50,50);
			color: white;
			font-weight: bold;
			border: 0;
			border-radius: 3px;
			margin: 5px 0;
			transition: box-shadow;
			transition-duration: 0.2s;
		}

		.btn-warning{
			background-color: rgb(255,215,0);
			color: white;
			font-weight: bold;
			border: 0;
			border-radius: 3px;
			margin: 5px 0;
			transition: box-shadow;
			transition-duration: 0.2s;
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

			<h1>Update Posts</h1>
			
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
					<input type="text" name="title" class="form-control" value="<?php echo (isset($_SESSION['b']['title']) ? $_SESSION['b']['title'] : ''); ?>">

				</div>

				<div class="form-group">
					
					<label>Author</label>
					<input type="text" name="author" class="form-control" value="<?php echo (isset($_SESSION['b']['author']) ? $_SESSION['b']['author'] : ''); ?>">

				</div>

				<div class="form-group">
					
					<label>Title</label>
					<textarea name="body" class="form-control"><?php echo (isset($_SESSION['b']['body']) ? $_SESSION['b']['body'] : ''); ?></textarea>

				</div>

				<div class="form-group">

					<input type="hidden" value="<?php echo $id; ?>" name="id">
				
					<input type="submit" name="submit" value="Edit" class="btn btn-warning">

				</div>

			</form>

		</div>
		
	</body>

</html>