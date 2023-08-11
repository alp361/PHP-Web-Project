<?php

    include("database.php");

    if (isset($_GET["code"]))
    {
        $v_code = $_GET["code"];

        $query = "UPDATE users SET is_verified='1' WHERE code='$v_code'";

        $result = mysqli_query($connect, $query);

        if ($result)
        {
            $message = "Your account is verified. <br> Now, you can <a href=http://localhost/website_reg/login.php>login</a> . <br>";
        }
        else
        {
            $message = "Wrong url! <br>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php
        
            echo $message;

        ?>
    </div>
</body>
</html>