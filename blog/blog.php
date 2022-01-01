<?php

require_once "../manager.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo defined('PROJECT_NAME') ? PROJECT_NAME : 'My Blog System'; ?> - <?php echo htmlspecialchars($info["blogtitle"]);?></title>
  </head>
  <body>
    <?php include "../navbar.php";?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-book-open"></i> <?php echo htmlspecialchars($info["blogtitle"]);?></h3>
                    </div>
                    <div class="card-body">
                        <div class="text-muted mb-3">
                            <i class="fas fa-user"></i> <strong>Author:</strong> <?php echo htmlspecialchars($info["user"]);?> | 
                            <i class="fas fa-calendar"></i> <strong>Published:</strong> <?php echo date("F j, Y, g:i a", strtotime($info["time"]));?>
                        </div>
                        <hr>
                        <div class="card-text text-break" style="line-height: 1.8; font-size: 1.1rem;">
                            <?php echo nl2br(htmlspecialchars($info["blogtext"]));?>
                        </div>
                    </div>
                    <?php
                    if($authority == "Admin")
                    {
                        ?>
                        <div class="card-footer bg-light">
                            <a href="editblog.php?blogid=<?php echo $info["blogid"];?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit Post
                            </a>
                            <a href="deleteblog.php?blogid=<?php echo $info["blogid"];?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">
                                <i class="fas fa-trash"></i> Delete Post
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="text-center mt-3">
                    <a href="../index.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Home</a>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>