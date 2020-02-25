<?php
	require_once 'includes/DbFunctions.php';
	$database = new DbFunctions();
	$err_msg = "";

	if(isset($_POST["submit"])){

		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);

		$login = $database->user_login_as_master($username,$password);

		if($login != FALSE){

			session_start();
			$_SESSION["isloggedin"] = TRUE;
			$_SESSION["username"] = $username;
			header('location:branch.php');
			exit();
			 
		} else {

			$err_msg = "Invalid Username or Password. Please try again";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="stylesheet" href="css/bootstrap.min.css" />
<!--===============================================================================================-->
	<style>
		    img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]
		    {
		        display : none;
		    }
		</style>
</head>

<body>
	
	<div align="center" class="container">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="post" class="login100-form validate-form">
					
					<span class="login100-form-title p-b-60">
						
						<h2>Chrissia's BakeShop</h4>
						<hr>
						<h3>Login as Administrator/Owner </h5>
					</span>

				
					<table>
						<tr>
							<td>
								<label>Username: </label> 
							</td>
							<td>
								<input class="form-control" type="text" name="username" placeholder="Enter Username" required>
							</td>
						</tr>
						
						<tr>
						
							<td>
							<br>
								<label>Password: </label> 
							</td>
							<td>
								<input class="form-control" type="password" name="password" placeholder="Enter Password" required>
							</td>
						</tr>

						<tr>
						
							<td>
							<br>
								<label>Action: </label> 
							</td>
							<td>
								<button class="btn btn-primary" name="submit">Log in</button>
							</td>
						</tr>
					</table>
					
					<div class="container-login100-form-btn">
						<span style="color:red"><?php echo $err_msg; ?></span>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	

</body>
</html>