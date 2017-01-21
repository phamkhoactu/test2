 <table class="table table-bordered table-hover">
    <thead>
        <tr>
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
        $query = "SELECT * FROM comments";
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
            echo "<td>{$comment_date }</td>";  
            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='comments.php?unapproved=$comment_id'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
            echo "</tr>";

        }
        ?>
    </tbody>
</table>


<?php 
if(isset($_GET['approve'])){
    $comment_id_to_approve = $_GET['approve'] ; 
    $query = "UPDATE comments SET comment_status='Approved'  WHERE comment_id={$comment_id_to_approve}";

    $approved_query = mysqli_query($cnn,$query);
    confirm($approved_query);
    header("Location: comments.php");
}

if(isset($_GET['unapproved'])){
    $comment_id_to_unapprove = $_GET['unapproved'] ; 
    $query = "UPDATE comments SET comment_status='Unapproved'  WHERE comment_id={$comment_id_to_unapprove}";

    $unapproved_query = mysqli_query($cnn,$query);
    confirm($unapproved_query);
    header("Location: comments.php");
}

if(isset($_GET['delete'])){
    $comment_id_to_delete = $_GET['delete'] ; 
    $query = "DELETE FROM comments WHERE comment_id={$comment_id_to_delete}";

    $delete_query = mysqli_query($cnn,$query);
    confirm($delete_query);
    header("Location: comments.php");
}
?> 