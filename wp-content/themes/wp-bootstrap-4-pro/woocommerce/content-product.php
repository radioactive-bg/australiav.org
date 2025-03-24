<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<li <?php wc_product_class( 'custom-product d-flex flex-column mt-4 mt-lg-5', $product ); ?>>
	<div class="product-header-wrapper">
		<a class="product-img-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php echo woocommerce_get_product_thumbnail(); ?>
		</a>
		<div class="product-button-holder text-center">
			<?php woocommerce_template_loop_add_to_cart(); ?>
		</div>
	</div>
	<!-- Custom Product Details -->
	<div class="product-details text-center">
		<!-- Product Title -->
		<h3 class="product-title h5 text-dark mt-3" title="<?php the_title(); ?>">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<!-- Product Price -->
		<span class="price"><?php echo $product->get_price_html(); ?></span>
	</div>
</li>
