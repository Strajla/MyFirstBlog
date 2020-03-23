<?php include("../../path.php") ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");
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
  <title>Admin Section - Manage Posts</title>

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
        <a href="createPost.php" class="btn btn-big">Add Post</a>
        <a href="indexPosts.php" class="btn btn-big">Manage Posts</a>
      </div>

      <div class="content">
        <h2 class="page-title">Manage Posts</h2>


        <?php include(ROOT_PATH . "/app/includes/messages.php") ?>

        <table>
          <thead>
            <th>SN</th>
            <th>Title</th>
            <th>Author</th>
            <th colspan="3">Action</th>
          </thead>

          <tbody>


            <!-- Looping trough what we got from DB -->
            <?php foreach ($posts as $key => $post) : ?>
              <tr>
                <!-- Key starts from 0 sto we are adding +1 so he can start countgin -->
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $post['title'] ?></td>
                <td><?php echo $_SESSION['username']; ?></td>
                <!-- We need id bcs we are fetching post from the db, so we can edit that particu
              <!-- When we click on id button we are sending ID variable to URL and sending it to editPhp file -->
                <td><a href="editPost.php?id=<?php echo $post['id']; ?>" class="edit">Edit</a></td>
                <td><a href="editPost.php?delete_id=<?php echo $post['id']; ?>" class="delete">Delete</a></td>


                <?php if ($post['published']) : ?>

                  <!-- If we want to unpuslibh the post we need to know that post, by that i mean ID, we need published variable so we can unpublish it -->
                  <!-- 0 stand for false and 1 for true -->
                  <td><a href="editPost.php?published=0&p_id=<?php echo $post['id'] ?>" class="unpublish">Unpublish</a></td>
                <?php else : ?>
                  <td><a href="editPost.php?published=1&p_id=<?php echo $post['id'] ?>"" class=" publish">Publish</a></td>
                <?php endif; ?>

              </tr>

            <?php endforeach; ?>




          </tbody>

        </table>

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