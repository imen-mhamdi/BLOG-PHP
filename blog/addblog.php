<?php
// cannot access the page if there is no session
require_once "../manager.php";

if(!isset($_SESSION["email"]))
{
    header("Location: ../index.php");
}

if($_POST)
{
    $title = $_POST["title"];
    $text = $_POST["text"];
    $titlenumber = strlen($title);
    if($titlenumber > 80)
    {
        $errormsg = "Title is too long.";
    }
    else
    {
        if($title!="" && $text!="")
        {
            $query = $db->prepare("INSERT INTO blog SET blogtitle=?, blogtext=?, user=?, time=? ");
            $addblog = $query->execute(array($title, $text, $username, date("Y-m-d h:i:s")));
            if($addblog)
            {
                $errormsg = "Text Added.";
            }
            else
            {
                $errormsg = "Could not add text.";
            }
        }
        else
        {
            $errormsg = "Do not leave empty space!";
        }
    }
}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo defined('PROJECT_NAME') ? PROJECT_NAME : 'My Blog System'; ?> - Add New Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include "../navbar.php"?>
    <div class="container mt-3">
      <div class="row">
      <div class="col-md-12 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Add New Blog Post</h4>
            </div>
            <div class="card-body">
        <form method="POST">
            <div class="form-group">
                <label for="title"><i class="fas fa-heading"></i> Post Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter post title (max 80 characters)" maxlength="80" required>
            </div>
            <div class="form-group">
                <label for="text"><i class="fas fa-align-left"></i> Post Content</label>
                <textarea name="text" id="text" class="form-control" cols="30" rows="10" placeholder="Write your blog post content here..." required></textarea>
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
            <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fas fa-paper-plane"></i> Publish Post</button>
        </form>
            </div>
        </div>
      </div>
      </div>
    </div>
</body>
</html>