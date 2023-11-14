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


    function video_custom_post_type() {
        $labels = array(
            'name'               => __( 'Anime', 'text-domain' ),
            'singular_name'      => __( 'Anime', 'text-domain' ),
            'add_new'            => _x( 'Add New Anime', 'text-domain', 'text-domain' ),
            'add_new_item'       => __( 'Add New Anime', 'text-domain' ),
            'edit_item'          => __( 'Edit Anime', 'text-domain' ),
            'new_item'           => __( 'New Anime', 'text-domain' ),
            'view_item'          => __( 'View Anime', 'text-domain' ),
            'search_items'       => __( 'Search Anime', 'text-domain' ),
            'not_found'          => __( 'Không tìm thấy Anime', 'text-domain' ),
            'not_found_in_trash' => __( 'Không tìm thấy Anime', 'text-domain' ),
            'parent_item_colon'  => __( '', 'text-domain' ),
            'menu_name'          => __( 'Anime', 'text-domain' ),
        );
        $args = array(
            'labels'              => $labels,
            'hierarchical'        => false,
            'description'         => 'description',
            'taxonomies'          => array('dmdv'),
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-format-video',
            'show_in_nav_menus'   => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'has_archive'         => true,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => array('slug' => 'anime' ),
            'capability_type'     => 'post',
            'supports'            => array(
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'trackbacks',
                'comments',
                'revisions',
                'page-attributes',
                'post-formats',
            ),
        );
        register_post_type( 'video-anime', $args );


        //----------------taxonomy
        $labels_dv = array(
            'name'                  => _x( 'Danh mục anime', 'Taxonomy plural name', 'text-domain' ),
            'singular_name'         => _x( 'Danh mục anime', 'Taxonomy singular name', 'text-domain' ),
            'search_items'          => __( 'Search Plural anime', 'text-domain' ),
            'popular_items'         => __( 'Popular Plural anime', 'text-domain' ),
            'all_items'             => __( 'All Plural anime', 'text-domain' ),
            'parent_item'           => __( 'Parent Singular anime', 'text-domain' ),
            'parent_item_colon'     => __( 'Parent Singular anime', 'text-domain' ),
            'edit_item'             => __( 'Edit Singular anime', 'text-domain' ),
            'update_item'           => __( 'Update Singular anime', 'text-domain' ),
            'add_new_item'          => __( 'Add New Singular anime', 'text-domain' ),
            'new_item_name'         => __( 'New Singular anime', 'text-domain' ),
            'add_or_remove_items'   => __( 'Add or remove Plural anime', 'text-domain' ),
            'choose_from_most_used' => __( 'Choose from most used Plural anime', 'text-domain' ),
            'menu_name'             => __( 'Danh mục anime', 'text-domain' ),
        );
        $args_anime = array(
            'labels'            => $labels_dv,
            'public'            => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'hierarchical'      => true,
            'show_tagcloud'     => true,
            'show_ui'           => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'danh-muc-anime'),
            'capabilities'      => array(),
        );
        register_taxonomy( 'tax_anime_video', 'video-anime', $args_anime );


        $labels_category = array(
            'name'                  => _x( 'Thể loại', 'Taxonomy plural name', 'text-domain' ),
            'singular_name'         => _x( 'Thể loại', 'Taxonomy singular name', 'text-domain' ),
            'search_items'          => __( 'Search Plural Thể loại', 'text-domain' ),
            'popular_items'         => __( 'Popular Plural Thể loại', 'text-domain' ),
            'all_items'             => __( 'All Plural Thể loại', 'text-domain' ),
            'parent_item'           => __( 'Parent Singular Thể loại', 'text-domain' ),
            'parent_item_colon'     => __( 'Parent Singular Thể loại', 'text-domain' ),
            'edit_item'             => __( 'Edit Singular Thể loại', 'text-domain' ),
            'update_item'           => __( 'Update Singular Thể loại', 'text-domain' ),
            'add_new_item'          => __( 'Add New Singular Thể loại', 'text-domain' ),
            'new_item_name'         => __( 'New Singular Thể loại', 'text-domain' ),
            'add_or_remove_items'   => __( 'Add or remove Plural Thể loại', 'text-domain' ),
            'choose_from_most_used' => __( 'Choose from most used Plural Thể loại', 'text-domain' ),
            'menu_name'             => __( 'Danh mục Thể loại', 'text-domain' ),
        );
        $args_category = array(
            'labels'            => $labels_category,
            'public'            => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => false,
            'hierarchical'      => true,
            'show_tagcloud'     => true,
            'show_ui'           => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'the-loai'),
            'capabilities'      => array(),
        );
        register_taxonomy( 'tax-category-anime', 'video-anime', $args_category );
    }
    add_action('init', 'video_custom_post_type');



?>

