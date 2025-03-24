<?php
/**
 * WP Bootstrap 4 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Bootstrap_4
 */
ini_set('max_execution_time', '3000');
ini_set('post_max_size', '256M');
ini_set('upload_max_filesize', '256M');
ini_set('max_input_time', '60');

if ( ! function_exists( 'wp_bootstrap_4_setup' ) ) :
	function wp_bootstrap_4_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'wp-bootstrap-4', get_template_directory() . '/languages' );
		// Add default posts and comments RSS feed links to head.

		// add_theme_support( 'automatic-feed-links' );
		
		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );
		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		// Enable Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'status', 'quote', 'link' ) );
		// Enable support for woocommerce.
		add_theme_support( 'woocommerce' );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wp-bootstrap-4' ),
		) );
		// Register Secondary Menu location 
		register_nav_menus( array(
			'client-area' => esc_html__( 'Secondary (Client Area)', 'wp-bootstrap-4' ),
		) );
		// Register Legal Footer Menu location
		register_nav_menus( array(
			'legal' => esc_html__( 'Legal (footer)', 'wp-bootstrap-4' ),
		) );
		// Switch default core markup for search form, comment form, and comments
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wp_bootstrap_4_custom_background_args', array(
			'default-color' => 'f8f9fa',
			'default-image' => '',
		) ) );
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wp_bootstrap_4_setup' );

// Add image in rss file
function featuredtoRSS($content) {
global $post;
$thumbnail_id = get_post_thumbnail_id( $post->ID );
if ( $thumbnail_id ) {
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
	$content = '<img src="' . esc_url( $thumbnail[0] ) . '">' . $content;
}
return $content;
}
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');

/**
* Add a title tag to the logo
 */
function my_custom_logo() {
	// Initialize
    $html = '';
	// The logo
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    // If has logo
    if ( $custom_logo_id ) {
    	// Attr
	    $custom_logo_attr = array(
			'class'    => 'custom-logo',
			'itemprop' => 'logo',
			'data-no-lazy' => '1',
		);
		// Image alt
		$image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
		if ( empty( $image_alt ) ) {
			$custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
		}
	    // Get the image
	    $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url" title="%2$s">%3$s</a>',
			esc_url( home_url( '/' ) ),
			esc_html( get_bloginfo( 'name' ) ),
			wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr )
		);
	}
	// If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
	elseif ( is_customize_preview() ) {
		$html = sprintf( '<a href="%1$s" class="custom-logo-link" style="display:none;"><img class="custom-logo"/></a>',
			esc_url( home_url( '/' ) )
		);
	}
	// Return
    return $html; 
}
add_filter( 'get_custom_logo', 'my_custom_logo' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_4_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_bootstrap_4_content_width', 800 );
}
add_action( 'after_setup_theme', 'wp_bootstrap_4_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_4_widgets_init() {
	// register_sidebar( array(
	// 	'name'          => esc_html__( 'Header Buttons', 'wp-bootstrap-4' ),
	// 	'id'            => 'header-buttons',
	// 	'description'   => esc_html__( 'Works for some headers.', 'wp-bootstrap-4' ),
	// 	'before_widget' => '<div class="mx-auto">',
	// 	'after_widget'  => '</div>',
	// 	'before_title'  => '<h2>',
	// 	'after_title'   => '</h2>',
	// ) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Social', 'wp-bootstrap-4' ),
		'id'            => 'header-social',
		'description'   => esc_html__( 'Works for some headers.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="%1$s" class="">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Client Zone', 'wp-bootstrap-4' ),
		'id'            => 'client-zone',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="%1$s" class="">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wp-bootstrap-4' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Default Sidebar. Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="heading">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Pages Sidebar', 'wp-bootstrap-4' ),
		'id'            => 'sidebar-pages',
		'description'   => esc_html__( 'Pages Sidebar. If empty, Default Sidebar is active. Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="heading">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'wp-bootstrap-4' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h6">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'wp-bootstrap-4' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h6">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'wp-bootstrap-4' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h6">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'wp-bootstrap-4' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="h6">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom Section', 'wp-bootstrap-4' ),
		'id'            => 'footer-bottom',
		'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-4' ),
		'before_widget' => '<div id="footer-bottom" class="widget footer-widget %2$s mb-0">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="h4">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wp_bootstrap_4_widgets_init' );

/** Enqueue scripts and styles.*/

function wp_bootstrap_4_scripts() {
	//wp_enqueue_style( 'open-iconic-bootstrap', get_template_directory_uri() . '/assets/css/open-iconic-bootstrap.min.css', array(), 'v4.0.0', 'all' );
	wp_enqueue_style( 'bootstrap-4', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), 'v4.0.0', 'all' );
	if ( is_rtl() ) {
		wp_enqueue_style( 'wp-bootstrap-4-spacer', get_template_directory_uri() . '/assets/css/spacer-rtl.min.css', array(), 'v4.0.0', 'all' );
	} else{
		wp_enqueue_style( 'wp-bootstrap-4-spacer', get_template_directory_uri() . '/assets/css/spacer.min.css', array(), 'v4.0.0', 'all' );
	}
	$lazyload =  get_field('lazyload','options'); 
	if($lazyload == true) {
	wp_enqueue_style( 'wp-bootstrap-4-theme-style-min', get_template_directory_uri() . '/assets/css/theme.min.css', array(), 'v4.0.0', 'all' );
	} else{
	wp_enqueue_style( 'wp-bootstrap-4-theme-style', get_template_directory_uri() . '/assets/css/theme.css', array(), 'v4.0.0', 'all' );
	}
	// GSAP Library extra styles
	$gsap =  get_field('gsap','options'); 
	if($gsap == true) {
	   wp_enqueue_style( 'gsap-base-style', get_template_directory_uri() . '/assets/css/gsap/base.css', array(), 'v4.0.0', 'all' );
	}
     // Custom styles css
	wp_enqueue_style( 'wp-bootstrap-4-style', get_stylesheet_uri(), array(), '1.0.2', 'all' );
    // Bootstrap 4 js
	wp_enqueue_script( 'bootstrap-4-min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), 'v4.0.0', true );
	// Theme effect plugins js
	$scroll_me =  get_field('scroll_me','options');
	if($scroll_me == true) { 
	wp_enqueue_script( 'scrollme-min', get_template_directory_uri() . '/assets/js/jquery.scrollme.min.js', array('jquery'), '1.0.5', true );
	}
	$softscroll =  get_field('softscroll','options'); 
	if($softscroll == true ) {
	wp_enqueue_script( 'lenis-min', get_template_directory_uri() . '/assets/js/lenis.js', array(), 'v4.0.0', true );
	}
	$parallax_hover =  get_field('parallax_hover','options'); 
	if($parallax_hover == true) {
	wp_enqueue_script( 'atvImg', get_template_directory_uri() . '/assets/js/atvImg.min.js', array(), 'v4.0.0', true );
	}
	if($lazyload == true) {
		wp_enqueue_script( 'lazyload-min', get_template_directory_uri() . '/assets/js/lazyload.min.js', array('jquery'), 'v4.0.0', true );
	}
	//Slick slider
	$slick_slider =  get_field('slick_slider','options'); 
	if($slick_slider == true) {
     wp_register_style('slickcss', get_stylesheet_directory_uri() . '/assets/slick/slick.css' );
     //load slick js
     wp_register_script('slickslider', get_stylesheet_directory_uri() . '/assets/slick/slick.min.js', array('jquery'), true, true );
     //load slick initiate script
     wp_register_script( 'slickinit', get_stylesheet_directory_uri() . '/assets/slick/slick-init.js',  array( 'jquery', 'slickslider' ),true, true );

       // load Slick on chosen pages
	   // New ACF field (assumes it returns an array of selected items):
		$selected_pages = get_field('page_select', 'option');

		// If nothing is selected, enqueue scripts everywhere
		if (!$selected_pages) {
			wp_enqueue_style('slickcss');
			wp_enqueue_script('slickslider');
			wp_enqueue_script('slickinit');
		}

		// 1) Check if "All Posts" (key = 'all') is selected.
		//    If yes, load Slick on ALL single blog posts.
		if (in_array('all', $selected_pages)) {
			if (is_singular('post')) {
				wp_enqueue_style('slickcss');
				wp_enqueue_script('slickslider');
				wp_enqueue_script('slickinit');
			}
		}

		// 2) Additionally, load Slick if the current Page/Post ID
		//  is explicitly in the $selected_pages array.
		$current_id = get_queried_object_id();
		if (in_array($current_id, $selected_pages)) {
			wp_enqueue_style('slickcss');
			wp_enqueue_script('slickslider');
			wp_enqueue_script('slickinit');
		}
        
        // Old Condition for filtering: not used filed but still exsisting and hidden by add_filter(...) function down there 
		// Get ACF field value (Assuming the ACF field key is 'slick_slider_pages')
		$page_slugs = get_field('slick_slider_on_pages', 'option'); // Replace 'option' with appropriate ACF context if not global
		if (!$page_slugs) {
		// If no pages are specified, enqueue scripts everywhere
		// wp_enqueue_style('slickcss');
		// wp_enqueue_script('slickslider');
		// wp_enqueue_script('slickinit');
		} else {
			// Explode comma-separated slugs into an array
			$page_slugs_array = array_map('trim', explode(',', $page_slugs));
			// Get current page slug
			$current_slug = get_post_field('post_name', get_queried_object_id());
			// Check if the current page slug is in the ACF field array
			if (in_array($current_slug, $page_slugs_array)) {
				// wp_enqueue_style('slickcss');
				// wp_enqueue_script('slickslider');
				// wp_enqueue_script('slickinit');
			}
		}
    }
	// Theme js
    wp_enqueue_script( 'wp-bootstrap-4-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), 'v1.0.0', true );

	// GSAP Library and other related extensions for it
	if($gsap == true) {
	// Here is double called script. Needs to be fixed!!!
		wp_enqueue_script( 'gsap-min', get_template_directory_uri() . '/assets/js/gsap/gsap.min.js', array(), 'v3.12.2', true );
		wp_enqueue_script( 'ScrollTrigger-min', get_template_directory_uri() . '/assets/js/gsap/ScrollTrigger.min.js', array(), 'v3.12.2', true );
		//wp_enqueue_script( 'Lenis-min', get_template_directory_uri() . '/assets/js/gsap/lenis.min.js', array(), 'v3.12.3', true );
		wp_enqueue_script( 'Lottie-min', get_template_directory_uri() . '/assets/js/gsap/lottie.min.js', array(), 'v3.12.3', true );
		wp_enqueue_script( 'Imagesloaded-min', get_template_directory_uri() . '/assets/js/gsap/imagesloaded.pkgd.min.js', array(), 'v3.12.3', true );
		//wp_enqueue_script( 'Draggable-min', get_template_directory_uri() . '/assets/js/gsap/Draggable.min.js', array(), 'v3.12.3', true );
		wp_enqueue_script( 'gsap-index', get_template_directory_uri() . '/assets/js/gsap/index.js', array(), 'v3.12.3', true );
		
		wp_enqueue_script( 'gsap-index-module', get_template_directory_uri() . '/assets/js/gsap/index-module.js', array(), 'v3.12.3', true );
		// Add the `type="module"` attribute
		add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
			// Check if it's the specific script
			if ( 'gsap-index-module' === $handle ) {
				// Add `type="module"` attribute
				$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
			}
			return $tag;
		}, 10, 3 );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_4_scripts' );

// Insert Table of Content after first paragraph in post content
add_filter('the_content', 'wp_toc_content');
function wp_toc_content($content){
    if (!is_single()) return $content;
	$string = __( 'On this article you will find', 'wp-bootstrap-4' );
	 $tocAfter = 1; //Enter number of h2 to display banner after.
		$content = explode("</p>", $content);
		$new_content = '';
		for ($i = 0; $i < count($content); $i++) {
			if ($i == $tocAfter) {
				$new_content.= '<div id="toc" role="doc-toc" class="mb-3 mt-0 mx-auto">';
				$new_content.= ' <span id="toc-heading" class="h5 mb-3 d-block">'. $string .'</span>';
				$new_content.= '</div>';
			}
			$new_content.=  $content[$i] ."</p>" ;
		}
		return $new_content;
 
   return $content;
}

// Append inline init scripts in footer
require get_template_directory() . '/template-parts/footer-scripts/footer-inline-scripts.php';
add_action('wp_footer', 'add_inline_scripts_to_footer', 100);

// Admin dashboard css
add_action('admin_head', 'admin_css');
function admin_css() {
  echo '<link rel="stylesheet" id="wp-admin-style-css" href="'.get_template_directory_uri().'/assets/css/admin.css" type="text/css" media="all">';
}

// Registers an editor stylesheet for the theme.
function wp_bootstrap_4_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'wp_bootstrap_4_add_editor_styles' );

