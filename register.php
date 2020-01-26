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

    <title>Register</title>
  </head>
  <body>
    <header>
      <div class="logo">
        <h1 class="logo-text"><span>MyFirst</span>Blog</h1>
      </div>
      <i class="fa fa-bars menu-toggle"></i>
      <ul class="nav">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <!-- <li><a href="#">Sign Up</a></li>
        <li><a href="#">Login</a></li> -->
        <li>
          <a href="#">
            <i class="fa fa-user"></i>
            Strahinja Strajla
            <i class="fa fa-chevron-down" style="font-size:  .8em;"></i>
          </a>
          <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#" class="logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>

    <div class="auth-content">
      <form action="register.html" method="post">
        <h2 class="form-title">Register</h2>

        <!-- <div class="msg error">
            <li>Username required</li>
        </div> -->

        <div>
          <label>Username</label>
          <input type="text" name="username" class="text-input" />
        </div>

        <div>
          <label>Email</label>
          <input type="email" name="email" class="text-input" />
        </div>

        <div>
          <label>Password</label>
          <input type="password" name="password" class="text-input" />
        </div>

        <div>
          <label>Password Confirmation</label>
          <input type="text" name="passwordConf" class="text-input" />
        </div>

        <div>
          <button type="submit" name="register-btn" class="btn btn-big">
            Register
          </button>
        </div>
        <p>Or <a href="login.html">Sign In</a></p>
      </form>
    </div>

    <!-- JQ -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>

    <!-- Java Script-->
    <script src="assets/js/scripts.js"></script>
  </body>
</html>
