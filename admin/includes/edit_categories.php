


<form action="" method="POST">
  <div class="form-group">
    <label for="cat_title_edit">Edit Category</label>
    <?php 
                            // display title to edit
    if (isset($_GET['edit'])) {
      $cat_id_to_edit = $_GET['edit'];
      $query = "SELECT * FROM categories WHERE cat_id ={$cat_id_to_edit} ";
      $select_categories_id = mysqli_query($cnn,$query);
      while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_id =  $row['cat_id'];
        $cat_title =  $row['cat_title'];

        ?>
        <input value="<?php if (isset($cat_title)) {echo $cat_title;} ?>" class="form-control" type="text" name="cat_title_edit">

        <?php  } } ?>

        <?php 
        if (isset($_POST['cat_title_edit_submit'])) {
         $cat_title_to_edit = $_POST['cat_title_edit'];
         $query = "UPDATE categories SET cat_title = '{$cat_title_to_edit}' WHERE cat_id={$cat_id} ";
         $edit_query = mysqli_query($cnn,$query);
         if(!$edit_query){
          die("QUERY FAILED". mysqli_error($cnn));
        }
        header("Location: categories.php");
      }
      ?>

    </div>

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="cat_title_edit_submit" value="Edit Category">
    </div>
  </form>   