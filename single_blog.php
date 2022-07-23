<?php  
include "admin/includes/database.php";
include "admin/includes/subscriber.php";
include "admin/includes/blogs.php";
include "admin/includes/tags.php";
include "admin/includes/comments.php";
include 'admin/includes/categories.php';
$database = new database();
$db = $database->connect();

$new_comment = new comment($db);
$new_tag = new tag($db);      
$new_blog = new blog($db);

$new_blog->n_blog_post_id = $_GET['id'];
$new_blog->read_single();

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['submit_subscribe'])!=""){
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
<html lang="en">
<head>
    <title>Xem bài viết</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body onload="hide_form_reply();">
<div class="outer-container">
    <?php include 'header.php' ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-header flex justify-content-center align-items-center" style="background-image: url('images/toty.jpg')">
                    <h1>Nhan Nguyen</h1>
                </div><!-- .page-header -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .hero-section -->

    <div class="container single-page blog-page">
        <div class="row">
            <div class="col-12">
                <div class="content-wrap">
                    <header class="entry-header">
                        <div class="posted-date">
                            <?php echo $new_blog->d_date_created ?>
                        </div><!-- .posted-date -->

                        <h2 class="entry-title"><?php echo $new_blog->v_post_title ?></h2>

                        <div class="tags-links">
                            <a href="#">#winter</a>
                            <a href="#">#love</a>
                            <a href="#">#snow</a>
                            <a href="#">#january</a>
                        </div><!-- .tags-links -->
                    </header><!-- .entry-header -->

                    <figure class="featured-image">
                        <img src="images/upload/<?php echo $new_blog->v_main_image_url ?>" alt="">
                    </figure><!-- .featured-image -->

                    <?php echo $new_blog->v_post_summary ?>

                    <div class="entry-content">
                        <?php echo $new_blog->v_post_content ?>
                    </div><!-- .entry-content -->

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <figure class="blog-page-half-img">
                                <img src="images/upload/<?php echo $new_blog->v_main_image_url ?>" alt="">
                            </figure><!-- .blog-page-half-img -->
                        </div><!-- .col -->

                        <div class="col-12 col-md-6">
                            <figure class="blog-page-half-img">
                                <img src="images/upload/<?php echo $new_blog->v_alt_image_url ?>" alt="">
                            </figure><!-- .blog-page-half-img -->
                        </div><!-- .col -->
                    </div><!-- .row -->

                    <footer class="entry-footer flex flex-column flex-lg-row justify-content-between align-content-start align-lg-items-center">
                        <ul class="post-share flex align-items-center order-3 order-lg-1">
                            <label>Share</label>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul><!-- .post-share -->
                    <?php
                        $new_comment->n_blog_post_id = $_GET['id'];
                        $comment_list = $new_comment->read_single_blog_post();
                    ?>
                        <div class="comments-count order-1 order-lg-3">
                            <a href="#"><?php echo $comment_list->rowCount() ?> Comments</a>
                        </div><!-- .comments-count -->
                    </footer><!-- .entry-footer -->
                </div><!-- .content-wrap -->

                <div class="content-area">
                    <div class="post-comments">
                        <h3 class="comments-title">Comments</h3>

                        <ol class="comment-list">
                            <?php while ($comment = $comment_list->fetch()){ ?>
                            <li class="comment">
                                <div class="comment-body flex justify-content-between">
                                    <figure class="comment-author-avatar">
                                        <img src="images/user-1.jpg" alt="user">
                                    </figure><!-- .comment-author-avatar -->

                                    <div class="comment-wrap">
                                        <div class="comment-author flex flex-wrap align-items-center">
                                            <span class="fn">
                                                <a href="#"><?php echo $comment['v_comment_author'] ?></a>
                                            </span><!-- .fn -->

                                            <span class="comment-meta">
                                                <a href="#"><?php echo $comment['d_date_created'] ?></a>
                                            </span><!-- .comment-meta -->

                                            <div class="reply">
                                                <a href="#reply" onclick="reply_comment(<?php echo $comment['n_blog_comment_id']?>)">Reply</a>
                                            </div><!-- .reply -->
                                        </div><!-- .comment-author -->

                                        <p><?php echo $comment['v_comment'] ?></p>

                                    </div><!-- .comment-wrap -->
                                </div><!-- .comment-body -->
                                <?php
                                    $new_comment->n_blog_comment_id = $comment['n_blog_comment_id'];
                                    $reply_list = $new_comment->read_single_blog_post_reply();
                                    while ($reply = $reply_list->fetch()) {
                                ?>
                                <li class="comment">
                                    <div class="comment-body flex justify-content-between" style="margin-left: 100px">
                                        <figure class="comment-author-avatar">
                                            <img src="images/user-1.jpg" alt="user">
                                        </figure><!-- .comment-author-avatar -->

                                        <div class="comment-wrap">
                                            <div class="comment-author flex flex-wrap align-items-center">
                                                <span class="fn">
                                                    <a href="#"><?php echo $reply['v_comment_author'] ?></a>
                                                </span><!-- .fn -->

                                                <span class="comment-meta">
                                                    <a href="#"><?php echo $reply['d_date_created'] ?></a>
                                                </span><!-- .comment-meta -->

                                            </div><!-- .comment-author -->

                                            <p><?php echo $reply['v_comment'] ?></p>

                                        </div><!-- .comment-wrap -->
                                    </div><!-- .comment-body -->
                                </li><!-- .comment -->
                                <?php } ?>
                            </li><!-- .comment -->
                            <?php } ?>
                        </ol><!-- .comment-list -->
                    </div><!-- .post-comments -->

                    <div class="comments-form">
                        <div class="comment-respond" id="respond">
                            <h3 class="comment-reply-title">Leave a comment</h3>

                            <form class="comment-form" name="c_form" onsubmit="return check_respond()" id="contactForm" method="post">
                                <input type="text" placeholder="Name" id="name" name="c_name">
                                <input type="email" placeholder="Email" id="email" name="c_email">
                                <textarea rows="18" cols="6" placeholder="Messages" id="message" name="c_message"></textarea>
                                <input type="submit" value="Send message" name="submit_comment">
                            </form><!-- .comment-form -->
                        </div><!-- .comment-respond -->

                        <div class="comment-reply" id="reply">
                            <h3 class="comment-reply-title">Leave a reply</h3>

                            <form class="comment-form" name="c_form_reply" onsubmit="return check_reply()" id="contactForm" method="post">
                                <input type="text" placeholder="Name" id="name" name="c_name_reply">
                                <input type="email" placeholder="Email" id="email" name="c_email_reply">
                                <textarea rows="18" cols="6" placeholder="Messages" id="message" name="c_message_reply"></textarea>
                                <input type="hidden" name="blog_comment_id">
                                <input type="submit" value="Send reply" name="submit_comment_reply">
                            </form><!-- .comment-form -->
                        </div><!-- .comment-respond -->
                    </div><!-- .comments-form -->
                </div><!-- .content-area -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .outer-container -->

<?php include 'footer.php' ?>

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/swiper.min.js'></script>
<script type='text/javascript' src='js/custom.js'></script>

<script>
    var blog_comment_id;

    function reply_comment(comment_id) {
        blog_comment_id = comment_id;
        document.getElementById("respond").style.display = "none";
        document.getElementById("reply").style.display = "block";
    }

    function hide_form_reply() {
        document.getElementById("reply").style.display = "none";
    }

    function check_respond() {
        if (document.c_form.c_name.value == "") {
            alert("Author name is not empty!");
            document.c_form.c_name.focus();
            return false;
        }
        if (document.c_form.c_email.value == "") {
            alert("Author email is not empty!");
            document.c_form.c_email.focus();
            return false;
        }
        if (document.c_form.c_message.value == "") {
            alert("Author message is not empty!");
            document.c_form.c_message.focus();
            return false;
        }
        return true;
    }

    function check_reply() {
        if (document.c_form_reply.c_name_reply.value == "") {
            alert("Author name is not empty!");
            document.c_form_reply.c_name_reply.focus();
            return false;
        }
        if (document.c_form_reply.c_email_reply.value == "") {
            alert("Author email is not empty!");
            document.c_form_reply.c_email_reply.focus();
            return false;
        }
        if (document.c_form_reply.c_message_reply.value == "") {
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