<?php

    // Khai báo đường dẫn theme
    define("THEME_URL",get_stylesheet_directory_uri());

    if (!function_exists('xemphim_theme_setup')){
        function xemphim_theme_setup(){

            // Thiết lập textdomain 
            $language_folder = THEME_URL . '/languages';
            load_theme_textdomain('xemphim', $language_folder);

            // Tự động thêm link RSS lên head 
            add_theme_support('automatic-feed-links');
            
            // Thêm post thumnail
            add_theme_support('post-thumbnails');

            // post format 
            add_theme_support('post-formats', [
                'image',
                'video',
                'gallery',
                'quote',
                'link'
            ]);

            //Thêm title tag
            add_theme_support('title-tag');

            // thêm custom background 
            add_theme_support('custom-background');

            // Thêm menu 
            register_nav_menu('primary-menu' , 'Menu chính');

            // Thên sidbar 
            $sidebar = [
                'name' => __('Side bar chính','xemphim'),
                'id'=> 'main-sidebar',
                'description'=> __('Default Sidebar'),
                'class' => 'main-sidebar',
                'before_title' => '<h3 class="widgettitle">',
                'after_title' => '</h3>'
             ];

             register_sidebar( $sidebar );

             add_theme_support( 'custom-logo' );

        }

        add_action('init', 'xemphim_theme_setup');
    }


    if (!function_exists('xemphim_menu')){
        function xemphim_menu($menu){
            $menu = [
                'theme_location' => $menu,
                'container' => 'nav',
                'container_class' => $menu,
            ];
            wp_nav_menu($menu);
        }

    }

    if (!function_exists('xemphim_pagination')){
        function xemphim_pagination(){
            if ($GLOBALS['wp_query']->max_num_pages < 2){
                return '';
            } ?>
            <div class="product__pagination">
                <a href="#" class="current-page">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <?php
                    if (get_next_posts_link()){
                        next_posts_link('<i class="fa fa-angle-double-right"></i>');
                    }
                ?>
                
            </div>
        <?php }
    }

    if (!function_exists('xemphim_thumnail')){
        function xemphim_thumnail($size){
            if (!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')){
            ?>
                <div class="product__item__pic set-bg" data-setbg="img/popular/popular-4.jpg" style="background-image: url(&quot;img/popular/popular-4.jpg&quot;);">
                    <div class="ep">18 / 18</div>
                    <div class="comment"><i class="fa fa-comments"></i> 11</div>
                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                </div>
            <?php
            } 
        }

    }

    function xemphim_style(){
        wp_register_style( 'main-style' ,  THEME_URL . '/style.css' );
        wp_enqueue_style('main-style');
    }

    add_action('wp_enqueue_scripts','xemphim_style' );
?>

