 <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname </th>
            <th>Email</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subcriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>



        <?php 
        $query = "SELECT * FROM users";
        $select_comments = mysqli_query($cnn,$query);
        while ($row = mysqli_fetch_assoc($select_comments)) {
            $user_id =  $row['user_id'];
            $username =  $row['username'];
            $user_firstname =  $row['user_firstname'];
            $user_lastname =  $row['user_lastname'];
            $user_email =  $row['user_email'];
            $user_role =  $row['user_role'];
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";



            // $query = "SELECT * FROM posts WHERE post_id =$comment_post_id";
            // $select_post_id_query = mysqli_query($cnn,$query);
            // while ($row = mysqli_fetch_assoc($select_post_id_query)) {
            //     $post_id =  $row['post_id'];
            //     $post_title =  $row['post_title'];
            //     echo "<td><a href='../post.php?post_id=$post_id'>{$post_title}</a></td>";
            // }
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subcriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";

        }
        ?>
    </tbody>
</table>


<?php 
if(isset($_GET['change_to_admin'])){
    $user_id_to_change = $_GET['change_to_admin'] ; 
    $query = "UPDATE users SET user_role='admin'  WHERE user_id={$user_id_to_change}";

    $change_query = mysqli_query($cnn,$query);
    confirm($change_query);
    header("Location: users.php");
}

if(isset($_GET['change_to_sub'])){
    $user_id_to_change = $_GET['change_to_sub'] ; 
    $query = "UPDATE users SET user_role='subcriber'  WHERE user_id={$user_id_to_change}";

    $change_query = mysqli_query($cnn,$query);
    confirm($change_query);
    header("Location: users.php");
}

if(isset($_GET['delete'])){
    $user_id_to_delete = $_GET['delete'] ; 
    $query = "DELETE FROM users WHERE user_id={$user_id_to_delete}";

    $delete_query = mysqli_query($cnn,$query);
    confirm($delete_query);
    header("Location: users.php");
}
?> 