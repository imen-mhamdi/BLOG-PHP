<?php
require_once "manager.php";

// cannot access the page if there is no session
if(!isset($_SESSION["email"]))
{
    header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo defined('PROJECT_NAME') ? PROJECT_NAME : 'My Blog System'; ?> - Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include "navbar.php"?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 ">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-circle"></i> Account Information</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="fas fa-user text-primary"></i> <strong>Username:</strong> <?php echo $usersinfo["username"]?>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-envelope text-primary"></i> <strong>Email:</strong> <?php echo $usersinfo["email"]?>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-calendar text-primary"></i> <strong>Date of Registration:</strong> <?php echo date("F j, Y", strtotime($usersinfo["registerdate"]))?>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-shield-alt text-primary"></i> <strong>Authority:</strong> 
                        <span class="badge badge-<?php echo $usersinfo["authority"] == "Admin" ? "danger" : "secondary"; ?>">
                            <?php echo $usersinfo["authority"]?>
                        </span>
                    </li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</body>
</html>