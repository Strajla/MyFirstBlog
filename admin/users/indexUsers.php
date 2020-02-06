<?php include("../../path.php") ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- Font Awesome -->
    <script
      src="https://kit.fontawesome.com/0016173d9b.js"
      crossorigin="anonymous"
    ></script>

    <!-- Google Fonts -->

    <link
      href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap"
      rel="stylesheet"
    />

    <!-- CSS -->

    <link rel="stylesheet" href="../../assets/css/style.css" />

    <!-- ADMIN CSS -->

    <link rel="stylesheet" href="../../assets/css/admin.css" />
    <title>Admin Section - Manage Users</title>

    <!-- CK EDITOR -->

    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
  </head>

  <body>
   
   <?php include(ROOT_PATH . "/app/includes/adminHeader.php");  ?>

    <!-- Admin Page Wrapper -->
    <div class="admin-wrapper">

    <?php include(ROOT_PATH . "/app/includes/adminSidebar.php");  ?>

    <!-- Admin conten -->

    <div class="admin-content">
        <div class="button-group">
          <a href="createUser.php" class="btn btn-big">Add User</a>
          <a href="indexUsers.php" class="btn btn-big">Manage Users</a>
        </div>

        <div class="content">
          <h2 class="page-title">Manage Users</h2>

          <table>
            <thead>
              <th>SN</th>
              <th>Username</th>
              <th>Role</th>
              <th colspan="2">Action</th>
            </thead>
          
          <tbody>
            <tr>
              <td>1</td>
              <td>Strahinja</td>
              <td>Admin</td>
              <td><a href="#" class="edit">Edit</a></td>
              <td><a href="#" class="delete">Delete</a></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Jorge</td>
              <td>Author</td>
              <td><a href="#" class="edit">Edit</a></td>
              <td><a href="#" class="delete">Delete</a></td>

            </tr>
          </tbody>
        </div>
      </div>


      <!-- Admin Content -->
    </div>

    <!-- Admin Page Wrapper -->

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>

    <!-- Ck Editor -->        

    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>

    <!-- Java Script-->

    <script src="../../assets/js/scripts.js"></script>
  </body>
</html>
