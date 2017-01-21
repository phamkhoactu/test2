<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">
  <div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <?php
      if(isset($_GET['post_id'])){
      $post_id = $_GET['post_id'];
      $post_author_name = $_GET['author'];
      }
      $query = "SELECT * FROM posts WHERE post_user= '{$post_author_name}'";
      $select_all_posts_query = mysqli_query($cnn,$query);
      while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
      $post_title =  $row['post_title'];
      $post_user =  $row['post_user'];
      $post_date =  $row['post_date'];
      $post_image =  $row['post_image'];
      $post_content =  $row['post_content'];
      ?>
      <!-- First Blog Post -->
      <h2>
      <a href=""><?php echo $post_title; ?></a>
      </h2>
      <p class="lead">All post by <?php echo $post_author; ?>
      </p>
      <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
      <hr>
      <img class="img-responsive" src="images/<?php echo $post_image;  ?>" alt="">
      <hr>
      <p><?php  echo $post_content; ?></p>
      <hr>
      <?php        } ?>
      
      
      
    </div>
    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>
  </div>
  <!-- /.row -->
  <hr>
  <?php include "includes/footer.php" ?>