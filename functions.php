<?php
/**
 * Designr Theme functions and definitions.
 * @package Designr
 */
define('DESIGNR_WOOCOMMERCE_ACTIVE', class_exists('WooCommerce'));
define('DESIGNR_ADDONS_ACTIVE', function_exists('designr_load'));
function designr_paginate_links() {
    global $wp_rewrite, $wp_query;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'prev_text' => __('&laquo;', 'designr'),
        'next_text' => __('&raquo;', 'designr'),
        'end_size' => 1,
        'mid_size' => 2,
        'show_all' => true,
        'type' => 'list'
    );

    if ( $wp_rewrite->using_permalinks() )
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

    if ( !empty( $wp_query->query_vars['s'] ) )
            $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
    if(paginate_links( $pagination )==""){
		
	} else {
    echo '<div>';
	echo __('Pages:','designr');
    echo '</div>'; 
	echo paginate_links( $pagination );}
}
if ( ! function_exists( 'designr_setup' ) ) :
function designr_setup() {
	load_theme_textdomain( 'designr', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'gutenberg',array( 'wide-images' => true ));
	if(DESIGNR_WOOCOMMERCE_ACTIVE){
    add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
	}
	register_nav_menus( array(
		'primary' => esc_html( 'Primary Menu', 'designr' ),
		'primary2' => esc_html( 'Primary Menu 2', 'designr' ),
		'mobile_menu' => esc_html('Mobile Menu', 'designr'),
		'transparent' => esc_html('Modal Menu Left', 'designr' ),
        'transparent2' => esc_html('Modal Menu Center', 'designr' ),
        'transparent3' => esc_html('Modal Menu Right', 'designr' )	
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif; // designr_setup
function designr_get_wpfw_file($file, $mi=false) {
	global $post, $wpdb, $metaboxes, $sliders_config, $lighbox_config, $wpfw_options_path;
	
	if ($mi == true) {
		require_once($file.'.php');
	} else {
		include($file.'.php');
	}
}
add_action( 'after_setup_theme', 'designr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function designr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'designr_content_width', 640 );
}
add_action( 'after_setup_theme', 'designr_content_width', 0 );
/**
 * Enqueue scripts and styles.
 */
function designr_scripts() {
	global $designr;
    wp_enqueue_style('bootstrap', get_parent_theme_file_uri('/css/bootstrap.min.css'));
	wp_enqueue_style( 'designr-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_parent_theme_file_uri('/css/css/font-awesome.min.css'));
    wp_enqueue_script( 'designr-scripts', get_template_directory_uri().'/js/designr-scripts.js', array( 'jquery' ),'1.0',true );  
	if($designr['preload-switch']==1){
	wp_enqueue_script( 'imagesloaded');
	$js_code = "jQuery('body').imagesLoaded().always( function( instance ) {
  jQuery('div#loading').delay(".$designr['loading-delay'].").fadeOut(".$designr['anims-delay'].");jQuery('body').removeClass('is-loading');
});";
	wp_add_inline_script('imagesloaded', $js_code);
	} 
	if(is_page_template('template-blog-masonry-4-random.php')||is_page_template('template-blog-masonry-4-random-2.php')||is_page_template('template-blog-masonry-4.php')||is_page_template('template-blog-masonry-3.php')||is_page_template('template-blog-masonry-2.php')){
	wp_enqueue_script('masonry');
	$js_code = "
	var container = document.querySelector('#masonry-list');
	imagesLoaded( container, function() {
        msnry = new Masonry( container, {
            itemSelector: 'article'
        });
    });";
	wp_add_inline_script('masonry', $js_code);
	}
}
add_action( 'wp_enqueue_scripts', 'designr_scripts' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
include get_parent_theme_file_path('includes/tgm/class-tgm-plugin-activation.php');
include get_parent_theme_file_path('includes/tgm/tgm-designr.php');
add_image_size("designr_testimonial", 52, 52, true);
add_image_size("designr_portfolio-fixed-width", 251, 999, false);
add_image_size("designr_blog1", 700, 300, true);
add_image_size("designr_blog2", 400, 200, true);
add_image_size("designr_blog3", 300, 150, true);
add_action( 'widgets_init', 'designr_widgets_init' );
function designr_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html( 'Sidebar', 'designr' ),
		'id'            => 'sidebardefault',
		'description' => __( 'Default for single post, pages...if not changed on Appearance->Sidebars.', 'designr' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
        'name' => __( 'Blog Sidebar', 'designr' ),
        'id' => 'sidebarblog',
        'description' => __( 'Category, archive and other blog pages', 'designr' ),
       		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title">',
	'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Widgets', 'designr' ),
        'id' => 'footer-widgets',
        'description' => __( 'For footer widgets only', 'designr' ),
        'before_widget' => '<div class="footer-widget">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>',
    ) );	
}

