<?php  
include "admin/includes/database.php";
include "admin/includes/subscriber.php";
include "admin/includes/blogs.php";
include "admin/includes/tags.php";
include "admin/includes/contact.php";

$database = new database();
$db = $database->connect();

$new_contact = new contact($db);
$new_tag = new tag($db);      
$new_blog = new blog($db);
$rs_blog = $new_blog->read();

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['email'])!=""){
        $new_subscribe = new subscribe($db);
        $new_subscribe->v_sub_email = $_POST['email'];
        $new_subscribe->d_date_created = date('y-m-d',time());
        $new_subscribe->d_time_created = date('h:i:s',time());
        $new_subscribe->f_sub_status = 1;
        $new_subscribe->create();       
    }

    if(isset($_POST['submit_contact'])){
        $new_contact->v_fullname = $_POST['c_name'];
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
    <section class="s-content">

        <div class="row">
            <div class="column large-12">

                <article class="s-content__entry">

                    <div class="s-content__media">
                        <img src="images/thumbs/contact/contact-1050.jpg" 
                                srcset="images/thumbs/contact/contact-2100.jpg 2100w, 
                                        images/thumbs/contact/contact-1050.jpg 1050w, 
                                        images/thumbs/contact/contact-525.jpg 525w" sizes="(max-width: 2100px) 100vw, 2100px" alt="">
                    </div> <!-- end s-content__media -->

                    <div class="s-content__entry-header">
                        <h1 class="s-content__title">Get In Touch With Us.</h1>
                    </div> <!-- end s-content__entry-header -->

                    <div class="s-content__primary">

                        <div class="s-content__page-content">

                            <p class="lead">
                            Lorem ipsum Deserunt est dolore Ut Excepteur nulla occaecat magna occaecat Excepteur nisi esse veniam 
                            dolor consectetur minim qui nisi esse deserunt commodo ea enim ullamco non voluptate consectetur minim 
                            aliquip Ut incididunt amet ut cupidatat.
                            </p> 

                            <p>
                            Duis ex ad cupidatat tempor Excepteur cillum cupidatat fugiat nostrud cupidatat dolor sunt sint sit 
                            nisi est eu exercitation incididunt adipisicing veniam velit id fugiat enim mollit amet anim veniam 
                            dolor dolor irure velit commodo cillum sit nulla ullamco magna amet magna cupidatat qui labore cillum 
                            sit in tempor veniam consequat non laborum adipisicing aliqua ea nisi sint ut quis proident ullamco 
                            ut dolore culpa occaecat ut laboris in sit minim cupidatat ut dolor voluptate enim veniam consequat 
                            occaecat fugiat in adipisicing in amet Ut nulla nisi non ut enim aliqua laborum mollit quis nostrud sed sed.
                            </p>

                            <br>

                            <div class="row block-large-1-2 block-tab-full s-content__blocks">
                                <div class="column">
                                    <h4>Where to Find Us</h4>
                                    <p>
                                    1600 Amphitheatre Parkway<br>
                                    Mountain View, CA<br>
                                    94043 US
                                    </p>
                                </div>

                                <div class="column">
                                    <h4>Contact Info</h4>
                                    <p>
                                    someone@yourdomain.com<br>
                                    info@yourdomain.com <br>
                                    Phone: (+63) 555 1212
                                    </p> 
                                </div>
                            </div> <!-- end s-content__blocks -->

                            <form name="c_form" id="cForm" onsubmit="return check_contact()" class="s-content__form" method="post" action="">
                                <fieldset>

                                    <div class="form-field">
                                        <input name="c_name" type="text" id="cName" class="h-full-width h-remove-bottom" placeholder="Your Name" value="">
                                    </div>

                                    <div class="form-field">
                                        <input name="c_phone" type="text" id="cPhone" class="h-full-width h-remove-bottom" placeholder="Your Phone" value="">
                                    </div>

                                    <div class="form-field">
                                        <input name="c_email" type="text" id="cEmail" class="h-full-width h-remove-bottom" placeholder="Your Email" value="">
                                    </div>

                                    <div class="message form-field">
                                        <textarea name="c_message" id="cMessage" class="h-full-width" placeholder="Your Message" ></textarea>
                                    </div>

                                    <br>
                                    <button name="submit_contact" type="submit" class="submit btn btn--primary h-full-width">Submit</button>

                                </fieldset>
                            </form> <!-- end form -->

                        </div> <!-- end s-entry__page-content -->

                    </div> <!-- end s-content__primary -->
                </article> <!-- end entry -->

            </div> <!-- end column -->
        </div> <!-- end row -->

    </section> <!-- end s-content -->

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
    function check_contact(){
       if(document.c_form.c_name.value == ""){
        alert("Author name is not empty!");
        document.c_form.c_name.focus();
        return false;
       }
       if(document.c_form.c_phone.value == ""){
        alert("Author phone is not empty!");
        document.c_form.c_phone.focus();
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
    </script>

</body>
</html>