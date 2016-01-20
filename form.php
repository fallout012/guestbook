<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset=utf-8>
	<meta name=description content="simple form for a guestbook">
	<meta name=viewport content="width=device-width, initial-scale=1">
</head>
<style>
	h1 {
		margin-left: 114px;
	}
	.error{
		color: red;
	}
	.post-block {
		background: #CDF1A3;
		max-width: 400px;
		margin: 20px;
		padding: 10px;
	}
	form {
		background: hsla(192, 100%, 48%, 0.48);
		margin: 20px;
		padding: 10px;
		max-width: 400px;
		border-radius: 10px;
		box-shadow: 1px 2px 15px 2px;
	}
	.form_element{
		margin: 10px;
	}
	form input[name="username"], form input[name="email"], form input[name="password"], textarea{
		padding: 5px;
		border-radius: 5px;
		box-shadow: 0px 0px 0px 1px inset;
		min-width: 250px;
	}
	form input[name="username"]{
		margin-left: 20px;
	}
	form input[name="email"]{
		margin-left: 54px;
	}
	form input[name="password"]{
		margin-left: 30px;
	}
	form input[type="radio"]{
		margin-left: 43px;
	}
	textarea {
		margin-left: 21px; 	
		min-height: 100px;
	}
	label.comment{
		vertical-align: top;
		display: inline-block;
		margin-top: 10px;
	}
	input[type="submit"]{
		border-radius: 5px;
		padding: 10px;
		font: 22px/24px sans-serif;
		font-weight: bold;
		text-transform: uppercase;
		background: #FFEB3B;
		margin: 5px;
	}
	input[type="submit"]:hover{
		background: #A7FF00;
		cursor: pointer;
	}

</style>
<body>
<?php 

// defining variables
$username = '';
$email = '';
$password = '';
$comments = '';
$gender = '';
$username_err_msg = $email_err_msg = $password_err_msg = $comments_err_msg = $gender_err_msg =  '';
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
	if(!isset($_POST['password']) || $_POST['password'] === ''){
		$ok = false;
		$password_err_msg = 'Password is not correct';
	} else {
		$password = $_POST['password'];
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
		$arr = [$_POST['username'], $_POST['email'], $_POST['password'], $_POST['comments'], $_POST['gender'], $date];
		// writing data to a csv file
		$file = fopen('file.csv', 'a');
		fputcsv($file, $arr);
		fclose($file);
		$_POST = array();
		}
	}

?>
<h1>The GuestBook!</h1>
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
		<label>Password:</label>
		<input type="password" name="password" value="<?php if(isset($_POST['password'])){echo htmlspecialchars($_POST['password']);} ?>"><span class='error'><?php echo $password_err_msg; ?></span><br>
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
            <b>".$data[0]." </b><i>".$data[1]."</i> <i style='text-decoration: underline;'>".$data[5]."</i>"."
            <p>".$data[3]."</p>
        	</div>";
		}
		fclose($posts);
	
	}
?>

</body>
</html>