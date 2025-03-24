<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_4
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	// return;
}
?>

<aside id="secondary" class="widget-area sidebar-area card mt-5 mt-lg-0">
	<div class="card-body">
	<?php 

	if ( function_exists('acf_category_banner_global') ) {
		// echo acf_category_banner_global();
	}
	if ( function_exists('acf_global_banner') ) {
		// echo acf_global_banner();
	}
	if ( get_theme_mod( 'blog_display_related_posts', 1 ) && get_theme_mod( 'position_related_posts', 'content' ) === 'sidebar') {
		if ( function_exists('sidebar_related_posts') ) {
			echo sidebar_related_posts();
		}
	}

	dynamic_sidebar( 'sidebar-1' ); 
	
	?>
	</div>

</aside><!-- #secondary -->
