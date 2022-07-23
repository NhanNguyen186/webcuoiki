<footer class="sit-footer">
    <div class="outer-container">
        <div class="container-fluid">
            <div class="row footer-recent-posts">
                <?php 
                    $result = $new_blog->read_newest_blog();
                    while ($row = $result->fetch()) { 
                ?>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="footer-post-wrap flex justify-content-between">
                        <figure>
                            <a href="#"><img src="images/upload/<?php echo $row['v_alt_image_url']; ?>" alt=""></a>
                        </figure>

                        <div class="footer-post-cont flex flex-column justify-content-between">
                            <header class="entry-header">
                                <div class="posted-date">
                                    <?php echo $row['d_date_created']; ?>
                                </div><!-- .entry-header -->

                                <h3><a href="#"><?php $row['v_post_title'] ?></a></h3>

                                <div class="tags-links">
                                    <?php 
                                        $new_tag = new tag($db);
                                        $new_tag->n_blog_post_id = $row['n_blog_post_id'];
                                        $new_tag->read_single();
                                        $tag_arr = explode(', ', $new_tag->v_tag);
                                        foreach($tag_arr as $tag) {
                                    ?>
                                    <a href="search.php?key=<?php echo $tag ?>">#<?php echo $tag ?></a>
                                    <?php } ?>
                                </div><!-- .tags-links -->
                            </header><!-- .entry-header -->

                            <footer class="entry-footer">
                                <a class="read-more" href="single_blog.php?id=<?php echo $row['n_blog_post_id']; ?>">read more</a>
                            </footer><!-- .entry-footer -->
                        </div><!-- .footer-post-cont -->
                    </div><!-- .footer-post-wrap -->
                </div><!-- .col -->
                <?php } ?>
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .outer-container -->

    <div class="footer-bar">
        <div class="outer-container">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-4">
                        <div class="footer-copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            <p>Bản quyền &copy; thuộc về Nguyễn Văn Nhân K16CSI01</p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div><!-- .footer-copyright -->
                    </div><!-- .col-xl-4 -->
                    <div class="col-12 col-md-4">
                        <div class="footer-social">
                            <ul class="flex justify-content-center justify-content-md-end align-items-center">
                                <li><a href="facebook.com"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="youtube.com"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div><!-- .footer-social -->
                    </div><!-- .col-xl-4 -->
                    <div class="col-12 col-md-4">
                        <h6 style="color: #fff">Subscribe</h6>
                        <form name="c_form" onsubmit="return check_respond()" id="contactForm" method="post">
                            <input type="email" class="form-control" placeholder="Please input your email" name="email">
                            <input type="submit" class="form-control" value="Subscribe" name="submit_subscribe">
                        </form><!-- .comment-form -->
                    </div>
                </div><!-- .row -->
            </div><!-- .container-fluid -->
        </div><!-- .outer-container -->
    </div><!-- .footer-bar -->
</footer><!-- .sit-footer -->