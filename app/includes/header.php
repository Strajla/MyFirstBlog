<header>
      <a href =""<?php echo BASE_URL . '/index.php'?>"" class="logo">
        <h1 class="logo-text"><span>MyFirst</span>Blog</h1>
      </a>
      <i class="fa fa-bars menu-toggle"></i>
      <ul class="nav">
        <li><a href="<?php echo BASE_URL . '/index.php'?>">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>

      <!-- If there is any data in session display login information -->
      <?php   if(isset($_SESSION['id'])): ?>
        <li>
          <a href="#">
            <i class="fa fa-user"></i>
            <?php  echo $_SESSION['username']; ?>
            <i class="fa fa-chevron-down" style="font-size:  .8em;"></i>
          </a>
          <ul>
            <!-- Here we check if someone is admin, or in better words if value is true -->
            <?php if ($_SESSION['admin']): ?>
            <li><a href="<?php echo BASE_URL . '/admin/dashboard.php' ?>">Dashboard</a></li>
      <?php endif; ?>
            <li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Logout</a></li>
          </ul>
        </li>
      <?php  else:  ?>
      <!-- If its not display links to login and sign up pages -->
        <li><a href="<?php echo BASE_URL . '/register.php' ?>">Sign Up</a></li>
        <li><a href="<?php echo BASE_URL . '/login.php' ?>">Login</a></li>
      <?php endif; ?>
      </ul>
    </header>

    