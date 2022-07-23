<section class="s-content">

    <div class="row">
        <div class="column large-12">

            <article class="s-content__entry format-standard">

                <div class="s-content__media">
                    <div class="s-content__post-thumb">
                        <img src="images/thumbs/single/single-post-1050.jpg" 
                             srcset="images/thumbs/single/single-post-2100.jpg 2100w, 
                                     images/thumbs/single/single-post-1050.jpg 1050w, 
                                     images/thumbs/single/single-post-525.jpg 525w" sizes="(max-width: 2100px) 100vw, 2100px" alt="">
                    </div>
                </div> <!-- end s-content__media -->

                <div class="s-content__entry-header">
                    <h1 class="s-content__title s-content__title--post">
                    <?php echo $new_blog->v_post_title ?>                    
                    </h1>
                </div> <!-- end s-content__entry-header -->

                <div class="s-content__primary">

                    <div class="s-content__entry-content">
                        <?php echo $new_blog->v_post_content ?>
                    </div> <!-- end s-entry__entry-content -->

                    <div class="s-content__entry-meta">

                        <div class="entry-author meta-blk">
                            <div class="author-avatar">
                                <img class="avatar" src="images/avatars/user-06.jpg" alt="">
                            </div>
                            <div class="byline">
                                <span class="bytext">Posted By</span>
                                <a href="#0">John Doe</a>
                            </div>
                        </div>

                        <div class="meta-bottom">
                            
                            <div class="entry-cat-links meta-blk">                                
                                <span>On</span>

                            <?php echo $new_blog->d_date_created ?>
                            </div>
                            <?php
                            $new_tag->n_blog_post_id = $_GET['id'];  
                            $new_tag->read_single();
                            ?>
                            <div class="entry-tags meta-blk">
                                <span class="tagtext">Tags</span>
                                <a href="#"><?php echo $new_tag->v_tag ?></a>
                            </div>

                        </div>

                    </div> <!-- s-content__entry-meta -->

                    <?php 
                    $new_blog->n_blog_post_id = $_GET['id'];
                    $rs_next = $new_blog->read_next();
                    $rs_previous = $new_blog->read_previous();                                
                    ?>
                    <div class="s-content__pagenav">
                        <?php
                        if($previous = $rs_previous->fetch()){ 
                        ?>
                        <div class="prev-nav">
                            <a href="blog.php?id=<?php echo $previous['n_blog_post_id'] ?>" rel="prev">
                                <span>Previous</span>
                                <?php echo $previous['v_post_title'] ?> 
                            </a>
                        </div>
                        <?php  
                        }
                        if($next = $rs_next->fetch()){
                        ?>
                        <div class="next-nav">
                            <a href="blog.php?id=<?php echo $next['n_blog_post_id'] ?>" rel="next">
                                <span>Next</span>
                                <?php echo $next['v_post_title'] ?>
                            </a>
                        </div>
                        <?php  
                        }
                        ?>
                     </div> <!-- end s-content__pagenav -->

                </div> <!-- end s-content__primary -->
            </article> <!-- end entry -->

        </div> <!-- end column -->
    </div> <!-- end row -->


    <!-- comments
    ================================================== -->
    <?php
    $new_comment->n_blog_post_id = $_GET['id'];
    $rs_comment = $new_comment->read_single_blog_post();    
    $num_comment = $rs_comment->rowCount();
    ?>
    <div class="comments-wrap">
        <div id="comments" class="row">
            <div class="column large-12">
                <h3><?php echo empty($num_comment)?"Comments":"$num_comment Comments" ?></h3>

                <!-- START commentlist -->
                <ol class="commentlist">                
                    <?php  
                    while($rows = $rs_comment->fetch()){
                        if($rows['n_blog_comment_parent_id']==0){
                    ?>
                    <li class="thread-alt depth-1 comment">                        
                        <div class="comment__content">
                            <div class="comment__info">
                                <div class="comment__author"><?php echo $rows['v_comment_author'] ?></div>
                                <div class="comment__meta">
                                    <div class="comment__time"><?php echo $rows['d_date_created'] ?></div>
                                    <div class="comment__reply">
                                        <a class="comment-reply-link" href="#" onclick="reply_comment(<?php echo $rows['n_blog_comment_id']?>)">Reply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="comment__text">
                            <p><?php echo $rows['v_comment'] ?></p>
                            </div>
                        </div>                     
                        <?php
                        $new_comment->n_blog_comment_id = $rows['n_blog_comment_id'];
                        $rs_sub_comment = $new_comment->read_single_blog_post_reply();  
                        while($rows_sub = $rs_sub_comment->fetch()){
                        ?>
                        <ul class="children">

                            <li class="depth-2 comment">
                                
                                <div class="comment__content">

                                    <div class="comment__info">
                                        <div class="comment__author"><?php echo $rows_sub['v_comment_author'] ?></div>

                                        <div class="comment__meta">
                                            <div class="comment__time"><?php echo $rows_sub['d_date_created'] ?></div>
                                            <div class="comment__reply">
                                                <a class="comment-reply-link" href="#0">Reply</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="comment__text">
                                        <p><?php echo $rows['v_comment'] ?></p>
                                    </div>

                                </div>                                

                            </li>
                        </ul>
                        <?php  
                        }
                        ?>
                    </li> <!-- end comment level 1 --> 
                    <?php 
                        } 
                    }
                    ?>
                </ol>
                <!-- END commentlist -->

            </div> <!-- end col-full -->
        </div> <!-- end comments -->

        <div class="row comment-respond">

            <!-- START respond -->
            <div id="respond" class="column">
                <h3>
                Add Comment 
                <span>Your email address will not be published.</span>
                </h3>

                <form name="c_form" onsubmit="return check_respond()" id="contactForm" method="post" action="" autocomplete="off">
                    <fieldset>

                        <div class="form-field">
                            <input name="c_name" id="cName" class="h-full-width h-remove-bottom" placeholder="Your Name" value="" type="text">
                        </div>
                        <div class="form-field">
                            <input name="c_email" id="cEmail" class="h-full-width h-remove-bottom" placeholder="Your Email" value="" type="text">
                        </div>
                        <div class="message form-field">
                            <textarea name="c_message" id="cMessage" class="h-full-width" placeholder="Your Message"></textarea>
                        </div>
                        <br>
                        <input name="submit_comment" id="submit" class="btn btn--primary btn-wide btn--large h-full-width" value="Add Comment" type="submit" >

                    </fieldset>
                </form> <!-- end form -->
            </div>
            <!-- END respond-->

            <!-- START reply -->
            <div id="reply" class="column">
                <h3>
                Reply Comment 
                <span>Your email address will not be published.</span>
                </h3>
                <form name="c_form_reply" onsubmit="return check_reply()"  id="contactForm" method="post" action="" autocomplete="off">
                    <fieldset>
                        <div class="form-field">
                            <input name="c_name_reply" id="cName" class="h-full-width h-remove-bottom" placeholder="Your Name" value="" type="text">
                        </div>
                        <div class="form-field">
                            <input name="c_email_reply" id="cEmail" class="h-full-width h-remove-bottom" placeholder="Your Email" value="" type="text">
                        </div>
                        <div class="message form-field">
                            <textarea name="c_message_reply" id="cMessage" class="h-full-width" placeholder="Your Message"></textarea>
                        </div>
                        <br>
                        <input type="hidden" name="blog_comment_id">
                        <input name="submit_comment_reply" id="submit" class="btn btn--primary btn-wide btn--large h-full-width" value="Reply Comment" type="submit">
                    </fieldset>
                </form> <!-- end form -->
            </div>
            <!-- END reply-->

        </div> <!-- end comment-respond -->
    </div> <!-- end comments-wrap -->
</section>
