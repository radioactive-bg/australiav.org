<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */
// Lazyload images: Not Used!!!
$lazyload =  get_field('lazyload','options'); 
$lazy = '';
$src_source = 'src';
if($lazyload == true) {
    $lazy = 'lazy';
    $src_source = 'data-src';
}
// End Lazyload images
$image = get_field('feature_img');
$blog_grid_link_text = esc_html__( 'Continue Reading', 'wp-bootstrap-4' );
$as_card = 'card ';
if ( is_singular() ) {
	$as_card = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ''. $as_card .' w-100' ); ?>>
	<?php if ( !is_singular() ) : $size = 'medium';?>
		<!-- ACF extra feature img -->
	    <?php wp_bootstrap_4_acf_post_grid_thumbnail($image, $size, $blog_grid_link_text); ?>
	<?php endif; ?>
	<?php if( is_singular() ) : ?>
			<?php wp_bootstrap_4_post_thumbnail($image = null); ?>
	<?php endif; ?>
	<div class="card-body d-flex flex-column">
		<?php if ( is_sticky() ) : ?>
			<span class="sticky text-muted" title="<?php echo esc_attr__( 'Sticky Post', 'wp-bootstrap-4' ); ?>"></span>
		<?php endif; ?>
		<!--  Show category labels in post types -->
		<?php if ( 'post' === get_post_type() || 'service' === get_post_type() ) : ?>
			<?php if ( ! is_singular()  ) : ?>
				<div class="entry-footer mb-2">
					<?php wp_bootstrap_4_entry_footer(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<header class="entry-header">
			<?php
			if ( is_singular() ) {
				if ( !get_theme_mod( 'full_page_header', 1 )) {
					if ( get_theme_mod( 'title_under_image', 'no' ) === 'yes' ) {
						the_title( '<h1 class="entry-title h2 mb-0">', '</h1>' );
						wp_bootstrap_4_entry_footer();
					}
				}
			} else {
				the_title( '<h2 class="entry-title card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" title="'. wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ).' '. get_the_title() .'">', '</a></h2>' );				
			}
			if ( 'post' === get_post_type() ) : 
			?>
			<div class="entry-meta <?php echo is_singular()? 'mb-3':'' ;?> d-none">
				<?php wp_bootstrap_4_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		
		<?php if( is_singular() || get_theme_mod( 'default_blog_display', 'excerpt' ) === 'full' ) : ?>
			<div id="article-content" class="entry-content single-post-content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-bootstrap-4' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-4' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<!--  Show tag labels in post types -->
			<?php if ( 'post' === get_post_type() || 'service' === get_post_type() ) : ?>
				<footer class="entry-footer">
					<?php wp_bootstrap_4_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		<?php else : ?>
			<div class="entry-summary d-flex flex-column align-items-start h-100">
				<?php if ( get_theme_mod( 'show_excerpt', 'yes' ) === 'yes' ) {the_excerpt(); }?>
				<?php echo wp_bootstrap_4_posts_link(); ?>
			</div><!-- .entry-summary -->
		<?php endif; ?>
	</div>
	<!-- /.card-body -->
</article><!-- #post-<?php the_ID(); ?> -->
