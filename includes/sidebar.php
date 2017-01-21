<div class="col-md-4">

  <!-- Blog Search Well -->
  <div class="well">
    <h4>Tìm Kiếm</h4>
    <form action="search.php" method="post" accept-charset="utf-8">
     <div class="input-group">
      <input type="text" name="search" class="form-control">
      <span class="input-group-btn">
        <button name="submit" class="btn btn-default" type="submit">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </span>
    </div>
  </form>

  <!-- /.input-group -->
</div>

<!-- Login -->
<div class="well">
  <h4>Đăng Nhập</h4>
  <form action="includes/login.php" method="post" accept-charset="utf-8">
   <div class="form-group">
    <input type="text" name="username" class="form-control" placeholder="Enter Username">
  </div>
  <div class="input-group">
    <input class="form-control" type="password" name="password" placeholder="Enter Password">
    <span class="input-group-btn">
      <button class="btn btn-primary" name="login" type="submit">
        OK
      </button>
    </span>
  </div>
  <hr>
  <div class="form-group">
    <a class=" form-control btn btn-danger" href="registration.php" title="">Đăng Ký</a>
  </div>
</form>

<!-- /.input-group -->
</div>







<!-- Blog Categories Well -->
<div class="well">
  <?php 
  $query = "SELECT * FROM categories ";
  $select_categories_sidebar = mysqli_query($cnn,$query);
  ?>
  <h4>Blog Categories</h4>
  <div class="row">
    <div class="col-lg-12">
      <ul class="list-unstyled">
        <?php 
        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
          $cat_id =  $row['cat_id'];
          $cat_title =  $row['cat_title'];
          echo "<li>
          <a href='category.php?id={$cat_id}'>{$cat_title}</a>
        </li>";
      } ?>

    </ul>
  </div>

  <!-- /.col-lg-6 -->




  <!-- /.col-lg-6 -->
</div>
<!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>
