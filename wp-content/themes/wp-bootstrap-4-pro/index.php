<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */

get_header(); ?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
	$column_count = get_theme_mod( 'grid_count', 'col-md-6 col-xl-6');
?>

<?php if ( get_theme_mod( 'blog_display_cover_section', 1 ) ) : ?>
	<?php if( get_theme_mod( 'blog_cover_title' ) || get_theme_mod( 'blog_cover_lead' ) || get_theme_mod( 'blog_cover_btn_text' ) ) : ?>
		<section class="full-page-header blog-full-page-header <?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-full-page-header' : '' ; ?>">
			<div class="page-header-overlay bg-overlay blog-bg-overlay">
				<div class="container">
					<div class="row <?php echo get_theme_mod( 'center_page_header', 1 ) ? 'justify-content-center' : '' ;?>">
						<div class="col-12 col-xl-8 <?php echo get_theme_mod( 'center_page_header', 1 ) ? 'text-center' : '' ;?>">
							<?php 
								if ( function_exists('yoast_breadcrumb') ) :
									yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
								endif; 
							?>
							<h1 class="page-title"><?php echo wp_kses_post( get_theme_mod( 'blog_cover_title' ) ); ?></h1>
							<p class="lead"><?php echo wp_kses_post( get_theme_mod( 'blog_cover_lead' ) ); ?></p>
							<?php if( get_theme_mod( 'blog_cover_btn_text' ) ) : ?><a href="<?php echo esc_url( get_theme_mod( 'blog_cover_btn_link' ) ); ?>" class="btn btn-primary"><?php echo esc_html( get_theme_mod( 'blog_cover_btn_text' ) ); ?></a><?php endif; ?>
						</div>
					</div>
					<?php if ( get_theme_mod( 'blog_display_tags', 0 ) ) : ?>
					<div class="blog-tag-label-wrapper mt-5"> 
						<h2><?php echo __( 'View form Tags', 'wp-bootstrap-4' ) ;?> </h2>
						<?php 
						$attr = array(); // Initialize $attr to avoid warning
						if( function_exists('parent_tag_list')) { echo parent_tag_list($attr); } 
						?> 
					</div>
					<?php endif; ?>
					<?php if ( get_theme_mod( 'blog_display_categories', 0 ) ) : ?>
					<div class="blog-cat-label-wrapper mt-5"> 
						<h2><?php echo __( 'View form Categories', 'wp-bootstrap-4' ) ;?></h2>
						<?php if( function_exists('parent_category_list')) {  echo parent_category_list(); } ?> 
					</div>
					<?php endif; ?>
				</div>
			<!-- /.container -->
			</div>
		</section>
	<?php endif; ?>
<?php endif; ?>


<section class="container section-gutter index-blog">
	<div class="row">

		<?php if ( $default_sidebar_position === 'no' ) : ?>
			<div class="col-lg-12 content-width">
		<?php else : ?>
			<div class="col-lg-8 content-width">
		<?php endif; ?>
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

					if( get_theme_mod( 'blog_display_posts_slider', '1' ) && is_home() && !is_paged() ) {
						get_template_part( 'template-parts/posts-slider' );
					}
					?>
					<div class="row">
					<?php 
					/* Start the Loop */
					while ( have_posts() ) : the_post();
					?>
					<div class="archive-post-item d-flex col-12 <?php echo (($default_sidebar_position != 'no') && ($column_count != '')) ? 'col-lg-12' : ''; ?> <?php echo wp_kses_post( get_theme_mod( 'grid_count', 'col-md-6 col-xl-6') ); ?> mb-4">	
					<?php 
					// Include the Post-Format-specific template for the content.
						get_template_part( 'template-parts/content', get_post_format() ); 
					?>
					</div>
					<?php
					endwhile;
					?>
					</div>
					<?php 
					echo bootstrap_pagination();
					// the_posts_navigation( array(
					// 	'next_text' => esc_html__( 'Newer Posts', 'wp-bootstrap-4' ),
					// 	'prev_text' => esc_html__( 'Older Posts', 'wp-bootstrap-4' ),
					// ) );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

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
</section>
<!-- /section -->

<?php
get_footer();
