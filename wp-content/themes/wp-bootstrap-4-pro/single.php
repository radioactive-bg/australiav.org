<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_4
 */

get_header(); ?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
    $senter_mode = get_theme_mod( 'center_page_header', 1 );
?>

<?php if ( get_theme_mod( 'full_page_header', 1 ) ) :
	get_template_part( 'template-parts/content', 'post-heading' );
endif; ?>

<div class="container section-gutter <?php if( get_theme_mod( 'blog_display_related_posts', 1 ) && get_theme_mod( 'position_related_posts', 'content' ) === 'content'): ?>pb-0<?php endif; ?>">
	<div class="row">
		<?php if ( !get_theme_mod( 'full_page_header', 1 )) : 
		if ( get_theme_mod( 'title_under_image', 'no' ) === 'no' ) :
		?>
		<div class="col-12 <?php echo $senter_mode ? 'flex-column text-center' : '' ;?> mb-4 mt-3">
		<?php 
		if (function_exists('rank_math_the_breadcrumbs')) {rank_math_the_breadcrumbs();}
		the_title( '<h1 class="entry-title my-1">', '</h1>' );
		wp_bootstrap_4_posted_on(); ?>	
		</div>	
		<?php endif; endif; ?>
		<?php if ( $default_sidebar_position === 'no' ) : ?>
			<div class="col-lg-12 content-width">
		<?php else : ?>
			<div class="col-lg-8 content-width">
		<?php endif; ?>
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
					<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', get_post_type() );
							if ( 'post' === get_post_type() ) :
							the_post_navigation(array(
								'prev_text' => esc_html__( '&laquo; Previous Post', 'wp-bootstrap-4' ),
								'next_text' => esc_html__( 'Next Post &raquo;', 'wp-bootstrap-4' ),
							) );
							endif;
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						endwhile; // End of the loop.
					?>
					</main><!-- #main -->
				</div><!-- #primary -->
		</div>
		<!-- /.col-lg-8 -->
		<?php if ( $default_sidebar_position != 'no' ) : ?>
			<?php if ( $default_sidebar_position === 'right' ) : ?>
				<div class="col-lg-4 sidebar-width">
			<?php elseif ( $default_sidebar_position === 'left' ) : ?>
				<div class="col-lg-4 order-lg-first sidebar-width">
			<?php endif; ?>
					<?php get_sidebar(); ?>
				</div>
				<!-- /.col-lg-4 -->
		<?php endif; ?>
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->

<?php 
acf_blocks();
?>
<!-- icf gallery -->
<?php 
$images = get_field('gallery');
if( $images ): ?>
<div class="container section-gutter">
	<div class="row">
		<?php foreach( $images as $image ): ?>
			<div class="col-12 col-md-6 col-lg-3 mt-3">
				<a href="<?php echo esc_url($image['url']); ?>">
					<img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['title']); ?>" />
				</a>
				<p><?php echo esc_html($image['caption']); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>
<!-- end icf gallery -->

<?php
 if ( get_theme_mod( 'blog_display_related_posts', 1 ) && get_theme_mod( 'position_related_posts', 'content' ) === 'content') {
	if ( 'post' === get_post_type() ) {
		if( function_exists('related_posts')) { ?>
		<section class="section-related section-gutter overflow-visible <?php echo $senter_mode ? 'text-center' : '' ;?>">
			<div class="container">
				<div class="row">
					<h2 class="col-12"><?php echo __( 'More Articles', 'wp-bootstrap-4' ) ;?></h2>
					<?php echo related_posts(); ?>
				</div>
			</div>
		</section>
<?php 	} 
	}
}	
// Doesn't work !!!!
 if ( get_field( 'show_global_layout' ) ) :
	get_template_part( 'template-parts/front-page/cta-global' );
 endif;

get_footer();