// Add inline root css
function hook_in_head() {
    get_template_part( 'template-parts/head/inline-css' );
	echo get_field('insert_header', 'option');
}
add_action('wp_head', 'hook_in_head');

// Disable Lazy Loading in WordPress
add_filter('wp_lazy_loading_enabled','__return_false');
// Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';
// Implement the Custom Comment feature.
require get_template_directory() . '/inc/custom-comment.php';
// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';
// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';
// Custom Navbar
require get_template_directory() . '/inc/custom-navbar.php';
// Customizer additions.
require get_template_directory() . '/inc/tgmpa/tgmpa-init.php';
// Use Kirki for customizer API
require get_template_directory() . '/inc/theme-options/add-settings.php';
// Customizer additions.
require get_template_directory() . '/inc/customizer.php';
// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Remove the prefix "Category:" or "Tag:" from the archive pages
function custom_archive_title($title) {
    // Remove "Category: " from title
    if (is_category()) {
        $title = single_cat_title('', false);
    }
    // Remove "Tag: " from title
    elseif (is_tag()) {
        $title = single_tag_title('', false);
    }
    // Remove "Author: " from title
    elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }
    // Remove "Archives: " from other archives (like dates)
    elseif (is_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
}
add_filter('get_the_archive_title', 'custom_archive_title');

// Kirki: Load all font variants
add_action( 'after_setup_theme',  'font_add_all_variants', 100 );
function font_add_all_variants() {
	if ( class_exists( 'Kirki_Fonts_Google' ) ) {
		Kirki_Fonts_Google::$force_load_all_variants = true;
	}
}
// Load WooCommerce compatibility file.
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Custom WooCommerce products grid
function custom_woocommerce_category_shortcode($atts) {
    // Shortcode attributes with default values
    $atts = shortcode_atts(
        array(
            'category' => '',  // Category slug (default is empty)
            'limit' => '4',    // Number of products to display (default is 4)
            'columns' => wp_bootstrap_4_woocommerce_bootstrap_columns(),  // Number of columns (default is set in function)
        ),
        $atts,
        'custom_category_products'
    );

    // Setup the query arguments
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => intval($atts['limit']),
        'product_cat' => sanitize_text_field($atts['category']),
    );

    // Start output buffering
    ob_start();

    // Run the query
    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        echo woocommerce_product_loop_start();

        while ($loop->have_posts()) : $loop->the_post();
            global $product;

            echo '<li class="custom-product d-flex flex-column ' . esc_attr($atts['columns']) . ' mt-4 mt-lg-5">';
		
		    // Product Header Wrapper 
             echo '<div class="product-header-wrapper">';
            // Product Image
            if (has_post_thumbnail()) {
                echo '<a class="product-img-link" href="' . get_permalink() . '" title="' . get_the_title() . '">';
                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                echo '</a>';
            }
		
            // Buttons Wrapper
            echo '<div class="product-button-holder text-center">';
		    // Add to Cart Button
            echo '<a href="' . esc_url($product->add_to_cart_url()) . '" class="button add_to_cart_button">' . esc_html($product->add_to_cart_text()) . '</a>';
		    echo '</div>';
		    echo '</div>';
		
		    // Product Details
		    echo '<div class="product-details text-center">';
            // Product Title
            echo '<h3 class="product-title h5 text-dark mt-3"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
            // Product Price
            echo '<span class="price">' . $product->get_price_html() . '</span>';
            echo '</div>';
		
            echo '</li>';

        endwhile;

        echo woocommerce_product_loop_end();
    } else {
        echo __('No products found');
    }

    // Reset post data
    wp_reset_postdata();

    // Return the output
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('custom_category_products', 'custom_woocommerce_category_shortcode');




// Remove sorting dropdown
function remove_woocommerce_catalog_ordering() {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}
add_action('init', 'remove_woocommerce_catalog_ordering');

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to cart', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  

function woocommerce_custom_product_add_to_cart_text() {
	return __( 'Add to cart', 'woocommerce' ); 
}

// Change Theme Update Server
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://s3.ap-south-1.amazonaws.com/wp-bootstrap-4/theme.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'wp-bootstrap-4-pro'
);

// Dequeue Unused Styles
function dequeue_unnecessary_styles() {
	if ( ! is_user_logged_in() ) {
	   //wp_dequeue_style( 'dashicons' );
	   //wp_deregister_style( 'dashicons' );
   }
   wp_dequeue_style( 'classic-theme-styles' );
   wp_deregister_style( 'classic-theme-styles' );
   wp_dequeue_style( 'wp-block-library' );
   wp_deregister_style( 'wp-block-library' );
   wp_dequeue_style( 'wc-blocks-vendors-style' );
   wp_deregister_style( 'wc-blocks-vendors-style' );
   wp_dequeue_style( 'wc-blocks-style' );
   wp_deregister_style( 'wc-blocks-style' );
   wp_dequeue_style( 'contact-form-7' );
   wp_deregister_style( 'contact-form-7' );
}
add_filter( 'wp_print_styles', 'dequeue_unnecessary_styles', 100);

