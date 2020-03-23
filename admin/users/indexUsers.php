<?php include("../../path.php"); ?>
<!-- Here we are including users.php form controllers bcs that is the place where session starts, in order to dislpay messages we need to start session -->
<?php include(ROOT_PATH . "/app/controllers/users.php");
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/0016173d9b.js" crossorigin="anonymous"></script>

  <!-- Google Fonts -->

  <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet" />

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

        <?php include(ROOT_PATH . "/app/includes/messages.php") ?>


        <table>
          <thead>
            <th>SN</th>
            <th>Username</th>
            <th>Email adress</th>
            <th colspan="2">Action</th>
          </thead>

          <tbody>

            <!-- Loopping trough all users, and for each user i will display this table row -->
            <?php foreach ($admin_users   as $key => $user) : ?>

              <tr>
                <!-- Displaying the key, he will be counter, he starts from 1 -->
                <td><?php echo $key + 1; ?></td>
                <!-- Displaying name -->
                <td><?php echo $user['username']; ?></td>
                <!-- Displaying email from admin user -->
                <td><?php echo $user['email']; ?></td>
                <td><a href="editUser.php?id=<?php echo $user['id']; ?>" class="edit">Edit</a></td>
                <!-- We will redirect user to the same page and delete user using his ID -->
                <td><a href="indexUsers.php?delete_id=<?php echo $user['id']; ?>" class="delete">Delete</a></td>
              </tr>

            <?php endforeach; ?>


          </tbody>
      </div>
    </div>


    <!-- Admin Content -->
  </div>

  <!-- Admin Page Wrapper -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <!-- Ck Editor -->

  <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>

  <!-- Java Script-->

  <script src="../../assets/js/scripts.js"></script>
</body>

</html>