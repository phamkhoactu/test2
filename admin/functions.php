<?php 

function users_online(){
  global $cnn;
      $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;
    $query = "SELECT * FROM users_online WHERE session = '$session' ";
    $send_query = mysqli_query($cnn,$query);
    $count = mysqli_num_rows($send_query);

    if($count == NULL){
        mysqli_query($cnn,"INSERT INTO users_online(session,time) VALUES ('$session','$time')");
    } else {
        mysqli_query($cnn,"UPDATE users_online SET time = '$time' WHERE session = '$session'"); 
    }

    $user_online_query = mysqli_query($cnn,"SELECT * FROM users_online WHERE time > '$time_out' ");

   return $count_user = mysqli_num_rows($user_online_query);



}



function confirm($result){
    global $cnn;
    if(!$result){
        die("QUERY FAILED". mysqli_error($cnn));
    }

}


function insertCategories(){
  global $cnn;
  if (isset($_POST['cat_title_submit'])) {
    $cat_title = $_POST['cat_title'];
    if($cat_title == "" || empty($cat_title)){
        echo "NULL";
    } else
    {
        $query = "INSERT INTO categories(cat_title) ";
        $query .= " VALUE ('{$cat_title}') ";

        $create_category_query = mysqli_query($cnn,$query);
        if(!$create_category_query){
            die('QUERY FAILED' . mysqli_error($cnn));
        }
    }


}
}

function findAllCategories(){
	global $cnn;
 $query = "SELECT * FROM categories ";
 $select_categories = mysqli_query($cnn,$query);

 while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id =  $row['cat_id'];
    $cat_title =  $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "</tr>";
}
}

function deleteCategories(){
	global $cnn;
  if (isset($_GET['delete'])) {
   $cat_id_to_delete = $_GET['delete'];
   $query = "DELETE FROM categories WHERE cat_id={$cat_id_to_delete} ";
   $delete_query = mysqli_query($cnn,$query);
   header("Location: categories.php");
} 
}

?>