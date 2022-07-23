<?php
    include 'admin/includes/database.php';
    include 'admin/includes/subscriber.php';
    include 'admin/includes/blogs.php';
    include 'admin/includes/tags.php';
    include 'admin/includes/categories.php';
    
    $database = new database();
    $db = $database->connect();

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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Về chúng tôi</title>

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
                <div class="page-header flex justify-content-center align-items-center" style="background-image: url('images/about-bg.jpg')">
                    <h1>About Me</h1>
                </div><!-- .page-header -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .hero-section -->

    <div class="container single-page about-page">
        <div class="row">
            <div class="col-12">
                <div class="content-wrap">
                    <div class="entry-content">
                        <h4>Họ tên: Nguyễn Văn Nhân</h4>
                        <h4>Lớp: 16CSI01</h4>
                        <h4>Email: 20662014@kthcm.edu.vn</h4>
                        <h4>Điện thoại: 0123456789 </h4>
                    </div><!-- .entry-content -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .row -->

        <div class="row">
            <div class="col-12">
                <footer class="entry-footer flex flex-column flex-lg-row justify-content-between align-content-start align-lg-items-center">
                    <ul class="post-share flex align-items-center order-3 order-lg-1">
                        <label>Share</label>
                        <li><a href="facebook.com"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="youtube.com"><i class="fa fa-youtube"></i></a></li>
                    </ul><!-- .post-share -->
                </footer><!-- .entry-footer -->
            </div><!-- .content-wrap -->
        </div><!-- .col -->
    </div><!-- .container -->
</div><!-- .outer-container -->

<?php include 'footer.php' ?>

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/swiper.min.js'></script>
<script type='text/javascript' src='js/custom.js'></script>

</body>
</html>