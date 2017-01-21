
<?php include "includes/admin_header.php" ?>
<div id="wrapper">
 <!-- Navigation -->
 <?php include "includes/admin_navigation.php" ?>      

 <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading --> 
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin Page
                    <small>Author</small>
                </h1>


 <?php 
if(isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $commentValueID) {
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options){
            case 'Approved':
            $query = "UPDATE comments SET comment_status='{$bulk_options}' WHERE comment_id={$commentValueID} ";
            $update_to_approve_status = mysqli_query($cnn,$query);

            break;
            case 'unapprove':
            $query = "UPDATE comments SET comment_status='{$bulk_options}' WHERE comment_id={$commentValueID} ";
            $update_to_unapprove_status = mysqli_query($cnn,$query);

            break;
            case 'delete':
            $query = "DELETE FROM comments WHERE comment_id={$commentValueID} ";
            $delete_comments = mysqli_query($cnn,$query);

            break;  
            case 'clone':
            $query = "SELECT * FROM comments WHERE comment_id={$commentValueID} ";
            $select_comment_query = mysqli_query($cnn,$query);
            while ($row = mysqli_fetch_array($select_comment_query)) {
                 $comment_id =  $row['comment_id'];
            $comment_post_id =  $row['comment_post_id'];
            $comment_author =  $row['comment_author'];
            $comment_content =  $row['comment_content'];
            $comment_email =  $row['comment_email'];
            $comment_date =  $row['comment_date'];
            $comment_status =  $row['comment_status'];
            }
            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_content, comment_email, comment_status,comment_date) ";
            
            $query .= "VALUES ('{$comment_post_id}', '{$comment_author}', '{$comment_content}', '{$comment_email}', '{$comment_status}','{$comment_date}')";
            $copy_query = mysqli_query($cnn,$query);
            if(!$copy_query){
                die("QUERY FAILED" . mysqli_error($cnn));
            }
            break;           
        }

    }
}
?>
<form method="POST">
    <table class="table table-bordered table-hover">
         <div id="bulkOptionsContainer" class="form-group col-xs-4">
            <select class="form-control" name="bulk_options">
                <option value="Select Options">Select Options</option>
                <option value="Approved">Approved</option>
                <option value="unapprove">Unapprove</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                
            </select>
        </div>
        <div class="form-group col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox" name="" value=""></th>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>



        <?php 
        $query = "SELECT * FROM comments WHERE comment_post_id=". mysqli_real_escape_string($cnn,$_GET['id'])." ";
        $select_comments = mysqli_query($cnn,$query);

        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id =  $row['comment_id'];
            $comment_post_id =  $row['comment_post_id'];
            $comment_author =  $row['comment_author'];
            $comment_content =  $row['comment_content'];
            $comment_email =  $row['comment_email'];
            $comment_date =  $row['comment_date'];
            $comment_status =  $row['comment_status'];
            echo "<tr>";
            ?>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td>
            <?php
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";



            $query = "SELECT * FROM posts WHERE post_id =$comment_post_id";
            $select_post_id_query = mysqli_query($cnn,$query);
            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id =  $row['post_id'];
                $post_title =  $row['post_title'];
                echo "<td><a href='../post.php?post_id=$post_id'>{$post_title}</a></td>";
            }
            
            $id =  $_GET['id'];
            echo "<td>{$comment_date }</td>";  
            echo "<td><a href='post_comments.php?approve=$comment_id&id=". $_GET['id'] ."'>Approve</a></td>";
            echo "<td><a href='post_comments.php?unapproved=$comment_id&id=".$_GET['id']."'>Unapprove</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='post_comments.php?delete=$comment_id&id=".$_GET['id']."'>Delete</a></td>";
            echo "</tr>";

        }
        ?>
    </tbody>
</table>
    </form>


<?php 
if(isset($_GET['approve'])){
    $comment_id_to_approve = $_GET['approve'] ; 
    $query = "UPDATE comments SET comment_status='Approved'  WHERE comment_id={$comment_id_to_approve}";

    $approved_query = mysqli_query($cnn,$query);
    confirm($approved_query);
    header("Location: post_comments.php?id=".$_GET['id']);
}

if(isset($_GET['unapproved'])){
    $comment_id_to_unapprove = $_GET['unapproved'] ; 
    $query = "UPDATE comments SET comment_status='Unapproved'  WHERE comment_id={$comment_id_to_unapprove}";

    $unapproved_query = mysqli_query($cnn,$query);
    confirm($unapproved_query);
    header("Location: post_comments.php?id=".$_GET['id']);
}

if(isset($_GET['delete'])){
    $comment_id_to_delete = $_GET['delete'] ; 
    $query = "DELETE FROM comments WHERE comment_id={$comment_id_to_delete}";

    $delete_query = mysqli_query($cnn,$query);
    confirm($delete_query);
    header("Location: post_comments.php?id=".$_GET['id']);
}
?> 

         </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div> 
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>