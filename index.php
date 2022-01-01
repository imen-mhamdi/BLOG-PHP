<?php
require_once "manager.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo defined('PROJECT_NAME') ? PROJECT_NAME : 'My Blog System'; ?> - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include "navbar.php"?>
    <div class="container mt-4">
      <div class="row">
      <div class="col-md-10 mx-auto">
        <h2 class="mb-4 text-center"><i class="fas fa-blog"></i> Latest Blog Posts</h2>
        <?php
          foreach($bloginfo as $blog)
          {
            $numberofcharacters = strlen($blog["blogtext"]);
            ?>
            
              <div class="card mt-1">
              <div class="card-body">
                <a href="blog/blog.php?blogid=<?php echo $blog["blogid"];?>"><h5 class="card-title text-dark"><?php echo $blog["blogtitle"]?></h5></a>
                <?php
                 if($numberofcharacters > 200)
                 {
                      echo substr($blog["blogtext"],0,350) ."...";
                    ?>
                    <form method="get">
                      <a href="blog/blog.php?blogid=<?php echo $blog["blogid"];?>">Read more</a>
                    </form>
                    <?php
                 }
                 else
                 {
                  ?>
                    <p class="card-text"><?php echo $blog["blogtext"]?></p>
                  <?php
                 }
                ?>
              </div>
              <div class="card-footer bg-light">
                <small class="text-muted">
                  <i class="fas fa-user"></i> Submitted by: <strong><?php echo $blog["user"]?></strong> | 
                  <i class="fas fa-calendar"></i> Date: <?php echo date("F j, Y, g:i a", strtotime($blog["time"]))?>
                </small>
              </div>
              </div>
            <?php
          }
        ?>
      </div>
      </div>
    </div>
</body>
</html>