// Remove global styles
add_action( 'wp_enqueue_scripts', 'remove_global_styles' );
function remove_global_styles(){
wp_dequeue_style( 'global-styles' );
}
// Dequeue Unused JavaScripts
function dequeue_unnecessary_scripts() {
   //wp_dequeue_script( 'wp-embed' );
   //wp_deregister_script( 'wp-embed' );
}
add_filter( 'wp_print_scripts', 'dequeue_unnecessary_scripts', 100);

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove JQuery migrate
function remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		 $script = $scripts->registered['jquery'];
	if ( $script->deps ) { 
	 // Check whether the script has any dependencies
		$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
	  }
   }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

// Check the customizer setting to determine whether to remove 'srcset' and 'sizes'

function disable_featured_image_responsive_attributes($attr, $attachment, $size) {
    // Check if we are not on a single post page
    if ( !is_single() ) {
		$remove_srcset = get_theme_mod('remove_srcset', true); // Assuming 'remove_srcset' is the ID of your Kirki field
		if ($remove_srcset) {
			// Get the featured image ID of the current post
			$featured_image_id = get_post_thumbnail_id();

			// Check if the current image is the featured image
			if ( $attachment->ID == $featured_image_id ) {
				// Remove 'srcset' and 'sizes' attributes
				unset($attr['srcset']);
				unset($attr['sizes']);
			}
		}
    }
    return $attr;
}

// Hook the function to 'wp_get_attachment_image_attributes'
add_filter( 'wp_get_attachment_image_attributes', 'disable_featured_image_responsive_attributes', 10, 3 );

// Shortcode for Site URL - Use [site_url] for Shortcode 
//=================================================
add_action( 'init', function() { 	
	add_shortcode( 'site_url', function( $atts = null, $content = null ) {
 	return site_url(); 	
} ); });

// Shortcode for Site Name - Use [site_name] for Shortcode 
//=================================================
add_action( 'init', function() { 	
	add_shortcode( 'site_name', function( $atts = null, $content = null ) {
 	return get_bloginfo( 'name' ); 	
} ); });

// Login form function with self redirect
add_shortcode( 'wp_log_in', 'wp_log_in' );
function wp_log_in() {
	$args = array(
	  'echo'            => true,
	  'redirect'        => get_permalink( get_the_ID() ),
	  'remember'        => true,
	  'value_remember'  => true,
	);
	return wp_login_form( $args );
}

// Woocommerce Login form function with self redirect
add_shortcode( 'wc_login_form', 'wc_login_form' );
function wc_login_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return; 
   ob_start();
   woocommerce_login_form( 
	array( 
		'redirect' => get_permalink( get_the_ID() ), 
	) 
	);
   return ob_get_clean();
}

// Log Out function with redirect
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}

// Change the redirect URL for the Return To Shop button in the cart.
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );
function wc_empty_cart_redirect_url() {
	return home_url();
}

// Change name Return To Shop button with other name.
add_filter( 'gettext', 'change_woocommerce_return_to_shop_text', 20, 3 );
function change_woocommerce_return_to_shop_text( $translated_text, $text, $domain ) {
        switch ( $translated_text ) {
            case 'Return to shop' :
                $translated_text = __( 'Return to order', 'woocommerce' );
                break;
        }
    return $translated_text;
}

// ACF ICON PICKER CONFIG
// modify the path to the icons directory
add_filter( 'acf_icon_path_suffix', 'acf_icon_path_suffix' );
function acf_icon_path_suffix( $path_suffix ) {
    return 'assets/images/bootstrap-icons/';
}
// modify the path to the above prefix
add_filter( 'acf_icon_path', 'acf_icon_path' );
function acf_icon_path( $path_suffix ) {
    return plugin_dir_path( __FILE__ );
}
// modify the URL to the icons directory to display on the page
add_filter( 'acf_icon_url', 'acf_icon_url' );
function acf_icon_url( $path_suffix ) {
    return plugin_dir_url( __FILE__ );
}

// Adding icon fields to Menu Items
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
    // loop
    foreach( $items as &$item ) {
        // vars
        $icon = get_field('icon', $item);
		$icon_url = get_template_directory_uri().'/assets/images/bootstrap-icons/'.$icon.'.svg';
		$name = $item->title;
        // prepend icon
        if( $icon ) {
            $item->title = '<img width="16" height="16" class="nav-icon" src="'.$icon_url.'" alt="'.$name.'"/> <span class="nav-title">'.$item->title.'</span>';
        }
    }
    // return
    return $items;
}
// Create Category select fields option
add_filter('acf/load_field/name=category_select', function ($field) {
    // Fetch all categories
    $categories = get_categories([
        'hide_empty' => false, // Show all categories, even if they have no posts
    ]);

    // Prepare the choices array
    $choices = [];
    foreach ($categories as $category) {
        $choices[$category->term_id] = $category->name; // Term ID as the value, name as the label
    }

    // Assign choices to the field
    $field['choices'] = $choices;

	// Ensure the field supports multiple selections
    $field['multiple'] = true;

    return $field;
});

// Create Page select fields option (example)
add_filter('acf/load_field/name=page_select', function ($field) {
    // Fetch all pages
    $pages = get_pages([
        'post_type'   => 'page',
        'post_status' => 'publish',
        'number'      => 0, // 0 or -1 will retrieve all pages
    ]);

    // Prepare the choices array
    $choices = [];
    
    // --- 1) Add a custom "All Posts" option at the top ---
    $choices['all'] = 'All Posts';  
    
    // --- 2) Dynamically load all pages ---
    foreach ($pages as $page) {
        $choices[$page->ID] = $page->post_title;
    }

    // Assign choices to the field
    $field['choices'] = $choices;

    // Enable multiple selection if needed
    $field['multiple'] = true;

    return $field;
});

// Hide text field for "category by slug" registered in block post php
add_filter('acf/load_field/name=category_name', function ($field) {
    // Modify the field settings to effectively hide it without breaking ACF
    if (is_admin()) {
        $field['wrapper']['class'] .= ' hidden';
        $field['wrapper']['style'] = 'display:none;';
    }
    return $field;
});
// Hide the "slick_slider_on_pages" field
add_filter('acf/load_field/name=slick_slider_on_pages', function ($field) {
    if (is_admin()) {
        $field['wrapper']['class'] .= ' hidden';
        $field['wrapper']['style']  = 'display:none;';
    }
    return $field;
});

// Add default image setting to ACF image fields
// let's you select a defualt image
// this is simply taking advantage of a field setting that already exists
add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');
function add_default_value_to_image_field($field) {
	acf_render_field_setting( $field, array(
		'label'			=> 'Default Image',
		'instructions'		=> 'Appears when creating a new post',
		'type'			=> 'image',
		'name'			=> 'default_value',
	));
}

// Default Image make it display on the front-end
add_filter('acf/load_value/type=image', 'reset_default_image', 10, 3);
function reset_default_image($value, $post_id, $field) {
  if (!$value) {
    $value = $field['default_value'] = 25800000000;
	//$value = $field['default_value'];
  }
  return $value;
}
// Generate a stable UID for each row the first time it's saved.
add_filter('acf/update_value/name=custom_id', 'set_stable_uid', 10, 4);
function set_stable_uid($value, $post_id, $field, $original) {
    // If already has a value, do nothing
    if ( ! empty( $value ) ) {
        return $value;
    }
   // If it's empty, generate a one-time ID (e.g., uniqid).
    return uniqid('section_');
}

// Acf flexable content blocks builder
function acf_blocks() {
	// Check value exists.
	if( have_rows('blocks') ):
		$blocks = array (
			 'content_with_image',
			 'content_only',
			 'cards',
			 'lists',
			 'accordions',
			 'slider',
			 'modal',
			 'testimonials',
			 'video',
			 'tabs',
			 'timeline',
			 'posts',
		);
		// Loop through rows.
		while ( have_rows('blocks') ) : the_row();
			$layout = get_row_layout();

			if( in_array(get_row_layout(), $blocks) ){
				get_template_part( 'template-parts/blocks/block', $layout);
			}
		// End loop.
		endwhile;
	endif;
}
add_shortcode('acf_blocks','acf_blocks');

