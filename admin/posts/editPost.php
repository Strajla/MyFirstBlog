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
  <title>Admin Section - Edit Post</title>

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
        <h2 class="page-title">Edit Post</h2>

        <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

        <!-- Adding multipart/form-data bcs we will upload image here aswell -->
        <form action="editPost.php" method="post" enctype="multipart/form-data">

          <!-- This will be the gidden input field bcs ID of the post is remaining the same, user wont be able to change id of the post -->
          <input type="hidden" name="id" value="<?php echo $id ?>" />

          <!--  -->

          <div>
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title ?>" class="text-input" />
          </div>
          <div>
            <label>Body</label>
            <textarea name="body" id="body"><?php echo $body ?></textarea>
          </div>

          <div>
            <label>Image</label>
            <input type="file" name="image" class="text-input" />
          </div>
          <div>
            <label>Topic</label>
            <select name="topic_id" class="text-input">
              <option value=""></option>
              <!-- Looping trough topics array that we fetch in our db, for each topic we will display option and value of option, we will print name of the topic -->
              <?php foreach ($topics as $key => $topic) : ?>

                <!-- Checking if the variable topic_id is not empty, which means that user selected it before
                   and we are checking if the topic they selected is the same as thss particular topic in the topic array that we are looping over -->
                <?php if (!empty($topic_id) && $topic_id == $topic['id']) : ?>
                  <option selected value="<?php echo $topic['id']; ?>"> <?php echo $topic['name']; ?> </option>
                <?php else : ?>
                  <option value="<?php echo $topic['id']; ?>"> <?php echo $topic['name']; ?> </option>
                <?php endif; ?>


              <?php endforeach; ?>

            </select>
          </div>
          <div>
            <!-- If its published we will display the publish field  without checking it-->
            <?php if (empty($published) && $published == 0) : ?>
              <label>
                <input type="checkbox" name="published">
                Publish
              </label>
            <?php else : ?>
              <label>
                <input type="checkbox" name="published" checked>
                Publish
              </label>
            <?php endif; ?>
          </div>
          <button type="submit" name="update-post" class="btn btn-big">Update post</button>
      </div>
      </form>

      <script>
        ClassicEditor.create(document.querySelector("#body"), {
          toolbar: [
            "heading",
            "|",
            "bold",
            "italic",
            "link",
            "bulletedList",
            "numberedList",
            "blockQuote"
          ],
          heading: {
            options: [{
                model: "paragraph",
                title: "Paragraph",
                class: "ck-heading_paragraph"
              },
              {
                model: "heading1",
                view: "h1",
                title: "Heading 1",
                class: "ck-heading_heading1"
              },
              {
                model: "heading2",
                view: "h2",
                title: "Heading 2",
                class: "ck-heading_heading2"
              }
            ]
          }
        }).catch(error => {
          console.log(error);
        });
      </script>
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