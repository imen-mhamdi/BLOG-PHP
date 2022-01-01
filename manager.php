<?php
error_reporting(0);
ob_start();
session_start();

// ============================================
// DATABASE CONFIGURATION
// ============================================
// Modify these settings according to your MySQL database configuration
// For production, use environment variables or a separate config file
define('DB_HOST', 'localhost');        // MySQL server host (usually 'localhost')
define('DB_NAME', 'blog');             // Database name (create this database first)
define('DB_USER', 'root');             // MySQL username
define('DB_PASS', '');                 // MySQL password (leave empty if no password)

// ============================================
// PROJECT CONFIGURATION
// ============================================
// Customize these settings to personalize your blog system

// Project Name - This will appear in the navbar and page titles
define('PROJECT_NAME', 'My Blog System');

// Primary Color - Main color for buttons, navbar, and highlights
// Examples: '#007bff' (blue), '#28a745' (green), '#dc3545' (red), '#6f42c1' (purple)
define('PRIMARY_COLOR', '#007bff');

// Secondary Color - Secondary elements color
// Examples: '#6c757d' (gray), '#17a2b8' (cyan), '#ffc107' (yellow)
define('SECONDARY_COLOR', '#6c757d');

try
{
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8;", DB_USER, DB_PASS);
}
catch(PDOException $dberror)
{
    echo $dberror->getMessage();
}

//We pulled the logged in user's data from the database
if(isset($_SESSION["email"]))
{
    $query = $db->prepare("SELECT * FROM users WHERE email=?");
    $query->execute(array($_SESSION["email"]));
    $usernumber = $query->rowCount();
    $usersinfo = $query->fetch(PDO::FETCH_ASSOC);
    if($usernumber > 0)
    {
        $username = $usersinfo["username"];
        $email = $usersinfo["email"];
        $registerdate = $usersinfo["registerdate"];
        $authority = $usersinfo["authority"];
    }
}

// we pull data of blog posts from database
$query = $db->prepare("SELECT * FROM blog order by blogid desc");
$query->execute();
$blognumber = $query->rowCount();
$bloginfo = $query->fetchAll(PDO::FETCH_ASSOC);

if($_GET)
{
    $blogid = intval($_GET["blogid"]);
    $query = $db->prepare("SELECT * FROM blog WHERE blogid=?");
    $query->execute(array($_GET["blogid"]));
    $info = $query->fetch(PDO::FETCH_ASSOC);
}

?>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Custom Styles -->
<style>
  :root {
    --primary-color: <?php echo defined('PRIMARY_COLOR') ? PRIMARY_COLOR : '#007bff'; ?>;
    --secondary-color: <?php echo defined('SECONDARY_COLOR') ? SECONDARY_COLOR : '#6c757d'; ?>;
  }
  body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
    transition: transform 0.2s;
  }
  .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
  }
  .btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
  }
  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }
  .navbar-brand {
    font-size: 1.5rem;
  }
</style>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
