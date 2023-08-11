<?php

    include("database.php");

    if (isset($_GET["token"]))
    {
        $v_token = $_GET["token"];
        $email = $_GET["email"];
        $query = "SELECT * FROM users WHERE email='$email' AND pwResetToken='$v_token'";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) == 1)
        {
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
                   <form class="myform" action="new_password.php" method="POST">
                       <div class="form-group">
                           <input type="hidden" name="email" value="<?php echo $email; ?>">
                           <input type="password" class="form-control" name="password" placeholder="Enter New Password" required>
                         </div>
                        <div class="form-group">
                           <input type="password" class="form-control" name="cpassword" placeholder="Confirm New Password" required>
                         </div>
                         <div class="form-group mt-3">
                           <input class="btn btn-block btn-primary btn-lg" type="submit" name="changepw" value="Change Password">
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
        }             
    }
    
?>