function designr_getHeader(){
	global $designr;
	$headerID = 1;
	if($designr['headerID']!=""){ $headerID = $designr['headerID'];}
    include get_parent_theme_file_path('includes/headers/header'.$headerID.'.php');
}
function designr_getPreloader(){
	global $designr;
	if($designr['preload-switch']==1){
		echo '<div id="loading"><div id="loading-center">';
	switch($designr['preloadertype']){
	case '1':	echo '<div id="loading-center-absolute">
<div class="object" id="object_one"></div>
<div class="object" id="object_two"></div>
<div class="object" id="object_three"></div>
<div class="object" id="object_four"></div>
<div class="object" id="object_five"></div>
<div class="object" id="object_six"></div>
</div>';break;
case '2': echo '<div id="loading-center-absolute2"><div class="object2" id="object1"></div>
<div class="object2" id="object2"></div>
<div class="object2" id="object3"></div></div>';break;
case '3': echo '<div id="loading-center-absolute3">
<div class="object3"></div>
<div class="object3"></div>
<div class="object3"></div>
<div class="object3"></div>
<div class="object3"></div>
<div class="object3"></div>
<div class="object3"></div>
<div class="object3"></div>
<div class="object3"></div>
<div class="object3"></div>
</div>';break;
	}
	echo '</div></div>';
}
}
function designr_getFooter(){
	global $designr;
	$footerID = 1;
	if($designr['footerID']!=""){ $footerID = $designr['footerID'];}
    include get_parent_theme_file_path('includes/footers/footer'.$footerID.'.php');
}
function designr_getOverlay(){
    include get_parent_theme_file_path('includes/overlay/overlay.php');
}
function designr_remove_redux_messages() {
	if(class_exists('ReduxFramework')){
		remove_action( 'admin_notices', array( get_redux_instance('theme_options'), '_admin_notices' ), 99);
	}
}
add_action('init', 'designr_remove_redux_messages');
function designr_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'designr' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'designr' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <footer class="comment-meta">
                    <div class="comment-author vcard">
                        <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<div class="comment-detailz">
                        <?php printf( __( '%s', 'designr' ), sprintf( '<h4>%s</h4>', get_comment_author() ) ); ?>
						  <div class="comment-metadata">
                                <p><?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'designr' ), get_comment_date(), get_comment_time() ); ?></p>
                        <?php edit_comment_link( __( 'Edit', 'designr' ), '<span class="edit-link">', '</span>' ); ?>
                    </div><!-- .comment-metadata -->
					</div>
                    </div><!-- .comment-author -->

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'designr' ); ?></p>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </article><!-- .comment-body -->
    <?php
        break;
    endswitch;
}
if ( ! function_exists( 'designr_get_primary_menu_class' ) ) :

	/**
	 * Primary menu wrap classes.
	 * 
	 * @param  string|array $class
	 * @return array
	 */
	function designr_get_primary_menu_class( $class = '' ) {
		$classes = designr_split_classes( $class );

		$config = Designr_config();
		switch( $config->get( 'header.menu.decoration.style' ) ) {
			case 'underline':
				$classes[] = 'underline-decoration';

				$classes[] = Designr_array_value( $config->get( 'header.menu.decoration.style.underline.direction' ), array(
					'left_to_right'      => 'l-to-r-line',
					'from_center'        => 'from-centre-line',
					'upwards'            => 'upwards-line',
					'downwards'          => 'downwards-line',
				) );
				break;
			case 'other':
				$classes[] = 'bg-outline-decoration';

				$classes[] = Designr_array_value( $config->get( 'header.menu.decoration.style.other.hover.style' ), array(
					'outline'    => 'hover-outline-decoration',
					'background' => 'hover-bg-decoration',
				) );

				if ( $config->get( 'header.menu.decoration.style.other.hover.line.enabled' ) ) {
					$classes[] = 'hover-line-decoration';
				}

				$classes[] = Designr_array_value( $config->get( 'header.menu.decoration.style.other.active.style' ), array(
					'outline'    => 'active-outline-decoration',
					'background' => 'active-bg-decoration',
				) );

				if ( $config->get( 'header.menu.decoration.style.other.active.line.enabled' ) ) {
					$classes[] = 'active-line-decoration';
				}

				if ( $config->get( 'header.menu.decoration.style.other.click_decor.enabled' ) ) {
					$classes[] = 'animate-click-decoration';
				}
				break;
		}

		if ( Designr_is_gradient_color_mode( $config->get( 'header.menu.hover.color.style' ) ) ) {
			$classes[] = 'gradient-hover';
		}

		if ( $config->get( 'header.menu.show_next_lvl_icons' ) ) {
			$classes[] = 'level-arrows-on';
		}

		$classes[] = Designr_array_value( $config->get( 'header.menu.items.margins.style' ), array(
			'double'   => 'outside-item-double-margin',
			'custom'   => 'outside-item-custom-margin',
			'disabled' => 'outside-item-remove-margin',
		) );

		$classes = apply_filters( 'Designr_primary_menu_class', $classes );

		return Designr_sanitize_classes( $classes );
	}

endif;

