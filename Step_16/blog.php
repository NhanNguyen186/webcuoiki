<?php  
include "admin/includes/database.php";
include "admin/includes/subscriber.php";
include "admin/includes/blogs.php";
include "admin/includes/tags.php";
include "admin/includes/comments.php";
$database = new database();
$db = $database->connect();

$new_comment = new comment($db);
$new_tag = new tag($db);      
$new_blog = new blog($db);

$new_blog->n_blog_post_id = $_GET['id'];
$new_blog->read_single();

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['email'])!=""){
        $new_subscribe = new subscribe($db);
        $new_subscribe->v_sub_email = $_POST['email'];
        $new_subscribe->d_date_created = date('y-m-d',time());
        $new_subscribe->d_time_created = date('h:i:s',time());
        $new_subscribe->f_sub_status = 1;
        $new_subscribe->create();
    }

    if(isset($_POST['submit_comment'])){
        $new_comment->n_blog_comment_parent_id = 0;
        $new_comment->n_blog_post_id = $_GET['id'];
        $new_comment->v_comment_author = $_POST['c_name'];
        $new_comment->v_comment_author_email = $_POST['c_email'];
        $new_comment->v_comment = $_POST['c_message'];
        $new_comment->d_date_created = date('y-m-d',time());
        $new_comment->d_time_created = date('h:i:s',time());
        $new_comment->create();
    }

    if(isset($_POST['submit_comment_reply'])){
        $new_comment->n_blog_comment_parent_id = $_POST['blog_comment_id'];
        $new_comment->n_blog_post_id = $_GET['id'];
        $new_comment->v_comment_author = $_POST['c_name_reply'];
        $new_comment->v_comment_author_email = $_POST['c_email_reply'];
        $new_comment->v_comment = $_POST['c_message_reply'];
        $new_comment->d_date_created = date('y-m-d',time());
        $new_comment->d_time_created = date('h:i:s',time());
        $new_comment->create();
        
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

<body id="top" onload="hide_form_reply()">

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
    include "content_blog.php";
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

    <script type="text/javascript">
     var blog_comment_id;

     function reply_comment(comment_id){
        blog_comment_id = comment_id;
        document.getElementById("respond").style.display = "none";
        document.getElementById("reply").style.display = "block";
     }

     function hide_form_reply(){
        document.getElementById("reply").style.display = "none";
     }

     function check_respond(){
       if(document.c_form.c_name.value == ""){
        alert("Author name is not empty!");
        document.c_form.c_name.focus();
        return false;
       }
       if(document.c_form.c_email.value == ""){
        alert("Author email is not empty!");
        document.c_form.c_email.focus();
        return false;
       }
       if(document.c_form.c_message.value == ""){
        alert("Author message is not empty!");
        document.c_form.c_message.focus();
        return false;
       }
       return true;     

     }

     function check_reply(){
       
       if(document.c_form_reply.c_name_reply.value == ""){
        alert("Author name is not empty!");
        document.c_form_reply.c_name_reply.focus();
        return false;
       }
       if(document.c_form_reply.c_email_reply.value == ""){
        alert("Author email is not empty!");
        document.c_form_reply.c_email_reply.focus();
        return false;
       }
       if(document.c_form_reply.c_message_reply.value == ""){
        alert("Author message is not empty!");
        document.c_form_reply.c_message_reply.focus();
        return false;
       }
       document.c_form_reply.blog_comment_id.value = blog_comment_id;
       return true;     

     }
    </script>

</body>

</html>