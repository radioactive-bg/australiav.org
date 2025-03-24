<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package WP_Bootstrap_4
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */



function wp_bootstrap_4_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'wp_bootstrap_4_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function wp_bootstrap_4_woocommerce_scripts() {
	wp_enqueue_style( 'wp-bootstrap-4-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'wp-bootstrap-4-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_4_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function wp_bootstrap_4_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'wp_bootstrap_4_woocommerce_active_body_class' );

/**
* Change <ul> Wrapper Classes
*
* @param  array $classes CSS classes applied to the <ul> tag.
* @return array $classes modified to include 'row custom-products' classes.
*/

function custom_woocommerce_product_loop_start( $classes ) {
    // Define your custom classes
    $custom_classes = 'row custom-products';

    // Replace the existing classes with your custom classes
    $classes = str_replace('products', $custom_classes, $classes);
	
    // Remove any class that starts with 'columns-'
    $classes = preg_replace( '/columns-\d+/', '', $classes );
    
    // Optional: Remove any extra spaces that might have been left after removing the class
    $classes = trim( preg_replace( '/\s+/', ' ', $classes ) );
	
    return $classes;
}
add_filter( 'woocommerce_product_loop_start', 'custom_woocommerce_product_loop_start', 10, 1 );

/**
 * Product archive and related columns.
 *
 * @return string of bootstrap classes for columns.
 */

function wp_bootstrap_4_woocommerce_bootstrap_columns() {
	$column_count = get_theme_mod( 'grid_product_count', 'col-md-6 col-lg-4 col-xl-3');
	return  $column_count ;
}

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function wp_bootstrap_4_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'wp_bootstrap_4_woocommerce_thumbnail_columns' );

/**
* Default loop columns on product archives.
*
* @return integer products per row.
*/

// Function to set the number of columns on WooCommerce archive pages
function wp_bootstrap_4_woocommerce_archive_product_columns() {
    if ( ! is_singular( 'product' ) ) { // Check if not a single product page
        $args = array(
            'posts_per_page'   => 12, // Number of products per page
            'columns'          => 4,  // Number of columns, , Not used!!!
            'bootstrap_classes' => wp_bootstrap_4_woocommerce_bootstrap_columns(), // Bootstrap column classes
        );

        return $args['columns']; // Return the number of columns to WooCommerce
    }
}
add_filter( 'loop_shop_columns', 'wp_bootstrap_4_woocommerce_archive_product_columns' );

// Function to set the number of products per page on WooCommerce archive pages
function wp_bootstrap_4_woocommerce_archive_product_per_page( $cols ) {
    if ( ! is_singular( 'product' ) ) { // Check if not a single product page
        return 12;
    }
}
add_filter( 'loop_shop_per_page', 'wp_bootstrap_4_woocommerce_archive_product_per_page' );

// Function to apply Bootstrap classes to the product grid on WooCommerce archive pages
function wp_bootstrap_4_woocommerce_archive_product_bootstrap_classes( $classes, $class, $product_id ) {
     if ( is_shop() || is_product_category() || is_product_tag() ) { // Check if not a single product page
        $classes[] = wp_bootstrap_4_woocommerce_bootstrap_columns(); // Add Bootstrap classes
    }
    return $classes;
}
add_filter( 'post_class', 'wp_bootstrap_4_woocommerce_archive_product_bootstrap_classes', 10, 3 );


/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
// These arguments are stopped and hardcoded setted in custom related skin!!!
function wp_bootstrap_4_woocommerce_related_products_args( $args ) {
    // Define the default arguments, including bootstrap classes
    $defaults = array(
        'posts_per_page'    => 4,                                // Number of related products to show
        'columns'           => 4,                                // Number of columns, Not used!!!
        'bootstrap_classes' => wp_bootstrap_4_woocommerce_bootstrap_columns(),     // Bootstrap column classes
    );

    // Merge the defaults with the provided arguments
    $args = wp_parse_args( $args, $defaults );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'wp_bootstrap_4_woocommerce_related_products_args' );


