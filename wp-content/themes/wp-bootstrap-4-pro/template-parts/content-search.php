<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */

$image = get_field('feature_img');
$size = 'medium';
$blog_grid_link_text = esc_html__( 'Continue Reading', 'wp-bootstrap-4' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card w-100' ); ?>>
	<?php if ( !is_singular() ) : $size = 'medium';?>
		<?php wp_bootstrap_4_acf_post_grid_thumbnail($image, $size, $blog_grid_link_text); ?>
	<?php endif; ?>
	<div class="card-body w-100 d-flex flex-column align-items-center">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title card-title"><a href="%s" rel="bookmark" title="'. wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ).' '. get_the_title() .'">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta d-none">
				<?php wp_bootstrap_4_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-summary d-flex flex-column align-items-start w-100 h-100">
			<?php if ( get_theme_mod( 'show_excerpt', 'yes' ) === 'yes' ) {the_excerpt(); }?>
			<?php echo wp_bootstrap_4_posts_link(); ?>
		</div><!-- .entry-summary -->
	</div>
	<!-- /.card-body -->

	<?php if ( 'post' === get_post_type() || 'service' === get_post_type() ) : ?>
		<footer class="entry-footer card-footer">
			<?php wp_bootstrap_4_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