// Acf Global Options
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}
//Global Modal repeater
function acf_header_cta() {
	get_template_part( 'template-parts/shortcodes/shortcode', 'header-cta' );
}
add_shortcode('acf_header_cta','acf_header_cta');
//Global Modal repeater
function acf_global_modal() {
	get_template_part( 'template-parts/shortcodes/shortcode', 'modal' );
}
add_shortcode('acf_global_modal','acf_global_modal');
// To change excerpt length, adjusting the “20” to match the number of words you wish to display in the excerpt:
function custom_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'blog_grid_excerpt', 20 );
    return $excerpt_length;
}
// Change Or Remove The Dots […] At The End Of Excerpts
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Custom bootsrap pagination
function bootstrap_pagination() {
	global $wp_query;
	if ( $wp_query->max_num_pages <= 1 ) return; 
	$big = 999999999; // need an unlikely integer
	$translated = __( 'Page', 'wp-bootstrap-4' ); // Supply translatable string
	$pagination  = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'mid_size' => 3,
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_text' => '<img src="' .get_template_directory_uri() . '/assets/images/bootstrap-icons/chevron-double-left.svg" alt="icon left" style="max-width: 1rem;"/>',
			'next_text' => '<img src="' .get_template_directory_uri() . '/assets/images/bootstrap-icons/chevron-double-right.svg" alt="icon right" style="max-width: 1rem;"/>',
			'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
	) );
	if( is_array( $pagination ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<nav class="pagination-wrap" aria-label="page navigation"><ul class="pagination">';
		foreach ( $pagination  as $key => $page_link ) {
				echo "<li class='page-item";
				$link = htmlspecialchars($page_link);
				$link = str_replace( ' current', '', $link);
				if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; }
				echo "'>";
				if ( $link ) {
					$link = str_replace( 'page-numbers', 'page-link', $link);
				}
				echo htmlspecialchars_decode($link);
				echo "</li>";
		}
		echo '</ul></nav>';
	}
}

// Shortcode Display Posts
function shortcode_display_post($attr, $content = null){
global $post;
// Defining Shortcode's Attributes
$shortcode_args = shortcode_atts(
		array(
			'category_name' => '',
			'num'     => '100',
			'post_type' => 'post',
			'post_status' => 'publish',
			'class' => 'col-12 col-md-6 col-lg-4',
			'image_size' => '',
			'as_slider' => '',
			'as_banner' => '',
			'as_banner_first' => '',
			'as_list' => '',
			'excerpt' => 'true',
			'with_button' => 'true',
			'data_no_lazy' => ''
			), $attr);    
// array with query arguments
$args = array(
			'category_name' => $shortcode_args['category_name'],
			'posts_per_page' => $shortcode_args['num'],
			'post_type' => $shortcode_args['post_type'],
			'post_status' => 'publish',
	        'class' => $shortcode_args['class'],
			'image_size' => $shortcode_args['image_size'],
	        'as_slider' => $shortcode_args['as_slider'],
	        'as_banner' => $shortcode_args['as_banner'],
	        'as_banner_first' => $shortcode_args['as_banner_first'],
	        'as_list' => $shortcode_args['as_list'],
	        'excerpt' => $shortcode_args['excerpt'],
	        'with_button' => $shortcode_args['with_button'],
	        'data_no_lazy' => $shortcode_args['data_no_lazy'],
	        'suppress_filters' => false,
		);
$cat_posts = get_posts($args);
$string = __( 'Read the article', 'wp-bootstrap-4' );
$as_banner = $grid_row = $data_no_lazy = $as_banner_first = $as_list = $post_content = $button_offset = $as_banner_first_class = '';
$classes = $shortcode_args['class'];
if ('true' === $shortcode_args['as_banner'] ):
	$grid_row = 'grid-row';
	$as_banner = 'as_banner';
endif;
if ('true' === $shortcode_args['data_no_lazy'] ):
	$data_no_lazy = '1';
endif;
if ('true' === $shortcode_args['as_banner_first'] ):
	$as_banner_first = 'as_banner_first';
endif; 
if ('true' === $shortcode_args['as_list'] ):
	$as_list = 'as_list';
	$as_list_card_row = 'flex-md-row';
	$post_content = 'p-3';
endif; 
if (('' === $shortcode_args['as_banner'] && '' === $shortcode_args['as_list'])) :
	$post_content = 'p-3';
endif; 	
if ('true' === $shortcode_args['with_button'] ):
	$button_offset  = 'mb-3';
endif; 	
	
$output = '<div class="row '.$as_banner_first.' '.$grid_row.'">';
foreach ($cat_posts as $key =>  $post) :

if ('true' === $shortcode_args['as_banner_first'] && $key == 0):
	$as_banner = 'as_banner';
	$classes = 'col-12';
elseif ('true' === $shortcode_args['as_banner_first'] && $key > 0):
	$as_banner = '';
	$classes = $shortcode_args['class'];
endif;
// $categories = get_the_category_list( '', '', $post->ID );
$image = get_field('feature_img');
$size = 'medium'; // (thumbnail, medium, large, full or custom size)
if (('full' === $shortcode_args['image_size'] )):
	$size = 'full'; 
elseif (('large' === $shortcode_args['image_size'] )):	
	$size = 'large';
elseif (('thumbnail' === $shortcode_args['image_size'] )):	
	$size = 'thumbnail'; 
endif;
setup_postdata($post);
	if ('true' === $shortcode_args['as_banner_first'] ):
		// Conditional wrapper
		if ($key == 0) {
			$output .= '<div class="col-5"><div class="row">';
		} elseif ($key == 1) {
			$output .= '<div class="col-7"><div class="row">';
		}
	endif;
	$output .= '<div class="post-item post-item-'.$key.' '.$as_list.' '.$as_banner.' '.$shortcode_args['as_slider'].' '.$classes.' d-flex">';
if (('true' === $shortcode_args['as_banner'] ) || ('true' === $shortcode_args['as_banner_first'] && $key == 0)):
	$output .= '<a class="card w-100 border-0" href="'.get_permalink().'" title="'.get_the_title().'">';  
else :
	$output .= '<div class="card w-100 '.$as_list_card_row.' border-0">';
	$output .= '<a class="card-header card-header-archive px-0 pb-0" href="'.get_permalink().'" title="'.get_the_title().'">';     
endif;
if($image):
	if ('true' === $shortcode_args['data_no_lazy'] ):
	$output .= ''. wp_get_attachment_image($image, $size, false, array('alt' => get_the_title(), 'class' => 'feature_img acf-img', 'data-no-lazy'=>$data_no_lazy )).'';
	else :
	$output .= ''. wp_get_attachment_image($image, $size, false, array('alt' => get_the_title(), 'class' => 'feature_img acf-img')).'';
	endif; 
else :
	if ('true' === $shortcode_args['data_no_lazy'] ):
	$output .= ''. wp_get_attachment_image( get_post_thumbnail_id(), $size, false, array('class' => 'feature_img size-'.$size.'', 'data-no-lazy'=>$data_no_lazy ) ) .'';
	else :
	$output .= ''. wp_get_attachment_image( get_post_thumbnail_id(), $size ) .'';
	endif; 
endif; 
   $output .= '</a>';
if (('true' === $shortcode_args['as_banner'] ) || ('true' === $shortcode_args['as_banner_first'] && $key == 0)):
	$output .= '<h2 class="as_banner-content entry-title card-title text-white">'.get_the_title().'</h2>';
// 	$output .=  $categories;	
endif;
if (('' === $shortcode_args['as_banner'] && ('true' === $shortcode_args['as_banner_first'] && $key > 0)) || 
	('true' === $shortcode_args['as_list'] && $key > 0)  || 
	('true' === $shortcode_args['as_list'] && '' === $shortcode_args['as_banner_first']) ||
	('' === $shortcode_args['as_banner'] && '' === $shortcode_args['as_list'])):
	// Start Card Body
	$output .= '<div class="card-body d-flex flex-column align-items-start '.$post_content.'">';
// 	$output .= $categories;
	$output .= '<h2 class="entry-title card-title"><a class="" href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';
	if ('true' === $shortcode_args['excerpt'] ):
    $output .= '<div class="entry-summary '.$button_offset.'">'.get_the_excerpt().'</div>';
    endif;
	if ('true' === $shortcode_args['with_button'] ):
	$output .= '<a class="btn btn-primary btn-sm text-uppercase mt-auto" href="'.get_permalink().'" title="'.get_the_title().'">'.$string.' ';
	if ( is_rtl() ) {
		$output .= '<img class="ml-1" width="14px" height="14px" src="' .get_template_directory_uri() . '/assets/images/bootstrap-icons/chevron-left.svg" alt="icon left" style="filter: invert(1); max-width: 14px;"/>';
	} else{
		$output .= '<img class="ml-1" width="14px" height="14px" src="' .get_template_directory_uri() . '/assets/images/bootstrap-icons/chevron-right.svg" alt="icon right" style="filter: invert(1); max-width: 14px;"/>';
	}
	$output .= '</a>';
	endif;	
	$output .= '</div>'; // End Card Body
endif;
if (('true' === $shortcode_args['as_banner'] ) || ('true' === $shortcode_args['as_banner_first'] && $key == 0)):
else :
	$output .= '</div>';
endif;
	if ('true' === $shortcode_args['as_banner_first'] ):
	   // Close the first wrapper or remaining posts wrapper after the last post
	   if ($key == 0) {
		  $output .= '</div></div>'; // Close first-post-wrapper
	   } elseif ($key == count($cat_posts) - 1) {
		  $output .= '</div></div>'; // Close remaining-posts-wrapper
	   }
	endif;
	$output .= '</div>';
endforeach;    
wp_reset_postdata();
$output .= '</div>';
return $output;
}
add_shortcode( 'posts', 'shortcode_display_post');

