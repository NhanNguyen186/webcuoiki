<section class="s-content s-content--no-top-padding">
    <!-- masonry
    ================================================== -->
    <div class="s-bricks">

        <div class="masonry">
            <div class="bricks-wrapper h-group">

                <div class="grid-sizer"></div>

                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <?php

                while($rows = $rs_blog->fetch()){
                ?>
                <article class="brick entry" data-aos="fade-up">

                    <div class="entry__thumb">
                        <a href="blogs.php?id=<?php echo $rows['n_blog_post_id'] ?>" class="thumb-link">
                            <img src="images/upload/<?php echo $rows['v_main_image_url'] ?>" 
                                 alt="">
                        </a>
                    </div> <!-- end entry__thumb -->

                    <div class="entry__text">
                        <div class="entry__header">
                            <h1 class="entry__title">
                                <a href="blog.php?id=<?php echo $rows['n_blog_post_id']; ?>">
                                    <?php echo $rows['v_post_title']; ?>        
                                </a>
                            </h1>
                            <?php
                                $new_tag->n_blog_post_id = $rows['n_blog_post_id'];
                                $new_tag->read_single();                                                                
                            ?>
                            <div class="entry__meta">                                
                                <span class="cat-links">
                                    <a href="search.php?query="><?php echo $new_tag->v_tag; ?></a>
                                </span>
                            </div>
                        </div>
                        <div class="entry__excerpt">
                            <p>
                            <?php echo $rows['v_post_summary']; ?>
                            </p>
                        </div>
                        <a class="entry__more-link" href="blogs.php?id=<?php echo $rows['n_blog_post_id'] ?>">Learn More</a>
                    </div> <!-- end entry__text -->
                
                </article> <!-- end article -->
                <?php  
                }
                ?>                
            </div> <!-- end brick-wrapper -->

        </div> <!-- end masonry -->

        <div class="row">
            <div class="column large-12">
                <nav class="pgn">
                    <ul>
                        <li>
                            <span class="pgn__prev" href="#0">
                                Prev
                            </span>
                        </li>
                        <li><a class="pgn__num" href="#0">1</a></li>
                        <li><span class="pgn__num current">2</span></li>
                        <li><a class="pgn__num" href="#0">3</a></li>
                        <li><a class="pgn__num" href="#0">4</a></li>
                        <li><a class="pgn__num" href="#0">5</a></li>
                        <li><span class="pgn__num dots">…</span></li>
                        <li><a class="pgn__num" href="#0">8</a></li>
                        <li>
                            <span class="pgn__next" href="#0">
                                Next
                            </span>
                        </li>
                    </ul>
                </nav> <!-- end pgn -->
            </div> <!-- end column -->
        </div> <!-- end row -->

    </div> <!-- end s-bricks -->

</section>