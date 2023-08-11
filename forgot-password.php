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
                <p>Forgot your account’s password? Enter your email address and we’ll send you a recovery link.</p>
				<form class="myform" action="forgot-password.php" method="POST">
                    <div class="form-group">
    					<input type="email" class="form-control" name="email" placeholder="Enter Your Email">
  					</div>
  					<div class="form-group mt-3">
                        <input class="btn btn-block btn-primary btn-lg" type="submit" name="changepw" value="Send Recovery Email">
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

    function token()
    {
        $length = 20;
        return bin2hex(random_bytes($length));
    }

    if (isset($_POST["changepw"]))
    {
        if (empty($_POST["email"]))
        {
            echo '<script>alert("Please give an email!")</script>';
        }

        else
        {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

            $query1 = "SELECT * FROM users WHERE email='$email'";
            $result1 = mysqli_query($connect, $query1);

            if (mysqli_num_rows($result1) > 0)
            {
                $row = mysqli_fetch_assoc($result1);
                $token = token();
                
                $query2 = "UPDATE users SET pwResetToken='$token' WHERE email='$email'";
				$result2 = mysqli_query($connect, $query2);
				
                echo '<script>alert("Recovery email send successfully! Please check your email.")</script>';
				
				$sendMl -> send_token($token, $email);
            }
            else
            {
                echo '<script>alert("Invalid email!")</script>';
            }
        }


    }


?>