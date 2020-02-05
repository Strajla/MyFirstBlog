<?php include("path.php");  ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <script
      src="https://kit.fontawesome.com/0016173d9b.js"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/style.css" />

    <title>Log In</title>
  </head>
  <body>
   
  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

    <div class="auth-content">
      <form action="login.php" method="post">
        <h2 class="form-title">Login</h2>

        <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
        
        <div>
          <label>Username</label>
          <input type="text" name="username" value = "<?php echo $username ?>" class="text-input" />
        </div>
              <!-- We are able to use this values bcs we are including users.php, and at the top of this users.php 
              file we are initializing this values into enmpty strings -->
        <div>
          <label>Password</label>
          <input type="password" name="password" value = "<?php echo $password ?>" class="text-input" />
        </div>

        <div>
          <button type="submit" name="login-btn" class="btn btn-big">
            Login
          </button>
        </div>
        <p>Or <a href="<?php echo BASE_URL . '/register.php'?>">Sign Up</a></p>
      </form>
    </div>

    <!-- JQ -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>

    <!-- Java Script -->
    <script src="assets/js/scripts.js"></script>
  </body>
</html>
