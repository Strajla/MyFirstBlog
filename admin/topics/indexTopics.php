<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/topics.php");
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
  <title>Admin Section - Manage Topics</title>

  <!-- CK EDITOR -->

  <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/adminHeader.php");  ?>

  <!-- Admin Page Wrapper -->
  <div class="admin-wrapper">

    <?php include(ROOT_PATH . "/app/includes/adminSidebar.php");  ?>


    <!-- Admin Content -->


    <div class="admin-content">
      <div class="button-group">
        <a href="createTopic.php" class="btn btn-big">Add Topic</a>
        <a href="indexTopics.php" class="btn btn-big">Manage Topic</a>
      </div>

      <div class="content">
        <h2 class="page-title">Manage Topics</h2>

        <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

        <table>
          <thead>
            <th>SN</th>
            <th>Name</th>
            <th colspan="2">Action</th>
          </thead>
          <!-- We are going to loop trough topics from db, and display table row for each of the records -->
          <tbody>
            <?php foreach ($topics as $key => $topic) : ?>
              <tr>
                <!-- They key starts counting from zero, we will display key plus one -->
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $topic['name']; ?></td>
                <td><a href="editTopic.php?id=<?php echo $topic['id']; ?>" class="edit">Edit</a></td>
                <!-- It will splend the id called delete id and it will take topic id and send it as GET request and reconect it to indexTopics.php -->
                <td><a href="indexTopics.php?del_id=<?php echo $topic['id']; ?>" class="delete">Delete</a></td>
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