if ( ! function_exists( 'wp_bootstrap_4_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function wp_bootstrap_4_woocommerce_product_columns_wrapper() {
		//$columns = wp_bootstrap_4_woocommerce_loop_columns();
		//echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'wp_bootstrap_4_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'wp_bootstrap_4_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function wp_bootstrap_4_woocommerce_product_columns_wrapper_close() {
		//echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'wp_bootstrap_4_woocommerce_product_columns_wrapper_close', 40 );


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'wp_bootstrap_4_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function wp_bootstrap_4_woocommerce_wrapper_before() {
		?>
		<div class="container">
			<div class="row">
				<?php if ( get_theme_mod( 'default_sidebar_position', 'right' ) === 'no' ) : ?>
					<div class="col-lg-12 content-width">
				<?php else : ?>
					<div class="col-lg-8 content-width">
				<?php endif; ?>
						<div id="primary" class="content-area">
							<main id="main" class="site-main" role="main">
								<div class="section-product-gutter">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'wp_bootstrap_4_woocommerce_wrapper_before' );

if ( ! function_exists( 'wp_bootstrap_4_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function wp_bootstrap_4_woocommerce_wrapper_after() {
		?>
								</div>
							</main><!-- #main -->
						</div><!-- #primary -->
					</div>
					<!-- /.col-lg-8 -->

					<?php if ( get_theme_mod( 'default_sidebar_position', 'right' ) != 'no' ) : ?>
						<?php if ( get_theme_mod( 'default_sidebar_position', 'right' ) === 'right' ) : ?>
							<div class="col-lg-4 sidebar-width">
						<?php elseif ( get_theme_mod( 'default_sidebar_position', 'right' ) === 'left' ) : ?>
							<div class="col-lg-4 order-lg-first sidebar-width">
						<?php endif; ?>
								<?php get_sidebar( 'shop' ); ?>
							</div>
							<!-- /.col-lg-4 -->
					<?php endif; ?>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'wp_bootstrap_4_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'wp_bootstrap_4_woocommerce_header_cart' ) ) {
			wp_bootstrap_4_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'wp_bootstrap_4_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function wp_bootstrap_4_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		wp_bootstrap_4_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wp_bootstrap_4_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'wp_bootstrap_4_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function wp_bootstrap_4_woocommerce_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'wp-bootstrap-4' ); ?>">
				<?php /* translators: number of items in the mini cart. */ ?>
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'wp-bootstrap-4' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'wp_bootstrap_4_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function wp_bootstrap_4_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<img width="20" height="20" class="cart-icon" src="<?php echo site_url(); ?>/wp-content/themes/wp-bootstrap-4-pro/assets/images/bootstrap-icons/minecart.svg" alt="cart" style="width: 20px;">
				<?php wp_bootstrap_4_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
					$instance = array(
						'title' => '',
					);

					the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}


// Add before / after for results & sort
add_action( 'woocommerce_before_shop_loop', 'wp_bootstrap_4_woocommerce_before_sort_result', 19 );
add_action( 'woocommerce_before_shop_loop', 'wp_bootstrap_4_woocommerce_after_sort_result', 31 );
if ( ! function_exists( 'wp_bootstrap_4_woocommerce_before_sort_result' ) ) {
	function wp_bootstrap_4_woocommerce_before_sort_result() {
		?>
		<div class="d-flex justify-content-between align-items-center mb-4">
		<?php
	}
}
if ( ! function_exists( 'wp_bootstrap_4_woocommerce_after_sort_result' ) ) {
	function wp_bootstrap_4_woocommerce_after_sort_result() {
		?>
		</div>
		<?php
	}
}

add_action( 'woocommerce_after_shop_loop_item', 'wp_bootstrap_4_woocommerce_after_shop_loop_item', 6 );
if ( ! function_exists( 'wp_bootstrap_4_woocommerce_after_shop_loop_item' ) ) {
	function wp_bootstrap_4_woocommerce_after_shop_loop_item() {
		?>
		<br>
		<?php
	}
}

add_action( 'woocommerce_before_single_product_summary', 'wp_bootstrap_4_before_image_gallery', 19 );
if ( ! function_exists( 'wp_bootstrap_4_before_image_gallery' ) ) {
	function wp_bootstrap_4_before_image_gallery() {
		?>
		<div class="row">
		<?php
	}
}

add_action( 'woocommerce_before_single_product_summary', 'wp_bootstrap_4_before_product_summary', 21 );
if ( ! function_exists( 'wp_bootstrap_4_before_product_summary' ) ) {
	function wp_bootstrap_4_before_product_summary() {
		?>
		<div class="col-lg-7">
		<?php
	}
}

add_action( 'woocommerce_after_single_product_summary', 'wp_bootstrap_4_after_product_summary', 1 );
if ( ! function_exists( 'wp_bootstrap_4_after_product_summary' ) ) {
	function wp_bootstrap_4_after_product_summary() {
		?>
			</div><!-- /.col-lg-7 -->
		</div><!-- /.row -->
		<?php
	}
}

add_filter( 'woocommerce_single_product_image_gallery_classes', 'wp_bootstrap_4_add_product_gallery_class' );
if ( ! function_exists( 'wp_bootstrap_4_add_product_gallery_class' ) ) {
	function wp_bootstrap_4_add_product_gallery_class( $classes ) {
		$classes[] = 'col-lg-5';
		return $classes;
	}
}
