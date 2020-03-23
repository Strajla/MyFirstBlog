<?php include("path.php"); ?>
<!-- We are icnluding posts file bcs we need conection with DB -->
<?php include(ROOT_PATH . '/app/controllers/posts.php');

// Fetching id from GET SUPERGLOBAL USING URL, and the name of the variable as key

// Checking to see if the ID exists in our GET request
if (isset($_GET)) {
  $post = selectOne('posts', ['id' => $_GET['id']]);
}

// Fetching all topics from db, and making them avilable in the single part of the page
$topics = selectAll('topics');
// Fetching all posts that own value of true in published or unpublished checkbox
$posts = selectAll('posts', ['published' => 1]);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <script src="https://kit.fontawesome.com/0016173d9b.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css" />

  <title><?php echo $post['title']; ?> | MyFirstBlog</title>
</head>

<body>
  <!-- Facebook Plugin SDK -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v5.0"></script>
  <!-- Facebook Plugin SDK -->

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <div class="page-wrapper">
    <!-- Content -->

    <div class="content clearfix">
      <!-- Main Content  Wrapper-->
      <div class="main-content-wrapper">
        <div class="main-content single">
          <h1 class="post-title"><?php echo $post['title']; ?> </h1>

          <div class="post-content">
            <?php echo html_entity_decode($post['body']); ?>
          </div>
        </div>
      </div>
      <!-- Main Content  Wrapper-->
      <!-- Sidebar -->

      <div class="sidebar single">
        <div class="fb-page" data-href="https://www.facebook.com/Code.org/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
          <blockquote cite="https://www.facebook.com/Code.org/" class="fb-xfbml-parse-ignore">
            <a href="https://www.facebook.com/Code.org/">Code.org</a>
          </blockquote>
        </div>

        <div class="section popular">
          <h2 class="section-title">Popular</h2>


          <?php foreach ($posts as $singlePost) : ?>
            <div class="post clearfix">
              <img src="<?php echo BASE_URL . '/assets/images/' . $singlePost['image']; ?>" alt="" class="post-image" />
              <a href="" class="title">
                <h4><?php echo $singlePost['title']; ?></h4>
              </a>
            </div>
          <?php endforeach; ?>

          <div class="section topics">
            <h2 class="section-title">Topics</h2>
            <ul>

              <!-- Looping trough topics and displaying them from DB -->
              <?php foreach ($topics as $topic) : ?>
                <!-- This means topic id -->
                <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

        <!-- Sidebar -->
      </div>

      <!-- Content -->
    </div>

    <!-- Footer -->

    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

    <!-- Footer -->

    <!-- JQ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Slick -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Java Script -->
    <script src="assets/js/scripts.js"></script>
</body>

</html>