if ( ! function_exists( 'designr_get_primary_submenu_class' ) ) :

	/**
	 * Primary menu submenu classes.
	 * 
	 * @param  string|array $class
	 * @return array
	 */
	function designr_get_primary_submenu_class( $class = '' ) {
		$classes = designr_split_classes( $class );

		$classes = apply_filters( 'Designr_primary_submenu_class', $classes );

		return Designr_sanitize_classes( $classes );
	}

endif;

if ( ! function_exists( 'designr_nav_menu_list' ) ) :

	/**
	 * Display secondary nav menu.
	 * 
	 * @since  3.0.0
	 * @param  string $location
	 * @param  array  $class
	 */
	function designr_nav_menu_list( $location, $class = array() ) {
		$locations = get_nav_menu_locations();

		$menu = isset( $locations[ $location ] ) ? wp_get_nav_menu_object( $locations[ $location ] ) : null;
		if ( ! $menu ) {
			return;
		}

		$classes = designr_split_classes( $class );
		array_unshift( $classes, 'mini-nav' );
		echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';

		designr_nav_menu( array(
			'theme_location' => $location,
			'items_wrap' => '<ul id="' . esc_attr( "{$location}-menu" ) . '">%3$s</ul>',
			'submenu_class' => implode( ' ', designr_get_primary_submenu_class( 'sub-nav' ) ),
			'parent_is_clickable' => true,
			'fallback_cb' => '',
		) );

		echo '<div class="menu-select"><span class="customSelect1"><span class="customSelectInner">' . $menu->name . '</span></span></div>';

		echo '</div>';
	}

endif;

if ( ! function_exists( 'designr_primary_nav_menu' ) ) :

	/**
	 * Display theme primary nav menu.
	 * 
	 * @since  3.0.0
	 * @param  string $location
	 */
	function designr_primary_nav_menu( $location ) {
		do_action( 'designr_primary_nav_menu_before' );
		if(DESIGNR_ADDONS_ACTIVE){
		designr_nav_menu( array(
			'theme_location'      => $location,
			'items_wrap'          => '%3$s',
			'submenu_class'       => implode( ' ', designr_get_primary_submenu_class( 'sub-nav' ) ),
			'parent_is_clickable' => false,
		) );
		}
		else {
			wp_nav_menu( array(
			'theme_location'      => $location,
			'items_wrap'          => '%3$s',
			'submenu_class'       => implode( ' ', designr_get_primary_submenu_class( 'sub-nav' ) ),
			'parent_is_clickable' => false,
		) );
		}
		do_action( 'designr_primary_nav_menu_after' );
	}

endif;

if ( ! function_exists( 'designr_has_mobile_menu' ) ) :

	/**
	 * This helper checks if a page has mobile menu on it.
	 *
	 * @since 3.0.0
	 * @return boolean
	 */
	function designr_has_mobile_menu() {
		return apply_filters( 'designr_has_mobile_menu', has_nav_menu( 'mobile' ) );
	}

endif;

	function designr_split_classes( $class ) {
	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	}

	return $classes;
}

function Designr_sanitize_classes( $classes ) {
	$classes = array_map( 'esc_attr', $classes );
	$classes = array_filter( $classes );
	$classes = array_unique( $classes );
	return $classes;
}
		if ( !function_exists( 'designr_importr' ) ) {
	function designr_importr( $demo_active_import , $demo_directory_path ) {
		reset( $demo_active_import );
		$current_key = key( $demo_active_import );
		/************************************************************************
		* Setting Menus
		*************************************************************************/
		// If it's demo1 - demo6
		$wbc_menu_array = array( 'modern', 'unique','apps','classica','ecourse','fitness');
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Mainmenu', 'nav_menu' );
			$main_menu2 = get_term_by( 'name', 'Mainmenu2', 'nav_menu' );
			$modal1_menu = get_term_by( 'name', 'modal-left', 'nav_menu' );
			$modal2_menu = get_term_by( 'name', 'modal-center', 'nav_menu' );
			$modal3_menu = get_term_by( 'name', 'modal-right', 'nav_menu' );
			$mob_menu = get_term_by( 'name', 'mobile menu', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'primary' => $main_menu->term_id,
						'primary2' => $main_menu2->term_id,
						'mobile_menu'  => $mob_menu->term_id,
						'transparent' => $modal1_menu->term_id,
						'transparent2' => $modal2_menu->term_id,
						'transparent3' => $modal3_menu->term_id
					)
				);
			}
		}
		/* silder */
		if ( class_exists( 'RevSlider' ) ) {
			//if modern demo
			$wbc_sliders_array = array(
				'modern' => 'modernhome.zip'
			);
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}
		/************************************************************************
		* Set HomePage
		*************************************************************************/
		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'modern' => 'Home 1',
			'unique' => 'Home 2',
			'apps' => 'Homepage Apps',
			'classica' => 'Home 4',
			'ecourse' => 'eCourse Homepage',
			'fitness' => 'Fitness Home'
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
	}
}
	add_action( 'wbc_importer_after_content_import', 'designr_importr', 1, 2 );