// Shortcode Display Posts by ID selected
function shortcode_display_post_by_id($attr, $content = null){
global $post;
// Defining Shortcode's Attributes
$shortcode_args = shortcode_atts(
		array(
			'post_status' => 'publish',
			'class' => 'col-12 col-md-6 col-lg-4',
			'as_slider' => '',
			'as_banner' => '',
			'as_list' => '',
			'excerpt' => '',
			'id' => '',
			), $attr);    
// array with query arguments
$args = array(
			'post_status' => 'publish',
	        'class' => $shortcode_args['class'],
	        'as_slider' => $shortcode_args['as_slider'],
	        'as_banner' => $shortcode_args['as_banner'],
	        'as_list' => $shortcode_args['as_list'],
	        'excerpt' => $shortcode_args['excerpt'],
	        'id' => $shortcode_args['id'],
            'suppress_filters' => false,
		);
$string = __( 'Read the article', 'wp-bootstrap-4' );
$as_banner = '';
if ('true' === $shortcode_args['as_banner'] ):
	$as_banner = 'as_banner';
endif; 
$as_list = '';
$post_content = '';
if ('true' === $shortcode_args['as_list'] ):
	$as_list = 'as_list';
	$post_content = 'p-3';
endif; 
$output = '<div class="row">';
foreach (explode(',', $shortcode_args['id']) as $post) :
// $categories = get_the_category_list( '', '', $post->ID );
$image = get_field('feature_img');
$size = 'medium'; // (thumbnail, medium, large, full or custom size)
setup_postdata($post);
	$output .= '<div class="post-item '.$as_list.' '.$as_banner.' '.$shortcode_args['as_slider'].' '.$shortcode_args['class'].' d-flex">';
if ('' === $shortcode_args['as_banner'] ):
	$output .= '<div class="card w-100 border-0"> <div class="card-header p-0">';
endif;
	$output .= '<a class="card w-100 flex-md-row border-0" href="'.get_permalink().'" title="'.get_the_title().'">';        
if($image):
	$output .= ''. wp_get_attachment_image($image, $size, false, array('alt' => get_the_title(), 'class' => 'feature_img acf-img')).'';
else :
	$output .= ''. wp_get_attachment_image( get_post_thumbnail_id(), $size ) .'';
endif; 
    $output .= '</a>';
if ('true' === $shortcode_args['as_banner'] ):
	$output .= '<h2 class="as_banner-content entry-title card-title text-white">'.get_the_title().'</h2>';
// 	 $output .= $categories;
else :
    $output .= '</div>';
	$output .= '<div class="card-body d-flex flex-column '.$post_content.'">';
	$output .= '<h2 class="entry-title card-title"><a class="text-dark" href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';
	if ('true' === $shortcode_args['excerpt'] ):
    $output .= '<div class="entry-summary">'.get_the_excerpt().'</div>';
    endif;
	$output .= '</div>';
endif;
if ('' === $shortcode_args['as_banner'] ):
	$output .= '</div>';
endif;
	$output .= '</div>';
endforeach;    
	
wp_reset_postdata();
$output .= '</div>';
return $output;
}
add_shortcode( 'posts_id', 'shortcode_display_post_by_id');

// Shortcode Display Team
function shortcode_display_team($attr, $content = null){
global $post;
// Defining Shortcode's Attributes
$shortcode_args = shortcode_atts(
array(
	'category_name' => '',
	'num'     => '100',
	'post_type' => 'team',
	'post_status' => 'publish'
	), $attr);    

// array with query arguments
$args = array(
	'category_name' => $shortcode_args['category_name'],
	'posts_per_page' => $shortcode_args['num'],
	'post_type' => $shortcode_args['post_type'],
	'post_status' => 'publish'
	);
	
$cat_posts = get_posts($args);
$output = '<div class="row justify-content-center">';

foreach ($cat_posts as $post) :
setup_postdata($post);
	$team_position = get_field('team_position');
	$output .= '<div class="team-item col-12 col-md-6 col-lg-4 col-xl-3 d-flex mb-4"> <div class="card">';
	$output .= '<div class="card-header p-0" style="position: relative;">';        
	$output .= ''. wp_get_attachment_image( get_post_thumbnail_id(), 'team-img' ) .'';
	if ( have_rows('social_repeater') ) : 
		$output .= '<div class="team-socials">';
				while( have_rows('social_repeater') ) : the_row();
				$social_url = get_sub_field('social_url');
				$social_icon = get_sub_field('social_icon');
				if ($social_url):
				$output .= '<a class="mx-1" rel="noopener norefferer" target="_blank" href="'.$social_url.'" title="Follow '.get_the_title().'">';
					if ($social_icon):
					$output .= '<img width="20" height="20" class="social_img" src="'.$social_icon.'" alt="social icon" style="max-width: 20px;"/>';
					endif; 
				$output .= '</a>';
				endif; 
				endwhile; 
		$output .= '</div>';
	endif; 
	$output .= '</div>';
	$output .= '<div class="card-body d-flex flex-column text-center"><h2 class="entry-title card-title h6">'.get_the_title().'</h2>';
	if( $team_position ): 
	$output .= '<div>'.$team_position.'</div>';
	endif; 
	$output .= '</div></div></div>';
endforeach;    

wp_reset_postdata();
$output .= '</div>';
return $output;
}

add_shortcode( 'post_type_team', 'shortcode_display_team');

// Shortcode Display Cards
function shortcode_display_card($attr, $content = null){
global $post;
// Defining Shortcode's Attributes
$shortcode_args = shortcode_atts(
array(
	'category_name' => '',
	'tag' => 'OR',
	'relation' => '',
	'num'     => '100',
	'post_type' => 'card',
	'post_status' => 'publish',
	'class' => 'col-brand col-sm-4 col-md-3 col-lg-2 col-xl-2',
	//'orderby' => 'title',
	//'order'   => 'ASC',
	), $attr);    
$cstag = sanitize_text_field( $shortcode_args['tag'] );
// array with query arguments
$args = array(
	'category_name' => $shortcode_args['category_name'],
	'tax_query'      => array(
		'relation' => $shortcode_args['relation'],
		array(
			'taxonomy' => 'post_tag', // Use Your Taxonomy Type Here.
			'terms'    => $cstag,
			'field'    => 'slug', // This depends on how your're passing it in the $cstag.
		),
	),
	'posts_per_page' => $shortcode_args['num'],
	'post_type' => $shortcode_args['post_type'],
	'class' => $shortcode_args['class'],
	'post_status' => 'publish',
	//'orderby' => 'title',
	//'order'   => 'ASC',
	);
	
$cat_posts = get_posts($args);
$output = '<div class="row gx-1 gy-3 gx-lg-3 mt-0">';
$classes = $shortcode_args['class'];
foreach ($cat_posts as $post) :
setup_postdata($post);
$url = get_field('url');
$string = __( 'View Products in ', 'wp-bootstrap-4' );
$output .= '<div class="card-item '. $classes .' my-2 d-flex justify-content-center"> <div class="card bg-transparent border-0">';
if($url):
	$output .= '<a rel="" target="_blank" class="d-block" href="'.$url.'" title="'. $string . get_the_title() .'">';
endif; 
$output .= '<div class="img-wrapper img-margin" style="position: relative;">';
	$output .= ''. wp_get_attachment_image( get_post_thumbnail_id(), 'medium' ) .'';
$output .= '</div>';
$output .= '<div class="content"><h3 class="card-title h6">'.get_the_title().'</h3></div>';
if($url):
	$output .= '</a>';
endif;  
$output .= '</div></div>';
endforeach;    

wp_reset_postdata();
$output .= '</div>';
return $output;
}

add_shortcode( 'cards', 'shortcode_display_card');

// Shortcode Display Post types Posts with diferent skins
// Works only in Widgets Blocks!!!
function post_type_posts($attr){
	// Defining Shortcode's Attributes
	ob_start();
	$shortcode_args = shortcode_atts(
	array(
		'category_name'     => '',
		'num'     => '100',
		'post_type' => 'post',
		'post_status' => 'publish'
	), $attr);    
	
	// array with query arguments
	$args = array(
		'category_name' => $shortcode_args['category_name'],
		'posts_per_page' => $shortcode_args['num'],
		'post_type' => $shortcode_args['post_type'],
		'post_status' => 'publish'
	);

	$arr_posts = new WP_Query( $args );
	
	if ( $arr_posts->have_posts() ) : ?>
		<div class="row justify-content-center">
			<?php while ( $arr_posts->have_posts() ) :
				$arr_posts->the_post();
				getPost();
			endwhile; ?>
		</div>
	<?php 
	endif;
	$endClean = ob_get_clean();
	return $endClean;
}

