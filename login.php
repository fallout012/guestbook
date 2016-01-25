<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>
	<meta charset=utf-8>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
session_start();
$username = "";
	if(isset($_POST['submit'])){
		//process form
		$username = $_POST['username'];
		$password = $_POST['password'];

		$found_admin = login_attempt($username, $password);
		if($found_admin){
			$_SESSION['user'] = $username;
			echo $_SESSION['user'];
			header("Location: form.php");
		} else {
			echo "<div class='err'>";
			echo "Login failed, try again";
			echo "</div>";
		}
	}

	function login_attempt($username, $password){
		$result = false;
		if(file_exists("admins.csv")){
			$admins = fopen("admins.csv", "r");
			while(($data = fgetcsv($admins, 1000, ",")) !== false){
				if($data[0] == $username && $data[1] == $password){
					$result = $username;
				}
			}
		fclose($admins);
		return $result;
		}
	}


?>
<form method="post" action="">
	<div class="form_element">
		<label>User Name:</label>
		<input type="text" name="username" value="<?php echo $username; ?>"<br>
	</div>
	<div class="form_element">
		<label>Password:</label>
		<input type="password" name="password"<br>
	</div>
	<input type="submit" name="submit" value="Login">
</form>
<div class='help'>
	<h2>Use the following login credentials:</h2>
	<span><strong>Username:</strong> "Admin",</span>
	<span><strong>Password:</strong> "123"</span>
	<p>or</p>
	<span><strong>Username:</strong> "Administrator",</span>
	<span><strong>Password:</strong> "111"</span>
</div>
	
</body>
</html>