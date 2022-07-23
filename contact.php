<?php
    include 'admin/includes/database.php';
    include 'admin/includes/subscriber.php';
    include 'admin/includes/contact.php';
    include 'admin/includes/blogs.php';
    include 'admin/includes/tags.php';
    include 'admin/includes/categories.php';
    
    $database = new database();
    $db = $database->connect();

    $new_contact = new contact($db);
    $new_blog = new blog($db);
    $new_tag = new tag($db);

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['submit_subscribe'])!=""){
            $new_subscribe = new subscribe($db);
            $new_subscribe->v_sub_email = $_POST['email'];
            $new_subscribe->d_date_created = date('y-m-d',time());
            $new_subscribe->d_time_created = date('h:i:s',time());
            $new_subscribe->f_sub_status = 1;
            $new_subscribe->create();
        }
        if (isset($_POST['submit_contact'])) {
            $new_contact->v_email = $_POST['c_email'];
            $new_contact->v_phone = $_POST['c_phone'];        
            $new_contact->v_message = $_POST['c_message'];
            $new_contact->d_date_created = date('y-m-d',time());
            $new_contact->d_time_created = date('h:i:s',time());
            $new_contact->f_contact_status = 1;
            $new_contact->create();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Liên hệ</title>

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
<body>
<div class="outer-container">
    
    <?php include 'header.php' ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-header flex justify-content-center align-items-center" style="background-image: url('images/contact-bg.jpg')">
                    <h1>Contact</h1>
                </div><!-- .page-header -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .hero-section -->

    <div class="container single-page contact-page">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="content-wrap">
                    <header class="entry-header">
                        <h2 class="entry-title">Contact me</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>Chào mừng bạn đến với Nhan Nguyen Blog. Xin hãy dành ít phút góp ý cho chúng tôi nhé.</p>
                    </div><!-- .entry-content -->

                    <div class="contact-page-social">
                        <ul class="flex align-items-center">
                            <li><a href="facebook.com"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="youtube.com"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div><!-- .header-bar-social -->

                    <form class="contact-form" method="post">
                        <input type="text" placeholder="Name" name="c_email">
                        <input type="email" placeholder="Email" name="c_phone">
                        <textarea rows="18" cols="6" placeholder="Messages" name="c_message"></textarea>
                        <input type="submit" name="submit_contact" value="Gửi">
                    </form><!-- .contact-form -->
                </div><!-- .content-wrap -->
            </div><!-- .col -->

            <div class="col-12 col-lg-3">
                <div class="sidebar">
                    <div class="recent-posts">
                        <?php 
                            $result = $new_blog->read_newest_blog();
                            while ($row = $result->fetch()) {
                        ?>
                        <div class="recent-post-wrap">
                            <figure>
                                <img src="images/upload/<?php echo $row['v_alt_image_url']; ?>" alt="">
                            </figure>

                            <header class="entry-header">
                                <div class="posted-date">
                                    <?php echo $row['d_date_created']; ?>
                                </div><!-- .entry-header -->

                                <h3><a href="#"><?php echo $row['v_post_title']; ?></a></h3>

                                <div class="tags-links">
                                    <?php 
                                        $new_tag = new tag($db);
                                        $new_tag->n_blog_post_id = $row['n_blog_post_id'];
                                        $new_tag->read_single();
                                        $tag_arr = explode(', ', $new_tag->v_tag);
                                        if (count($tag_arr) > 0) {
                                            foreach($tag_arr as $tag) {
                                    ?>
                                    <a href="#">#<?php echo $tag ?></a>
                                    <?php } } ?>
                                </div><!-- .tags-links -->
                            </header><!-- .entry-header -->
                        </div><!-- .recent-post-wrap -->
                        <?php } ?>
                    </div><!-- .recent-posts -->
                </div><!-- .sidebar -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .outer-container -->

<?php include 'footer.php' ?>

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/swiper.min.js'></script>
<script type='text/javascript' src='js/custom.js'></script>

</body>
</html>