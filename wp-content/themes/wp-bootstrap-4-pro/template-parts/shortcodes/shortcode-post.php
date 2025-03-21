<?php
// Shortcode Display Posts
// [post_type_posts category_name="" num="" post_type="post"]
// [cats_related_posts]
$column_count = get_theme_mod( 'related_grid_count', 'col-md-6 col-xl-3');
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
$size = 'medium';
$blog_grid_link_text = esc_html__( 'Continue Reading', 'wp-bootstrap-4' );
?>
<div class="archive-post-item col-12 d-flex <?php echo wp_kses_post( get_theme_mod( 'related_grid_count', 'col-md-6 col-xl-3') ); ?> mt-4">
	<div class="card w-100">
		<?php wp_bootstrap_4_acf_post_grid_thumbnail($image, $size, $blog_grid_link_text); ?>
		<div class="card-body d-flex flex-column">

			 <?php wp_bootstrap_4_posts_cats(); ?>

			<h2 class="entry-title card-title h4 mb-2">
				<a class="" href="<?php the_permalink(); ?>" title="<?php echo wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ); ?> <?php echo the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="entry-summary d-flex flex-column align-items-start h-100">
				<div>
					<?php if (in_category('business')): ?>
						<a class="badge text-default mr-2" href="<?php echo site_url();?>/business"><img class="mr-1" width="16px" height="16px" src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-business.svg" alt="icon business" style="margin-top:-4px;"/><?php esc_html_e( 'Business', 'wp-bootstrap-4' ); ?></a>
					<?php endif; ?>
					<?php if (in_category('personal')): ?>
						<a class="badge text-default" href="<?php echo site_url();?>/personal/"><img class="mr-1" width="16px" height="16px" src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-personal.svg" alt="icon personal" style="margin-top:-4px;"/><?php esc_html_e( 'Personal', 'wp-bootstrap-4' ); ?></a>
					<?php endif; ?>
				</div>
				<div class="post-content mb-3 mt-2">
					<?php if ( get_theme_mod( 'show_excerpt', 'yes' ) === 'yes' ) {the_excerpt(); }?>			
				</div>
				<?php echo wp_bootstrap_4_posts_link(); ?>
			</div>
		</div>
		<?php if ( 'post' === get_post_type() || 'service' === get_post_type() ) : ?>
		<footer class="entry-footer card-footer d-none">
			<?php wp_bootstrap_4_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</div>
<?php