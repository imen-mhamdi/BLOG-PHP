<?php
require_once "manager.php";

if($_POST)
{
    //post
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    
    if($email!="" && $password!="")
    {
        $query = $db->prepare("SELECT * FROM users WHERE email=? and password=?");
        $query->execute(array($email, $password));
        $login = $query->rowCount();
        if($login > 0)
        {
            $errormsg = "Login successful :)";
            $_SESSION["email"] = $email;
            header("Refresh: 2; url=index.php");
        }
        else
        {
            $errormsg = "Login failed :(";
        }
    }
    else
    {
        $errormsg = "Do not leave empty space!";
    }
}
?>



<?php
//session control
if(isset($_SESSION["email"]))
{
    ?>
     <?php include "navbar.php"?>
    <?php
    echo "You are already logged in";
}
else
{
    ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <?php include "navbar.php"?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-sign-in-alt"></i> Login Form</h4>
                    </div>
                    <div class="card-body">
                <form method="post">  
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" class="form-control mt-1" id="password" name="password" placeholder="Enter your password" required>
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
                    <a href="register.php" class="text-primary">Don't have an account yet? Register here</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fas fa-sign-in-alt"></i> Login</button>   
                </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
  </body>
</html>
    <?php
}

?>
