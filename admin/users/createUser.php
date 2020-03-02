<?php include("../../path.php") ?>
<?php include (ROOT_PATH . "/app/controllers/users.php") ?>
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
    <title>Admin Section - Add Users</title>

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
          <a href="createUser.php" class="btn btn-big">Add User</a>
          <a href="indexUsers.php" class="btn btn-big">Manage Users</a>
        </div>

        <div class="content">
          <h2 class="page-title">Add User</h2>

          <!-- Here we are including errors from helpers folder so if, user provides empty fileds, he will get error messages -->
          <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

          <form action="createUser.php" method="post">
          
            <!-- WE will add value to each input field, and echo the info from form so that the data user provided will still be avilable after refreshing the page -->
          <div>
                <label>Username</label>
                <input type="text" name="username" value = "<?php echo $username; ?>" class="text-input" />
              </div>
      
              <div>
                <label>Email</label>
                <input type="email" name="email" value = "<?php echo $email; ?>" class="text-input" />
              </div>
      
              <div>
                <label>Password</label>
                <input type="password" name="password" value = "<?php echo $password; ?>" class="text-input" />
              </div>
      
              <div>
                <label>Password Confirmation</label>
                <input type="password" name="passwordConf" class="text-input" />
              </div>

              <div>
                <!-- Since this value is boolena we are checking if admin value is set and admin variable is true, it will be checked it fill remain checked -->
                <?php if (isset($admin) && $admin ==1) : ?>
                  <label>    
                  <input type="checkbox" name = "admin" checked>
                    Admin               
                  </label>        
                <?php else: ?>
                  <label>    
                  <input type="checkbox" name = "admin">
                    Admin               
                  </label> 
          <div>
                <?php endif; ?>  
              </div>
              <button type="submit" name = "create-admin" class="btn btn-big">Add User</button>
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
