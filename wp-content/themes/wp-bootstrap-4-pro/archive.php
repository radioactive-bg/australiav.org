<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */

get_header(); ?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
	$column_count = get_theme_mod( 'grid_count', 'col-md-6 col-xl-6');
    
	$term = get_queried_object();
	$main_image = '' ;
	if (is_category() || is_tag()):
	$main_image = get_field('main_image',  $term);
    $brand_color = get_field('brand_color',  $term);
      if ($main_image):?>
	<style>
		.blog-full-page-header {background-size: cover; background-repeat: no-repeat;}
		html:not([dir="rtl"]) .blog-full-page-header { background-image: url('<?php echo $main_image ;?>'); background-position: center left; }
		html[dir="rtl"] .blog-full-page-header{ background-image:  url('<?php echo $main_image ;?>'); background-position: center right;}
   </style>
   <?php endif; 
	  if ($brand_color):
		?>
			<style>
				.blog-full-page-header { background-color: <?php echo $brand_color ;?>} ;
		   </style>
		<?php 
      endif; 
   endif; 
?>

<section class="full-page-header blog-full-page-header <?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-full-page-header' : '' ; ?>">
	<div class="page-header-overlay bg-overlay blog-bg-overlay">
		<div class="container">
			<div class="row <?php echo get_theme_mod( 'center_page_header', 1 ) ? 'justify-content-center' : '' ;?>">
				<div class="col-12 col-xl <?php echo get_theme_mod( 'center_page_header', 1 ) ? 'text-center' : '' ;?> ">
					<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
					<?php
						if ( function_exists('yoast_breadcrumb') ) :
							yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
						endif; 
						if (!is_author()):
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						// the_archive_description( '<div class="archive-description text-muted">', '</div>' );  
						else :
						echo author_info();
						endif; 
					?>	
					
					<?php
					if (!is_author()):
					if ( 'post' === get_post_type() ) : 
					$term = get_queried_object();
					$children = get_terms( $term->taxonomy, array(
						'parent'    => $term->term_id,
						'hide_empty' => true
					) );

					if ( $children ) { 
						echo '<ul class="sublist row gy-2 mb-0" style="padding: 0;list-style: none;">';
						foreach( $children as $subcat ){
						  echo '<li class="d-flex col-6 col-md-4 col-lg-2 text-center"><a class="w-100 card justify-content-center font-weight-bold p-2" href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . '</a></li>';
						}
						echo '</ul>';
					}
					endif;
					endif;
					?>
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

				<div id="primary" class="content-area">
					<main id="main" class="site-main">

					<?php
					if ( have_posts() ) : ?>

						<div class="row">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();
						?>
						<div class="archive-post-item d-flex col-12 <?php echo (($default_sidebar_position != 'no') && ($column_count != '')) ? 'col-lg-12' : ''; ?> <?php echo wp_kses_post( get_theme_mod( 'grid_count', 'col-md-6 col-xl-6') ); ?> mb-4">		
						<?php
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
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
					<?php
					if (!is_author()):
						 the_archive_description( '<div class="archive-description">', '</div>' );    
					endif; 
					?>
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
get_footer();
