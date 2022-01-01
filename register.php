<?php
require_once "manager.php";

if($_POST)
{
    // POST 
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    if($username!="" && $email!="" && $password!="")
    {
        $query = $db->prepare("SELECT * FROM users WHERE email=?");
        $query->execute(array($email));
        $emailcontrol = $query->rowCount();
        if($emailcontrol > 0)
        {
            $errormsg = "This email address is being used by another user!";
        }
        else
        {
            if(filter_var($email,  FILTER_VALIDATE_EMAIL))
            {
                $query = $db->prepare("INSERT INTO users SET email=?, username=?, password=?, registerdate=?");
                $add = $query->execute(array($email, $username, $password, date("Y-m-d")));
                if($add)
                {
                    $errormsg = "Account created :)";
                }
                else
                {
                    $errormsg = "Account not created :(";
                }
            }
            else
            {
                $errormsg = "Enter a valid email address!";
            }
        }
    }
    else
    {
        $errormsg = "Do not leave empty space!";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Page</title>
  </head>
  <body>
    <!-- NAVBAR -->
   <?php include "navbar.php"?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-user-plus"></i> Register Form</h4>
                    </div>
                    <div class="card-body">
                <form method="post">
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>    
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" class="form-control mt-1" id="password" name="password" placeholder="Choose a password" required>
                </div>
                <?php
                if(!empty($errormsg))
                {
                    ?>
                    <div class="alert alert-success mt-1" role="alert">
                    <?php echo $errormsg;?>
                    </div>
                    <?php
                }
                ?>
                <div class="text-center">
                    <a href="login.php" class="text-primary">Already have an account? Login here</a>
                </div>
                <button type="submit" class="btn btn-success btn-block mt-3"><i class="fas fa-user-plus"></i> Register</button>   
                </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
  </body>
</html>