add_shortcode( 'post_type_posts', 'post_type_posts');

// Shortcode Display Related Posts in Post Single. 
function related_posts() {
	$post_id = get_the_ID();
	$cat_ids = array();
	$categories = get_the_category( $post_id );

	if(!empty($categories) && !is_wp_error($categories)):
		foreach ($categories as $category):
			array_push($cat_ids, $category->term_id);
		endforeach;
	endif;

	$current_post_type = get_post_type($post_id);
	$related_count = get_theme_mod( 'related_count', 4 );
	$query_args = array( 
		'category__in'   => $cat_ids,
		'post_type'      => $current_post_type,
		'post__not_in'    => array($post_id),
		'posts_per_page'  => $related_count,
	);

	$related_cats_post = new WP_Query( $query_args );

	if($related_cats_post->have_posts()):
		while($related_cats_post->have_posts()): $related_cats_post->the_post(); 
			getPost();
		endwhile;
		wp_reset_postdata();
	endif;
}
add_shortcode('related_posts','related_posts');

// Get Post Type Items
function getPost() {
	if ( 'team' === get_post_type() ) {
		get_template_part( 'template-parts/shortcodes/shortcode', 'team' );
	} elseif ( 'card' === get_post_type() ) {
		get_template_part( 'template-parts/shortcodes/shortcode', 'card' );
	} else {
		get_template_part( 'template-parts/shortcodes/shortcode', 'post' );
	}
}
// Shortcode Display Related Posts in sidebar
function sidebar_related_posts() {
	ob_start();
    $post_id = get_the_ID();
	$cat_ids = array();
	$categories = get_the_category( $post_id );

	if(!empty($categories) && !is_wp_error($categories)):
		foreach ($categories as $category):
			array_push($cat_ids, $category->term_id);
		endforeach;
	endif;

	$current_post_type = get_post_type($post_id);
	$related_count = get_theme_mod( 'related_count', 4 );
	$query_args = array( 
		'category__in'   => $cat_ids,
		'post_type'      => $current_post_type,
		'post__not_in'    => array($post_id),
		'posts_per_page'  => $related_count,
	);

	$related_cats_post = new WP_Query( $query_args );
	if ( is_singular() ) :
	if($related_cats_post->have_posts()):
	$string = __( 'Related Posts ', 'wp-bootstrap-4' );
   ?>
    <h2 class="heading "><?php echo $string; ?></h2>
	<ul class="sidebar-related-posts px-0 mb-0">
        <?php while($related_cats_post->have_posts()): $related_cats_post->the_post();  
			
	        $size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
		?>
            <li class="d-flex w-100">
                <a class="thumb-link align-self-start mr-2" href="<?php esc_url(the_permalink()); ?>" title="<?php esc_html(the_title()); ?>" <?php if(!is_front_page()):?>style=""<?php endif; ?>>
				<?php  the_post_thumbnail( $size);?>
                </a>
                <h3 class="h6 flex-1">
                    <a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_html(the_title()); ?>">
                        <?php esc_html(the_title()); ?>
                   </a>
                </h3>
            </li>
        <?php endwhile;
    wp_reset_postdata(); ?>
	</ul>
<?php 
	endif;
	endif;
$endClean = ob_get_clean();
return $endClean;
}
add_shortcode('sidebar_related_posts','sidebar_related_posts');

// Shortcode Display Recent Posts in sidebar
function sidebar_recent_posts() {
	ob_start();
    $recent_posts = new WP_Query();
    $recent_posts->query(is_front_page() ? 'showposts=6': 'showposts=5'); 
   ?>
	<ul class="sidebar-latest-posts px-0 mb-0">
        <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); 
			
	        $size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
		?>
            <li class="d-flex">
                <a class="align-self-start mr-2" href="<?php esc_url(the_permalink()); ?>" title="<?php esc_html(the_title()); ?>" <?php if(!is_front_page()):?>style="max-width: 80px;"<?php endif; ?>>
				<?php the_post_thumbnail($size); ?>
                </a>
                <h3 class="h6 flex-1">
                    <a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_html(the_title()); ?>">
                        <?php esc_html(the_title()); ?>
                   </a>
                </h3>
            </li>
        <?php endwhile;
    wp_reset_postdata(); ?>
	</ul>
<?php 
$endClean = ob_get_clean();
return $endClean;
}
add_shortcode('recent_posts','sidebar_recent_posts');

// Remove comments page in menu
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
});

function image_constructor($size, $category, $main_image, $secondary_image) {
    $default_value = 25800000000;
    $main_image_construct = '';
    $secondary_image_construct = '';

    // Handle the main category image
    if (is_numeric($main_image) && $main_image != $default_value) {
        // If it's an ID, use wp_get_attachment_image
        $main_image_construct = wp_get_attachment_image($main_image, $size, false, array('alt' => $category->name, 'class' => 'subcat_main_img id_img'));
    } elseif (is_array($main_image) && isset($main_image['sizes'][$size])) {
        // If it's an array, use the selected size if available
        $main_image_url = $main_image['sizes'][$size];
        $main_image_width = $main_image['sizes'][$size . '-width'];
        $main_image_height = $main_image['sizes'][$size . '-height'];
        $main_image_construct = '<img class="subcat_main_img array_img" src="' . esc_url($main_image_url) . '" width="' . esc_attr($main_image_width) . '" height="' . esc_attr($main_image_height) . '" alt="' . esc_attr($category->name) . '" />';
    } elseif (!is_numeric($main_image) && !empty($main_image)) {
        // If it's a URL (not an ID or array)
        $main_image_construct = '<img class="subcat_main_img url_img" src="' . esc_url($main_image) . '" alt="' . esc_attr($category->name) . '" />';
    }

    // Handle the secondary category image
    if (is_numeric($secondary_image) && $secondary_image != $default_value) {
        // If it's an ID, use wp_get_attachment_image
        $secondary_image_construct = wp_get_attachment_image($secondary_image, $size, false, array('alt' => $category->name, 'class' => 'cat_secondary_img id_img'));
    } elseif (is_array($secondary_image) && isset($secondary_image['sizes'][$size])) {
        // If it's an array, use the selected size if available
        $secondary_image_url = $secondary_image['sizes'][$size];
        $secondary_image_width = $secondary_image['sizes'][$size . '-width'];
        $secondary_image_height = $secondary_image['sizes'][$size . '-height'];
        $secondary_image_construct = '<img class="cat_secondary_img array_img" src="' . esc_url($secondary_image_url) . '" width="' . esc_attr($secondary_image_width) . '" height="' . esc_attr($secondary_image_height) . '" alt="' . esc_attr($category->name) . '" />';
    } elseif (!is_numeric($secondary_image) && !empty($secondary_image)) {
        // If it's a URL (not an ID or array)
        $secondary_image_construct = '<img class="cat_secondary_img url_img" src="' . esc_url($secondary_image) . '" alt="' . esc_attr($category->name) . '" />';
    }

    // Return constructed images
    return array($main_image_construct, $secondary_image_construct);
}



// Shortcode to display subcategories of the parent category as banners
function subcategories($attr) {
    ob_start();
    $shortcode_args = shortcode_atts(
        array(
            'child_of' => '', // Parent category ID
        ), 
        $attr
    );
    $args = array('child_of' => $shortcode_args['child_of']);
    $categories = get_categories($args);
    ?>
    <div class="row gx-1">
    <?php 
    foreach ($categories as $category) { 
        $size = 'medium';
		$brand_color = get_field( 'brand_color', $category->taxonomy . '_' . $category->term_id );
        $main_image = get_field('main_image', $category->taxonomy . '_' . $category->term_id);
        $secondary_image = get_field('secondary_image', $category->taxonomy . '_' . $category->term_id);
        // Get the constructed images from the helper function
        list($main_image_construct, $secondary_image_construct) = image_constructor($size, $category, $main_image, $secondary_image);
        ?>
        <div class="category-banner d-flex flex-wrap justify-content-center col-6 col-md-6 col-lg-4 col-xl-3 bg-dark mt-2">
            <a href="<?php echo get_category_link($category->term_id); ?>" title="<?php echo sprintf(__('View all posts in %s'), $category->name); ?>" style="background-color: <?php echo esc_attr( $brand_color ? $brand_color : 'var(--dark)' ); ?>;">
                <?php 
                if (!empty($secondary_image_construct)) {
                    // Output secondary category image if it exists
                    echo $secondary_image_construct;
                } elseif (!empty($main_image_construct)) {
                    // Otherwise, output the main category image
                    echo $main_image_construct;
                }
                ?>
            </a>
            <h3 class="as_banner-content entry-title card-title text-white"><?php echo $category->name; ?></h3>
        </div>
        <?php
    }
    ?>
    </div>
    <?php 
    return ob_get_clean();
}
add_shortcode('subcategories', 'subcategories');

