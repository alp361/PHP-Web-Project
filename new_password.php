<?php

    include("database.php");

        if (isset($_POST["changepw"]))  
        {
            if (empty($_POST["password"]) || empty($_POST["cpassword"]))
            {
                echo "You must fill all inputs!";
            }
    
            else
            {
                $email = $_POST["email"];
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
                $cpassword = filter_input(INPUT_POST, "cpassword", FILTER_SANITIZE_SPECIAL_CHARS);
    
                if ($password == $cpassword)
                {
                    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/";
                    $password_validate = preg_match($password_regex, $password);

					if (!$password_validate)
					{
						echo "Password must be at least 8 characters long, should include at least one upper case letter, one lower case letter, and one special character!";
					}
					else
                    {
                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        $chash = password_hash($cpassword, PASSWORD_DEFAULT);
                
                        $query2 = "UPDATE users SET password='$hash', cpassword='$chash' WHERE email='$email'";
                
                        $result2 = mysqli_query($connect, $query2);
                
                        if ($result2)
                        {
                            echo "Your password has been changed. <br> Now, you can <a href=http://localhost/website_reg/login>login</a> to your account. <br>";
                        }
                    }
                    
                }
                else
                {
                    echo "Given passwords did not match! <br>";
                }        
            }
        }

?>