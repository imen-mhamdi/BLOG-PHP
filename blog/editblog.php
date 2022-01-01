<?php
// cannot access the page if there is no session
require_once "../manager.php";

if($authority == "User")
{
    header("Location: ../index.php");
}

if(!isset($_SESSION["email"]))
{
    header("Location: ../index.php");
}

if($_POST)
{
    $edittitle = $_POST["edittitle"];
    $edittext = $_POST["edittext"];
    $titlenumber = strlen($edittitle);
    $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    if($titlenumber > 80)
    {
        $errormsg = "Title is too long.";
    }
    else
    {
        $query = $db->prepare("UPDATE blog SET blogtitle=?, blogtext=? WHERE blogid=?");
        $update = $query->execute(array($edittitle, $edittext, $info["blogid"]));
        if($update)
        {
            $errormsg = "Updated.";
            header("Refresh: 1; url=$url");
        }
        else
        {
            $errormsg = "Could not update.";
        }
    } 
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo defined('PROJECT_NAME') ? PROJECT_NAME : 'My Blog System'; ?> - Edit Post</title>
  </head>
  <body>
    <?php include "../navbar.php"?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Blog Post</h4>
                    </div>
                    <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="edittitle"><i class="fas fa-heading"></i> Post Title</label>
                        <input type="text" class="form-control" id="edittitle" name="edittitle" value="<?php echo htmlspecialchars($info["blogtitle"]); ?>" maxlength="80" required>
                    </div>
                    <div class="form-group">
                        <label for="edittext"><i class="fas fa-align-left"></i> Post Content</label>
                        <textarea class="form-control" id="edittext" name="edittext" cols="30" rows="15" required><?php echo htmlspecialchars($info["blogtext"]); ?></textarea>
                    </div>
                <div class="text-right">
                <button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-save"></i> Update Post</button>
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
                </div>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