// Show only parent categories as shortcode 
function parent_category_list(){
	ob_start();
	$categories = get_categories( array(
		'orderby' => 'name',
		'parent'  => 0,
		'hide_empty' => 1
	) ); ?>
    <div class="row gx-1">
	<?php foreach ( $categories as $category ) {
		$size = 'medium';
		$brand_color = get_field( 'brand_color', $category->taxonomy . '_' . $category->term_id );
        $main_image = get_field('main_image', $category->taxonomy . '_' . $category->term_id);
        $secondary_image = get_field('secondary_image', $category->taxonomy . '_' . $category->term_id);
        // Get the constructed images from the helper function
        list($main_image_construct, $secondary_image_construct) = image_constructor($size, $category, $main_image, $secondary_image);
		?>
        <div class="category-banner d-flex flex-wrap justify-content-center col-6 col-md-6 col-lg-4 col-xl-3 bg-dark mt-2">
            <a href="<?php echo get_category_link($category->term_id); ?>" title="<?php echo sprintf(__('View all posts in %s'), $category->name); ?>" style="background-color: <?php echo esc_attr( $brand_color ? $brand_color : 'var(--dark)' ); ?>;">
            <?php 
                if (!empty($secondary_image_construct)) {
                    // Output secondary category image if it exists
                    echo $secondary_image_construct;
                } elseif (!empty($main_image_construct)) {
                    // Otherwise, output the main category image
                    echo $main_image_construct;
                }
            ?>
            </a>
            <h3 class="as_banner-content entry-title card-title text-white"><?php echo $category->name; ?></h3>
        </div>
        <?php
	} ?>
	</div>
	<?php $endClean = ob_get_clean();
    return $endClean;
}

add_shortcode('parent_category_list', 'parent_category_list');

// Shortcode to display tag list with tag images
function parent_tag_list($attr) {
	ob_start();
	// Define the default shortcode attributes
    $shortcode_args = shortcode_atts(
        array(
            'tag' => '', // Default is empty, meaning show all tags
        ), $attr
    );
	$tags = get_tags(array(
		'orderby' => 'name',
		'hide_empty' => 1
	));
	
	$args = array(); // Initialize $args to avoid warning
    // If 'tag' attribute is not empty, filter by tag slugs
    if (!empty($shortcode_args['tag'])) {
        $args['slug'] = explode(',', $shortcode_args['tag']); // Filter tags by slugs
    }
	$tags = get_tags($args);
	if ($tags) { 
	?>
	<div class="row gx-1">
	<?php 
	foreach ($tags as $tag) {
		$size = 'medium';
		// Get custom fields for tag images
		$brand_color = get_field( 'brand_color', 'post_tag_' . $tag->term_id);
		$tag_image = get_field('main_image', 'post_tag_' . $tag->term_id);
		$secondary_tag_image = get_field('secondary_image', 'post_tag_' . $tag->term_id);

		// Get the constructed images from the helper function
		list($tag_image_construct, $secondary_tag_image_construct) = image_constructor($size, $tag, $tag_image, $secondary_tag_image);
		?>
		<div class="tag-banner d-flex flex-wrap justify-content-center col-6 col-md-6 col-lg-4 col-xl-3 bg-dark mt-2" >
			<a href="<?php echo get_tag_link($tag->term_id); ?>" title="<?php echo sprintf(__('View all posts in %s'), $tag->name); ?>" style="background-color: <?php echo esc_attr( $brand_color ? $brand_color : 'var(--dark)' ); ?>;">
			<?php 
			// Display secondary image if it exists
			if (!empty($secondary_tag_image_construct)) {
				echo $secondary_tag_image_construct;
			} elseif (!empty($tag_image_construct)) {
				echo $tag_image_construct;
			}
			?>
			</a>
			<h3 class="as_banner-content entry-title card-title text-white"><?php echo $tag->name; ?></h3>
		</div>
		<?php
	} ?>
	</div>
	<?php

	$endClean = ob_get_clean();
	return $endClean;
		
	} else {
        echo '<p>No tags found.</p>';
    }
}

add_shortcode('parent_tag_list', 'parent_tag_list');


function getTagList() {
  ob_start();
  $args = array(
	'taxonomy' => array( 'post_tag' ), 
   ); 
   wp_tag_cloud( $args );
   $endClean = ob_get_clean();
   return $endClean;
}

add_shortcode('tagsList', 'getTagList');


// Not used in Theme: Categories with posts count
function categories() {
	ob_start();
	$args = array(
	  'parent' => 0,
	  'hide_empty' => 1
	);
	 $categories = get_categories($args); ?>
    <ul class="w-100 px-0 m-0" style="list-style: none;">
    <?php foreach ( $categories as $category ) : $category_link = get_category_link( $category->term_id ); ?>
	<li>
        <a href='<?php echo $category_link; ?>' title='<?php echo $category->name; ?>' class='<?php echo $category->slug ?> w-100 d-flex b-700'><?php echo $category->name ?> <span class="d-inline-block ml-auto">(<?php echo $category->count ?>)</span></a>
    </li>
	<?php endforeach; ?>		
    </ul>
<?php $endClean = ob_get_clean();
return $endClean;
	
}
add_shortcode('categories','categories');

// Not used in Theme
function sub_category_list(){
  if(is_category()) {
    $breakpoint = 0;
    $thiscat = get_term( get_query_var('cat') , 'category' );
    $subcategories = get_terms( 'category' , 'parent='.get_query_var('cat') );
    if(empty($subcategories) && $thiscat->parent != 0) {
        $subcategories = get_terms( 'category' , 'parent='.$thiscat->parent.'' );
    }
    $items='';
    if(!empty($subcategories)) {
        foreach($subcategories as $subcat) {
            if($thiscat->term_id == $subcat->term_id) $current = ' current-cat'; else $current = '';
            $items .= '
            <li class="cat-item cat-item-'.$subcat->term_id.$current.'">
                <a href="'.get_category_link( $subcat->term_id ).'" title="'.$subcat->description.'">'.$subcat->name.'</a>
            </li>';
        }
        echo "<ul style='padding: 0;list-style: none;'>$items</ul>";
    }
    unset($subcategories,$subcat,$thiscat,$items);
  }
}

add_shortcode('showsubcat', 'sub_category_list');


// Shortcode Display Video Posts
function shortcode_display_videos($attr, $content = null){
global $post;
// Defining Shortcode's Attributes
$shortcode_args = shortcode_atts(
		array(
			'category_name' => '',
			'num'     => '100',
			'post_type' => 'video',
			'post_status' => 'publish'
			), $attr);    
	
// array with query arguments
$args = array(
			'category_name' => $shortcode_args['category_name'],
			'posts_per_page' => $shortcode_args['num'],
			'post_type' => $shortcode_args['post_type'],
			'post_status' => 'publish'
		);
$cat_posts = get_posts($args);
$string = __( 'Watch Video:', 'wp-bootstrap-4' );
$prev = __( 'Previous Video', 'wp-bootstrap-4' );
$next = __( 'Next Video', 'wp-bootstrap-4' );
$i = 0;
if (is_front_page()):
	$carousel_item = 'carousel-item';
	$carousel_item_counter = 'col-12 carousel-item-'.$i;
else:
	$carousel_item = 'col-12 col-md-6 d-flex my-3';
	$carousel_item_counter = '';
endif;
$output = '<div class="row">';
if (is_front_page()):
	 $output .= '<div id="video_slider" class="carousel slide w-100" data-ride="carousel" data-interval="5000" data-touch="true">';
	 $output .= '<div class="carousel-inner" role="listbox" aria-labelledby="video_slider"></div>';
endif;
foreach ($cat_posts as $post) :
if (is_front_page() && $i == 0):
	$active = 'active';
else:
	$active = '';
endif;
setup_postdata($post);
	$video_thumb = get_field('video_thumb');
	$size = 'medium';
	$video_url = get_field('video_url');
	if($video_url): 
	 $video_slug = $video_url;
	else:
	 $video_slug = '#';
	endif;
	$output .= '<div class="video-item '.$active.' '.$carousel_item.' '.$carousel_item_counter.'"> <div class="card w-100">';
	if($video_url):
	$output .= '<a class="card-header card-header-archive-video p-0 border-0" href="'.$video_url.'" title="'.$string.' '.get_the_title().'">'; 
	endif;
	if($video_thumb):
	$output .= ''. wp_get_attachment_image($video_thumb, $size, false, array('alt' => get_the_title(), 'class' => 'video_img acf-video_img')) .'';
	$output .= '<img class="play-icon" width="64" height="46" src="'. get_template_directory_uri() .'/assets/images/playicon.svg" alt="play icon"/>';
	endif;
	if($video_url):
	$output .= '</a>';
	endif;
	$output .= '<div class="d-none card-body x-d-flex flex-column">';
	$output .='<h2 class="video-title entry-title card-title mb-0"><a class="" href="'.get_permalink().'" title="'.$string.' '.get_the_title().'">'.get_the_title().'</a></h2>';
	$output .= '</div></div></div>';
$i++;	
endforeach;    
wp_reset_postdata();
if (is_front_page()):
	$output .= '<a class="carousel-control-prev" href="#video_slider" data-slide="prev" title="'. $prev .'"><span class="carousel-control-prev-icon"></span></a>';
    $output .= '<a class="carousel-control-next" href="#video_slider" data-slide="next" title="'. $next .'"><span class="carousel-control-next-icon"></span></a>';
	$output .= '</div>';
	$output .= '</div>';
endif;
$output .= '</div>';
return $output;
}
add_shortcode( 'videos', 'shortcode_display_videos');

