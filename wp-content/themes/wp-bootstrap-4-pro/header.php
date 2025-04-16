<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_4
 */


$header_style = get_field('header_style', 'option');
$page_bgr_image = '';
$page_bgr_color = '';
$custom_page_color = '';
$show_hide_header = true;
if( have_rows( 'page_settings' ) ) :
    while ( have_rows('page_settings')) : the_row();
        $page_bgr_image = get_sub_field( 'page_background_image');
        $page_bgr_color = get_sub_field('page_background_color');
        $show_hide_header = get_sub_field('show_hide_header');
        if ($page_bgr_color && !is_404()) {
			$custom_page_color = 'custom-page-color';
		}
    endwhile;
endif;
$double_image =  get_field('double_image','options');
$loading = 'loading';
if($double_image == true) { 
	$loading = 'loading';
}
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<?php $custom_css = get_field('custom_css'); if( !empty($custom_css) ){?><style id="inline-page-styles-<?php the_ID(); ?>"><?php echo $custom_css; ?></style><?php }?>
	<script>document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");</script>
</head>

<body <?php body_class(array( $loading, $custom_page_color )); ?> id="pageTop" <?php if ( get_theme_mod( 'scrollspy', 0 ) ) : ?> data-spy="scroll" data-target="#site-navigation" data-offset="<?php echo get_theme_mod( 'data_offset', 0 ); ?>"<?php endif; ?> style="<?php if ($page_bgr_color && !is_404()): ?>background-color: <?php echo $page_bgr_color;?>;<?php endif; ?>">
	<?php echo get_field('insert_body', 'options'); ?>
	<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-4' ); ?></a>
    <?php 
	if( $show_hide_header) {
		if( $header_style == 'style_one' ) {
			get_template_part( 'template-parts/headers/skin-1' );
		} else if ( $header_style == 'style_two' ){
			get_template_part( 'template-parts/headers/skin-2' );
		} else {
			get_template_part( 'template-parts/headers/default' );
		}
	}
	?>
	<div id="content" class="site-content" style="<?php if ($page_bgr_image && !is_404()) : ?>background-image: url('<?php echo esc_url($page_bgr_image); ?>');<?php endif; ?>">
    <section class="dropdown-search" style="display: none;" aria-labelledby="dropdownSearch">
		<div class="container py-4">
			<?php 
			$string_search_placeholder = __( 'Search in Blog', 'wp-bootstrap-4' ); 
			$string_search_button = __( 'Search', 'wp-bootstrap-4' ); 
			?>
			<form class="d-flex align-items-center" action="<?php echo home_url( '/' ); ?>" method="get">
				<label for="search" class="d-none">Search in <?php echo home_url( '/' ); ?></label>
				<input class="" type="text" name="s" id="search" placeholder="<?php echo $string_search_placeholder; ?>" value="<?php the_search_query(); ?>" />

				<button type="submit" class="btn btn-primary border-0 ml-3">
					<?php echo $string_search_button; ?>
				</button>
			</form>
		</div>
	</section>