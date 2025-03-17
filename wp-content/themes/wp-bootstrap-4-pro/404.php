<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_Bootstrap_4
 */

get_header(); ?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
?>
	<div class="jumbotron d-flex align-items-center <?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-no-page-header' : 'no-page-header' ; ?>" style="min-height: 86vh;">
		<section class="container section-gutter d-flex align-items-center">
			<div class="row flex-1">

				<?php if ( $default_sidebar_position === 'no' ) : ?>
					<div class="col-lg-12 content-width">
				<?php else : ?>
					<div class="col-lg-8 content-width">
				<?php endif; ?>

					<div id="primary" class="content-area error-404">
						<main id="main" class="site-main">

							<div class="card bg-transparent border-0">
								<div class="card-body">
									<section class="error-404 not-found d-flex flex-column align-items-center">
										<header class="page-header">
											<h1 class="page-title font-weight-bold" style="font-size: 8rem;"><?php esc_html_e( '404', 'wp-bootstrap-4' ); ?></h1>
										
										</header><!-- .page-header -->

										<div class="page-content text-center" style="max-width: 560px;">
											<p class="mb-5 lead font-weight-bold">
												<?php esc_html_e( 'Hello, seems you didn\'t find what you looking for, please follow the button below', 'wp-bootstrap-4' ); ?><br>
												
											</p>
											<?php
												//get_search_form();

												// the_widget( 'WP_Widget_Recent_Posts', array(), array(
												// 	'before_title' => '<h5 class="widget-title mt-4">',
												// 	'after_title'  => '</h5>',
												// ) );
											?>
											<a class="btn btn-primary mt-5 mx-auto" href="<?php echo site_url(); ?>" title="<?php echo get_bloginfo( 'name' );?>"><?php esc_html_e( 'Homepage', 'wp-bootstrap-4' ); ?></a>
											<div class="widget widget_categories d-none">
												<h5 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'wp-bootstrap-4' ); ?></h5>
												<ul>
												<?php
													// wp_list_categories( array(
													// 	'orderby'    => 'count',
													// 	'order'      => 'DESC',
													// 	'show_count' => 1,
													// 	'title_li'   => '',
													// 	'number'     => 10,
													// ) );
												?>
												</ul>
											</div><!-- .widget -->

											<?php

												// the_widget( 'WP_Widget_Archives', 'dropdown=1', array(
												// 	'before_title' => '<h5 class="widget-title">',
												// 	'after_title'  => '</h5>',
												// ) );

												// the_widget( 'WP_Widget_Tag_Cloud', array(), array(
												// 	'before_title' => '<h5 class="widget-title">',
												// 	'after_title'  => '</h5>',
												// ) );
											?>

										</div><!-- .page-content -->
									</section><!-- .error-404 -->
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->

						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
				<!-- /.col-lg-8 -->

				<?php if ( $default_sidebar_position != 'no' ) : ?>
					<?php if ( $default_sidebar_position === 'right' ) : ?>
						<div class="col-lg-4 sidebar-width d-none">
					<?php elseif ( $default_sidebar_position === 'left' ) : ?>
						<div class="col-lg-4 order-lg-first sidebar-width d-none">
					<?php endif; ?>
							<?php // get_sidebar(); ?>
						</div>
						<!-- /.col-lg-4 -->
				<?php endif; ?>
			</div>
			<!-- /.row -->
		</section>
		<!-- /.container -->
	</div>
<?php
get_footer();
