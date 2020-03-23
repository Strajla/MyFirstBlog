<?php
include("path.php");
include(ROOT_PATH . "../app/controllers/topics.php");

$posts = array();
$postsTitle = 'Recent Posts';


// When we are sending the ID of the topic, i will send the name of the topic aswell
// If the topic id, is set then our posts will be all posts belonging to that topic, switching search to else if, so that we can have one or another
if (isset($_GET['t_id'])) {
  $posts = getPostsByTopicId($_GET['t_id']);
  $postsTitle = "You searched for posts under '" . $_GET['name'] . "'";
  // Checking if search term exist in the posts array
} else if (isset($_POST['search-term'])) {
  $postsTitle = "You searched for '" . $_POST['search-term'] . "'";
  $posts = searchPosts($_POST['search-term']);
} else {
  $posts = getPublishedPosts();
}

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

  <title>BLOG</title>
</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
  <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

  <div class="page-wrapper">
    <!-- Post Slider     -->

    <div class="post-slider">
      <h1 class="slider-title">Trending Posts</h1>
      <i class="fas fa-chevron-left prev"></i>
      <i class="fas fa-chevron-right next"></i>

      <div class="post-wrapper">

        <?php foreach ($posts as $post) : ?>
          <div class="post">
            <!-- Pointing to the root folder where the images are stored, and we will just point to the name of the image from DB -->
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="slider-image" />
            <div class="post-info">
              <h4>
                <!-- We are sending variable called ID, bcs we will be fetching post from DB using ID of that particular post -->
                <a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
              </h4>
              <i class="far fa-user"><?php echo $post['username']; ?></i>
              &nbsp;
              <!-- Calling string to time function and pasing the date when the post is created, and it will display it in certain format -->
              <i class="far fa-calendar"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
            </div>
          </div>

        <?php endforeach; ?>


      </div>
    </div>

    <!-- Post Slider -->

    <!-- Content -->

    <div class="content clearfix">
      <div class="main-content">
        <h1 class="recent-post-title"><?php echo $postsTitle ?></h1>

        <?php foreach ($posts as $post) : ?>
          <div class="post clearfix">
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="post-image" />
            <div class="post-preview">
              <h2>
                <a href="single.php?id=<?php echo $post['id']; ?> "><?php echo $post['title']; ?><a />
              </h2>
              <i class="far fa-user"><?php echo $post['username']; ?></i>
              &nbsp;
              <i class="far fa-calendar"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
              <p class="preview-text">
                <!-- With use of this function we are able to display as much characters we want in the case lets say 150 -->
                <?php echo html_entity_decode(substr($post['body'], 0, 250) . '...'); ?>
              </p>
              <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>
            </div>
          </div>
        <?php endforeach; ?>


      </div>

      <div class="sidebar">
        <div class="section search">
          <h2 class="section-title">Search</h2>
          <form action="index.php" method="post">
            <input type="text" name="search-term" class="text-input" placeholder="Search..." />
          </form>
        </div>

        <div class="section topics">
          <h2 class="section-title">Topics</h2>
          <ul>
            <!-- $topics is array of arrays -->
            <?php foreach ($topics as $key => $topic) : ?>
              <!-- Attaching another variable using & -->
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
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