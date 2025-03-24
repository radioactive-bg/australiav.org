<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WP_Bootstrap_4
 */

get_header(); ?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
	$column_count = get_theme_mod( 'grid_count', 'col-md-6 col-xl-6');
?>
<section class="full-page-header blog-full-page-header <?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-full-page-header' : '' ; ?>">
	<div class="page-header-overlay bg-overlay blog-bg-overlay">
		<div class="container">
			<div class="row <?php echo get_theme_mod( 'center_page_header', 1 ) ? 'justify-content-center' : '' ;?>">
				<div class="col-12 x-col-xl-8 <?php echo get_theme_mod( 'center_page_header', 1 ) ? 'text-center' : '' ;?>">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'wp-bootstrap-4' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- .page-header -->
	<div class="container section-gutter">
		<div class="row">

			<?php if ( $default_sidebar_position === 'no' ) : ?>
				<div class="col-lg-12 content-width">
			<?php else : ?>
				<div class="col-lg-8 content-width">
			<?php endif; ?>

				<section id="primary" class="content-area">
					<main id="main" class="site-main">

					<?php
					if ( have_posts() ) : ?>
						<div class="row">
						
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
						?>
						<div class="archive-post-item d-flex col-12 <?php echo (($default_sidebar_position != 'no') && ($column_count != '')) ? 'col-lg-12' : ''; ?> <?php echo wp_kses_post( get_theme_mod( 'grid_count', 'col-md-6 col-xl-6') ); ?> mb-4 mb-lg-5">
							<?php get_template_part( 'template-parts/content', 'search' ); ?>
						</div>
						<?php
						endwhile;
						echo bootstrap_pagination(); 
						// the_posts_navigation( array(
						// 	'next_text'         => esc_html__( 'Newer Posts', 'wp-bootstrap-4' ),
						// 	'prev_text'         => esc_html__( 'Older Posts', 'wp-bootstrap-4' ),
						// ) );

						else :

						get_template_part( 'template-parts/content', 'none' );
					?>
					</div>
					<?php endif; ?>

					</main><!-- #main -->
				</section><!-- #primary -->
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
get_footer();
