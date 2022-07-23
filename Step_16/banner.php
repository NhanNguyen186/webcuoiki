<section id="hero" class="s-hero">

    <div class="s-hero__slider">
    <?php  
        $rs_banner = $new_blog->read_home_page_place();
        while($rows = $rs_banner->fetch()){
    ?>
        <div class="s-hero__slide">
            <div class="s-hero__slide-bg" 
                style="background-image: url('images/upload/<?php echo $rows['v_main_image_url'] ?>');">
            </div>
            <div class="row s-hero__slide-content animate-this">
                <div class="column">
                    
                    <h1 class="s-hero__slide-text">
                        <a href="blogs.php?id=<?php echo $rows['n_blog_post_id']?>">
                            <?php echo $rows['v_post_title'] ?>
                        </a>
                    </h1>
                </div>
            </div>
        </div> <!-- end s-hero__slide -->        
    <?php  
        }
    ?>
    </div> <!-- end s-hero__slider -->

    <div class="s-hero__social hide-on-mobile-small">
        <p>Follow</p>
        <span></span>
        <ul class="s-hero__social-icons">
            <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
            <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="#0"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
        </ul>
    </div> <!-- end s-hero__social -->

    <div class="nav-arrows s-hero__nav-arrows">
        <button class="s-hero__arrow-prev">
            <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M1.5 7.5l4-4m-4 4l4 4m-4-4H14" stroke="currentColor"></path></svg>
        </button>
        <button class="s-hero__arrow-next">
           <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M13.5 7.5l-4-4m4 4l-4 4m4-4H1" stroke="currentColor"></path></svg>
        </button>
    </div> <!-- end s-hero__arrows -->

</section>