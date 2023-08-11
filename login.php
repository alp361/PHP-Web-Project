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

    <title>Login</title>
</head>
<body>
<div class="container">
	<div class="row d-flex justify-content-center mt-5">
		<div class="col-12 col-md-8 col-lg-6 col-xl-5">
			<div class="card py-3 px-2">
				<p class="text-center mb-3 mt-2">Login</p>
				<form class="myform" action="login.php" method="POST">
                    <div class="form-group">
    					<input type="text" class="form-control" name="username" placeholder="Username or Email">
  					</div>
 					<div class="form-group">
    					<input type="password" class="form-control" name="password" placeholder="Password">
  					</div>
  					<div class="row">
  						<div class="col-md-6 col-12">
  							<div class="form-group form-check">
    							<input type="checkbox" class="form-check-input" id="exampleCheck1">
    							<label class="form-check-label" for="exampleCheck1">Remember Me</label>
  							</div>
  						</div>
  						<div class="col-md-6 col-12 bn"><a href="http://localhost/website_reg/forgot-password">Forgot Password?</a></div>
  					</div>
  					<div class="form-group mt-3">
                        <input class="btn btn-block btn-primary btn-lg" type="submit" name="login" value="Login">
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

    if (isset($_POST["login"]))
    {
        if (empty($_POST["username"]) || empty($_POST["password"]))
        {
            echo '<script>alert("You must fill all inputs!")</script>';
        }

        else
        {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        
            $query1 = "SELECT * FROM users WHERE user='$username' OR email='$username'";
            $result1 = mysqli_query($connect, $query1);

            if (mysqli_num_rows($result1) > 0)
            {
                $row = mysqli_fetch_assoc($result1);

                if (password_verify($password, $row["password"]))
                {
                    if ($row["is_verified"] == 1)
                    {
                        echo '<script>alert("Successfully logged in.")</script>';
                    }
                    else
                    {
                        echo '<script>alert("You have to verify your email before login!")</script>';
                    }
                }
                else
                {
                    echo '<script>alert("Invalid username/email or password!")</script>';
                    
                }
            }
            else
            {
                echo '<script>alert("Invalid username/email or password!")</script>';
                
            }
        }
    }

?>