function author_info(){
	if (is_author()):
	$user_ID = get_the_author_meta( 'ID' );
    $user = 'user_' . $user_ID;
    $user_name = wp_kses( get_the_author_meta( 'display_name' ), null );
	$user_description = wp_kses( get_the_author_meta( 'description' ), null );
	$user_picture = get_field('user_picture', $user);
    ob_start();
	    $output = '';
	    $output .= '<div class="d-flex flex-column flex-md-row flex-wrap align-items-md-center">';
	    $output .= '<h1 class="w-100 mt-3">'. $user_name .'</h1>';
		if ($user_picture) : 
			$output .= '<div class="user-img-wrapper"><img width="80" height="80" class="user_img" src="'. $user_picture .'" alt="'. $user_name .'"/></div>';
		endif;
		if ($user_description) : 
			$output .= '<div class="user-description flex-1 mt-3 mt-md-0 ml-md-3">'. $user_description .'</div>';
		endif;
	$output .= '</div>';
	ob_get_clean();
	return $output;
	endif;
}
add_shortcode( 'author_info', 'author_info');

// Author info in single post content
function author_info_single_content($content) {
	if ( is_single() ) { 
	    $user_ID = get_the_author_meta( 'ID' );
		$user = 'user_' . $user_ID;
		$user_name = wp_kses( get_the_author_meta( 'display_name' ), null );
		$user_url = wp_kses( get_author_posts_url( $user_ID), null );
		$user_description = wp_kses( get_the_author_meta( 'description' ), null );
		$user_picture = get_field('user_picture', $user);
		ob_start();
			$content .= '';
			$content .= '<div class="single-user-card card flex-md-row flex-wrap rounded p-3 mb-4 bg-transparent">';
			if ($user_picture) : 
				$content .= '<div class="user-img-wrapper"><a class="user-link" href="'.$user_url.'" title="'. $user_name .'"><img width="80" height="80" class="user_img" src="'. $user_picture .'" alt="'. $user_name .'" title="'. $user_name .'"/></a></div>';
			endif;
			$content .= '<div class="user-description flex-1 align-self-center mt-3 mt-md-0 ml-md-3">';
				$content .= '<a class="user-link" href="'.$user_url.'" title="'. $user_name .'"><h4 class="h5 w-100">'. $user_name .'</h4></a>';
				if ($user_description) : 
					$content .= '<p class="mb-0">'. $user_description .'</p>';
				endif;
			$content .= '</div>';
		$content .= '</div>';
		ob_get_clean();
	}
	return $content;
}
add_filter('the_content', 'author_info_single_content');

function is_webp_express_active() {
    // Check if the function is available (it won't be if not in admin context)
    if ( ! function_exists( 'is_plugin_active' ) ) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }

    // Define the plugin path relative to the plugins directory
    $plugin_path = 'webp-express/webp-express.php';

    // Check if WebP Express is active
    if ( is_plugin_active( $plugin_path ) ) {
        return true;
    }

    // Check if WebP Express is active on the network (for multisite)
    if ( is_multisite() && is_plugin_active_for_network( $plugin_path ) ) {
        return true;
    }

    return false;
}

/** Preload attachment image, defaults to post thumbnail */
function get_webp_url_if_available_own($url){
	if ( is_singular() ) {
		$webp_url = $url;
		//var_dump($url);
		if (str_contains($url, '.webp')) {
			$webp_url_folder = str_replace("", "", $webp_url);
		} else {
			if ( is_webp_express_active() ) {
               $webp_url_folder = str_replace("/uploads/", "/webp-express/webp-images/uploads/", $webp_url);
			} else {
				$webp_url_folder = str_replace("", "", $webp_url);
			}
		}
		
		if ($webp_url_folder) {
		$url = $webp_url_folder;
		}
		return $url;
   }
}

function preload_post_thumbnail() {
    global $post;
    /** Prevent preloading for specific content types or post types */
    if ( ! is_singular() ) {
        return;
    }
    /** Adjust image size based on post type or other factor. */
    $image_size = 'full';

    if ( is_singular( 'product' ) ) {
        $image_size = 'woocommerce_single';

    } else if ( is_singular( 'post' ) ) {
        $image_size = 'full';

    }
    $image_size = apply_filters( 'preload_post_thumbnail_image_size', $image_size, $post );
    /** Get post thumbnail if an attachment ID isn't specified. */
    $thumbnail_id = apply_filters( 'preload_post_thumbnail_id', get_post_thumbnail_id( $post->ID ), $post );

    /** Get the image */
    $image = wp_get_attachment_image_src( $thumbnail_id, $image_size );
    $src = '';
    $additional_attr_array = array();
    $additional_attr = '';

    if ( $image ) {
        list( $src, $width, $height ) = $image;

        /**
         * The following code which generates the srcset is plucked straight
         * out of wp_get_attachment_image() for consistency as it's important
         * that the output matches otherwise the preloading could become ineffective.
         */

        $image_meta = wp_get_attachment_metadata( $thumbnail_id );

        if ( is_array( $image_meta ) ) {
            $size_array = array( absint( $width ), absint( $height ) );
            $srcset     = wp_calculate_image_srcset( $size_array, $src, $image_meta, $thumbnail_id );
			if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {
			// webp is supported!
			$src = get_webp_url_if_available_own($src);
			$src_split = explode(", ", $srcset);

			foreach ($src_split as $key => $src_single) {
			$src_single_split = explode(" ", $src_single);
			$single_img = $src_single_split[0];
			$single_img = get_webp_url_if_available_own($single_img);
			$src_single_split[0] = $single_img;
			$src_split[$key] = implode(" ", $src_single_split);
			}

			$srcset = implode(", ", $src_split);
			}
			
            $sizes      = wp_calculate_image_sizes( $size_array, $src, $image_meta, $thumbnail_id );

            if ( $srcset && ( $sizes || ! empty( $attr['sizes'] ) ) ) {
                $additional_attr_array['imagesrcset'] = $srcset;

                if ( empty( $attr['sizes'] ) ) {
                    $additional_attr_array['imagesizes'] = $sizes;
                }
            }
        }

        foreach ( $additional_attr_array as $name => $value ) {
            $additional_attr .= "$name=" . '"' . $value . '" ';
        }

    } else {
        /** Early exit if no image is found. */
        return;
    }

   /** Output the link HTML tag */
   if ( is_webp_express_active() ) {
	// var_dump($src);
	if (str_contains($src, '.webp')) {
		  $srcw = str_replace( '.jpg.webp','.jpg.webp', $src );
	      $additional_attrw = str_replace( '.jpg.webp','.jpg.webp', $additional_attr );
	} elseif (str_contains($src, '.png')) {
		$srcw = str_replace( '.png','.png.webp', $src );
	    $additional_attrw = str_replace( '.png','.png.webp', $additional_attr );
	}
	else {
		$srcw = str_replace( '.jpg','.jpg.webp', $src );
	    $additional_attrw = str_replace( '.jpg','.jpg.webp', $additional_attr );
	}

	printf( '<link fetchpriority="high" rel="preload" as="image" href="%s" %s/>', esc_url( $srcw ), $additional_attrw );
	} else { printf( '<link fetchpriority="high" rel="preload" as="image" href="%s" %s/>', esc_url( $src ), $additional_attr ); 
	}
	
}
add_action( 'wp_head', 'preload_post_thumbnail', 1 );


// Shortcode Display Product Static Catalog
function product_catalog() {
	ob_start();
	get_template_part( 'template-parts/product-catalog/catalog', 'main' );
	$endClean = ob_get_clean();
return $endClean;
}
add_shortcode('product_catalog','product_catalog');
// End Shortcode Display Product Static Catalog


