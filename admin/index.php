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
                    <small><?php echo $_SESSION['username']; ?></small>
                   
                    
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $select_all_post = mysqli_query($cnn,$query);
                                    $post_counts = mysqli_num_rows($select_all_post);
                                    echo "<div class='huge'>{$post_counts}</div>";
                                    ?>
                                    
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($cnn,$query);
                                    $comment_counts = mysqli_num_rows($select_all_comments);
                                    echo "<div class='huge'>{$comment_counts}</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($cnn,$query);
                                    $user_counts = mysqli_num_rows($select_all_users);
                                    echo "<div class='huge'>{$user_counts}</div>";
                                    ?>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list-ul fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $select_all_categories = mysqli_query($cnn,$query);
                                    $categories_counts = mysqli_num_rows($select_all_categories);
                                    echo "<div class='huge'>{$categories_counts}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            $query = "SELECT * FROM posts WHERE post_status ='published'";
            $select_all_published_post = mysqli_query($cnn,$query);
            $post_published_counts = mysqli_num_rows($select_all_published_post);

            $query = "SELECT * FROM posts WHERE post_status ='draft'";
            $select_all_draft_post = mysqli_query($cnn,$query);
            $post_draft_counts = mysqli_num_rows($select_all_draft_post);

            $query = "SELECT * FROM comments WHERE comment_status ='unapproved'";
            $select_all_unapproved_comment = mysqli_query($cnn,$query);
            $comment_unapproved_counts = mysqli_num_rows($select_all_unapproved_comment);

            $query = "SELECT * FROM users WHERE user_role LIKE '%crib%'";
            $select_all_subscribers = mysqli_query($cnn,$query);
            $user_subscribers_counts = mysqli_num_rows($select_all_subscribers);
            
            ?>
            <div class="row">
                <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Date', 'Count'],
                <?php
                $elements_text = ['All Posts','Published Posts','Draft Posts','Comments','Unapproved Comments','Users','Subscribers','Categories'];
                $elements_count = [$post_counts,$post_published_counts,$post_draft_counts,$comment_counts,$comment_unapproved_counts,$user_counts,$user_subscribers_counts,$categories_counts];
                for($i =0; $i<8 ; $i++){
                echo "['{$elements_text[$i]}',$elements_count[$i]]"."," ;
                }
                ?>
                
                ]);
                var options = {
                chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                }
                };
                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                chart.draw(data, options);
                }
                </script>
                <div id="columnchart_material" style=" width: 'auto'; height: 500px"></div>
                
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    
    <?php include "includes/admin_footer.php" ?>