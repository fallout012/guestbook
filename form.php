<!DOCTYPE html>
<html>
<head>
	<title>Guestbook form</title>
	<meta charset=utf-8>
	<meta name=description content="simple form for a guestbook">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
session_start();
// defining variables
$username = '';
$email = '';
$comments = '';
$gender = '';
$username_err_msg = $email_err_msg  = $comments_err_msg = $gender_err_msg =  '';
$date = date('d.m.y');

// data validation
if(isset($_POST['submit'])){
	$ok = true;
	$err_msg = '';
	if(!isset($_POST['username']) || $_POST['username'] === ''){
		$ok = false;
		$username_err_msg = 'Username is not entered';
	} else {
		$username = $_POST['username'];
	}
	if(!isset($_POST['email']) || $_POST['email'] === ''){
		$ok = false;
		$email_err_msg = 'Email is not entered';
	} else {
		$email = $_POST['email'];
	}
	if(!isset($_POST['comments']) || $_POST['comments'] === ''){
		$ok = false;
		$comments_err_msg = 'Comment is not entered';
	} else {
		$comments = $_POST['comments'];
	}
	if(!isset($_POST['gender']) || $_POST['gender'] === ''){
		$ok = false;
		$gender_err_msg = 'Gender is not chosen';
	} else {
		$gender = $_POST['gender'];
	}

	if($ok){
		$arr = [$_POST['username'], $_POST['email'], $_POST['comments'], $_POST['gender'], $date];
		// writing data to a csv file
		$file = fopen('file.csv', 'a');
		fputcsv($file, $arr);
		fclose($file);
		$_POST = array();
		}
	}

?>
<div class="butt">
	<a class="back" href="index.php">Back to Login</a>
</div>
<h1>The GuestBook!</h1>
<p class="welcome">Welcome <strong><?php echo($_SESSION['user']);?></strong>! Here you can leave a review for our awesome online store. Please remember to be good!</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="form_element">
		<label>User Name:</label>
		<input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlspecialchars($_POST['username']);} ?>"><span class='error'><?php echo $username_err_msg; ?></span><br>
	</div>
	<div class="form_element">
		<label>Email:</label>
		<input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlspecialchars($_POST['email']);} ?>"><span class='error'><?php echo $email_err_msg; ?></span><br>
	</div>
	<div class="form_element">
		<label>Gender:</label>
		<input type="radio" name="gender" value="female" <?php 
		if(isset($_POST['gender']) && $_POST['gender'] === 'female'){
			echo " checked";
		}
		?>>Female
		<input type="radio" name="gender" value="male"<?php 
		if(isset($_POST['gender']) && $_POST['gender'] === 'male'){
			echo " checked";
		}
		?>>Male<span class='error'><?php echo $gender_err_msg; ?></span><br>
	</div>
	<div class="form_element">
		<label class="comment">Comments:</label>
		<textarea name="comments"><?php if(isset($_POST['comments'])){echo htmlspecialchars($_POST['comments']);} ?></textarea><span class='error'><?php echo $comments_err_msg; ?></span><br>
	</div>
	<input type="submit" name="submit" value="Submit Now!">
</form>

<?php
	// reading csv file and updating our view
	if(file_exists("file.csv")){
		$posts = fopen("file.csv", "r");
		while(($data = fgetcsv($posts, 1000, ",")) !== false){
			echo"<div class='post-block'>
            <b>".$data[0]." </b><i>".$data[1]."</i> <i style='text-decoration: underline;'>".$data[4]."</i>"."
            <p>".$data[2]."</p>
        	</div>";
		}
		fclose($posts);
	
	}
?>

</body>
</html>