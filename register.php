<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Register</title>
</head>
<body>
<div class="container">
	<div class="row d-flex justify-content-center mt-5">
		<div class="col-12 col-md-8 col-lg-6 col-xl-5">
			<div class="card py-3 px-2">
				<p class="text-center mb-3 mt-2">Sign Up with:</p>
				<div class="row mx-auto ">
					<div class="col-4">
						<i class="fab fa-twitter"></i>
					</div>
					<div class="col-4">
						<i class="fab fa-facebook"></i>
					</div>
					<div class="col-4">
						<i class="fab fa-google"></i>
					</div>
				</div>
				<div class="division">
					<div class="row">
						<div class="col-3"><div class="line l"></div></div>
						<div class="col-6"><span>or:</span></div>
						<div class="col-3"><div class="line r"></div></div>
					</div>
				</div>
				<form class="myform" action="register.php" method="POST">
                    <div class="form-group">
    					<input type="text" class="form-control" name="username" placeholder="Username">
  					</div>
					<div class="form-group">
    					<input type="email" class="form-control" name="email" placeholder="Email">
  					</div>
 					<div class="form-group">
    					<input type="password" class="form-control" name="password" placeholder="Password">
  					</div>
                    <div class="form-group">
    					<input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
  					</div>
  					<div class="form-group mt-3">
                        <input class="btn btn-block btn-primary btn-lg" type="submit" name="submit" value="Sign Up">
  					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Optional JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>

<?php

    include("sendEmail.php");

    if (isset($_POST["submit"]))
    {
        if (empty($_POST["username"]) || empty($_POST["password"]) ||empty($_POST["cpassword"]) ||empty($_POST["email"]))
        {
            echo '<script>alert("You must fill all inputs!")</script>';
        }

        else
        {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            $cpassword = filter_input(INPUT_POST, "cpassword", FILTER_SANITIZE_SPECIAL_CHARS);

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $chash = password_hash($cpassword, PASSWORD_DEFAULT);

            
			$query2 = "SELECT * FROM users WHERE user='$username'";
			$result2 = mysqli_query($connect, $query2);
			$query3 = "SELECT * FROM users WHERE email='$email'";
			$result3 = mysqli_query($connect, $query3);
		
			if (mysqli_num_rows($result2) > 0)
			{
				echo '<script>alert("This username already exists!")</script>';
			}
			elseif (mysqli_num_rows($result3) > 0)
			{
				echo '<script>alert("This email already exists!")</script>';
			}
			else
			{
				if ($password == $cpassword)
				{
					$password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/";
                    $password_validate = preg_match($password_regex, $password);

					if (!$password_validate)
					{
						echo '<script>alert("Password must be at least 8 characters long, should include at least one upper case letter, one lower case letter, and one special character!")</script>';
					}
					else
					{
						$code = rand();
						$query = "INSERT INTO users (user, email, password, cpassword, code) VALUES ('$username', '$email', '$hash', '$chash', '$code')";
						$result = mysqli_query($connect, $query);
						echo '<script>alert("Successfully registered! Please verify your email.")</script>';
					
						$sendMl -> send($code);
					}
					
				}
				else
				{
					echo '<script>alert("Given passwords did not match!")</script>';
				}
			}
        }
    }

?>

