<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/topics.php"); ?>
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
    <title>Admin Section - Add Topic</title>

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
          <a href="createTopic.php" class="btn btn-big">Add Topics</a>
          <a href="indexTopics.php" class="btn btn-big">Manage Topics</a>
        </div>

        <div class="content">
          <h2 class="page-title">Add Topic</h2>

          <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

          <form action="createTopic.php" method="post">
            <div>
              <label>Name</label>
              <input type="text" name="name" value= "<?php echo $name ?>" class="text-input" />
            </div>

            <div>
              <label>Description</label>
              <textarea name="description" id="body"></textarea>
            </div>
            <div>
              <button type="submit" name="add-topic" value= "<?php echo $description ?>" class="btn btn-big">Add Topic</button>
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
                options: [
                  {
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
