<?php  
include "admin/includes/database.php";
include "admin/includes/subscriber.php";
include "admin/includes/blogs.php";
include "admin/includes/tags.php";

$database = new database();
$db = $database->connect();

$new_tag = new tag($db);      
$new_blog = new blog($db);

$new_blog->n_category_id = $_GET['id'];
$rs_blog = $new_blog->read_single_category();


if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['email'])!=""){
        $new_subscribe = new subscribe($db);
        $new_subscribe->v_sub_email = $_POST['email'];
        $new_subscribe->d_date_created = date('y-m-d',time());
        $new_subscribe->d_time_created = date('h:i:s',time());
        $new_subscribe->f_sub_status = 1;
        $new_subscribe->create();
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>My Blogs</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script defer src="js/fontawesome/all.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>

<body id="top">

    <!-- preloader
    ================================================== -->
    <div id="preloader"> 
    	<div id="loader"></div>
    </div>

    <!-- header
    ================================================== -->
    <?php 
       include "header_categories.php";
    ?> <!-- end s-header -->

    <!-- content
    ================================================== -->
    <?php  
    include "content_categories.php";
    ?> <!-- end s-content -->

    <!-- footer
    ================================================== -->
    <?php 
    include "footer.php";
    
    ?> <!-- end s-footer -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>

</html>