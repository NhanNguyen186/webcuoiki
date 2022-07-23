<header class="site-header">
    <div class="top-header-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 flex align-items-center">
                    <div class="header-bar-text d-none d-lg-block">
                        <p>Xin chào, tôi tên là Nguyễn Văn Nhân</p>
                    </div><!-- .header-bar-text -->

                    <div class="header-bar-email d-none d-lg-block">
                        <a href="#">20662014@kthcm.edu.vn</a>
                    </div><!-- .header-bar-email -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 flex justify-content-between justify-content-lg-end align-items-center">
                    <div class="header-bar-social d-none d-md-block">
                        <ul class="flex align-items-center">
                            <li><a href="facebook.com"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="youtube.com"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div><!-- .header-bar-social -->

                    <div class="header-bar-search d-none d-md-block">
                        <form action="search.php">
                            <input type="search" name="key" placeholder="Search">
                        </form>
                    </div><!-- .header-bar-search -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .top-header-bar -->

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="site-branding flex flex-column align-items-center">
                    <h1 class="site-title"><a href="index.php" rel="home">Nhan Nguyen</a></h1>
                    <p class="site-description">Blog Cá Nhân</p>
                </div><!-- .site-branding -->

                <nav class="site-navigation">
                    <div class="hamburger-menu d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div><!-- .hamburger-menu -->

                    <ul class="flex-lg flex-lg-row justify-content-lg-center align-content-lg-center">
                        <li class="current-menu-item"><a href="index.php">Trang chủ</a></li>
                        <li>
                            <a href="category.php">Danh mục</a>
                            <ul class="child-menu">
                                <?php 
                                    $new_cate_2 = new category($db);
                                    $result = $new_cate_2->read();
                                    while($row = $result->fetch()) {
                                ?>
                                <li><a href="category.php?id=<?php echo $row['n_category_id']; ?>"><?php echo $row['v_category_title']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a href="blog.php">Bài viết</a></li>
                        <li><a href="about.php">Về chúng tôi</a></li>
                        <li><a href="contact.php">Liên hệ</a></li>
                    </ul>

                    <div class="header-bar-social d-md-none">
                        <ul class="flex justify-content-center align-items-center">
                            <li><a href="facebook.com"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="youtube.com"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div><!-- .header-bar-social -->

                    <div class="header-bar-search d-md-none">
                        <form>
                            <input type="search" placeholder="Search">
                        </form>
                    </div><!-- .header-bar-search -->
                </nav><!-- .site-navigation -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</header><!-- .site-header -->