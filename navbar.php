<?php
require_once "manager.php";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand font-weight-bold" href="/index.php">
      <strong><?php echo defined('PROJECT_NAME') ? PROJECT_NAME : 'My Blog System'; ?></strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
      </div>
    </div>
    <form class="form-inline my-2 my-lg-0">
      <?php
      if(isset($_SESSION["email"]))
      {
        if($authority == "Admin")
        {
          ?>
           <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-cog"></i> Admin Panel
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="blog/addblog.php"><i class="fas fa-plus"></i> Add New Post</a>
            </div>
        </div>
          <?php
        }
        ?>
        
        <a class="nav-link text-white" href="/profile.php"><i class="fas fa-user"></i> Profile</a>
        <a class="nav-link text-white" href="/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php
      }
      else
      {
        ?>
        <a class="nav-link text-white" href="/login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a class="nav-link text-white" href="/register.php"><i class="fas fa-user-plus"></i> Register</a>
        <?php
      }
      ?>
    </form>
  </div>
</nav>