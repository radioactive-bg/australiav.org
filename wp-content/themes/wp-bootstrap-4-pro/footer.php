<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_4
 */
$footer_style = get_field('footer_style', 'option');
?>
	</div><!-- #content -->
	<?php 
	if( $footer_style == 'style_one' ) {
		get_template_part( 'template-parts/footers/skin-1' );
	} else {
		get_template_part( 'template-parts/footers/default' );
	}
	?>
</div><!-- #page -->

<?php if ( get_theme_mod( 'on_top', 0 ) ): ?>
	<a href="#pageTop" class="btn btn-primary nav-link p-0" id="onTop" title="on top">
		<img width="20" height="20" src="<?php echo get_template_directory_uri(); ?>/assets/images/bootstrap-icons/chevron-up-white.svg" alt="icon top"/>
	</a>
<?php endif; ?>

<?php 
if( function_exists('acf_global_modal')) { 
   acf_global_modal();
}

wp_footer(); 

echo get_field('insert_footer', 'options'); 

$custom_scripts = get_field('custom_scripts'); if( !empty($custom_scripts) ){echo $custom_scripts; };
?>

</body>
</html>
