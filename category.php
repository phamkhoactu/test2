<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
           <h1 class="page-header">
          <?php
          if (isset($_GET['id'])) {
         $cat_id = $_GET['id'];
        }
        $query = "SELECT cat_title FROM categories WHERE cat_id=$cat_id";
         $select_cat_title_query = mysqli_query($cnn,$query);
         $row = mysqli_fetch_assoc($select_cat_title_query);
         $cat_title = $row['cat_title'];
           ?> 
                Danh Mục
                <small><?php echo $cat_title; ?></small>
            </h1>
        <?php 
        if (isset($_GET['id'])) {
         $cat_id = $_GET['id'];
        }
        $query = "SELECT * FROM posts WHERE post_category_id=$cat_id";

        $select_all_posts_query = mysqli_query($cnn,$query);

        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
            $post_id =  $row['post_id'];
         $post_title =  $row['post_title'];
         $post_author =  $row['post_author'];
         $post_date =  $row['post_date'];
         $post_image =  $row['post_image'];
         $post_content = substr($row['post_content'],0,200);

         ?>



         <!-- First Blog Post -->
         <h2>
            <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
            by <a href="index.php"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image;  ?>" alt="">
        <hr>
        <p><?php  echo $post_content; ?></p>
        <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

        <?php        } ?>


    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php" ?>



</div>
<!-- /.row -->

<hr>

<?php include "includes/footer.php" ?>