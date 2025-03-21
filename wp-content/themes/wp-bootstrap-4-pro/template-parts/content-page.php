<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */
$card = '';
 if ( ! get_theme_mod( 'full_page_header', 1 ) ) {
	$card = 'card';
 }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $card ); ?>> 
	<div class="<?php echo ( ! get_theme_mod( 'full_page_header', 1 ) ) ? 'card-body d-flex flex-column py-5' : '' ; ?>">
		<?php if ( ! get_theme_mod( 'full_page_header', 1 ) ) : ?>
			<header class="entry-header mb-3">
				<?php the_title( '<h1 class="entry-title heading h2">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php wp_bootstrap_4_post_thumbnail($image = null); ?>
		<?php endif; ?>
		<div class="entry-content <?php echo ( ! get_theme_mod( 'full_page_header', 1 ) ) ? 'mt-5' : '' ; ?>">
			<?php
				the_content();
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-4' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
	<!-- /.card-body -->
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer text-muted">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-bootstrap-4' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
