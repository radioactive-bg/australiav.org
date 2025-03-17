<?php
/**
 * Footer Style: Default
 *
 */
$footer_style = get_field('footer_style', 'option');

?>

<footer id="colophon" class="footer_<?php echo $footer_style ;?> site-footer section-gutter">
	<section class="footer-widgets">
		<div class="container">
			<div class="row align-items-center">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="col-12 col-md-6 col-lg mb-4">
						<aside class="widget-area footer-1-area">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</aside>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div class="col-12 col-md-6 col-lg mb-4">
						<aside class="widget-area footer-2-area">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</aside>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="col-12 col-md-6 col-lg mb-4">
						<aside class="widget-area footer-3-area">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</aside>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<div class="col-12 col-md-6 col-lg mb-4">
						<aside class="widget-area footer-4-area">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</aside>
					</div>
				<?php endif; ?>
			</div>
			<!-- /.row -->
		</div> <!-- /.container -->
	</section>

	<?php if ( is_active_sidebar( 'footer-bottom' ) ) : ?>
	<section class="container">
		<?php dynamic_sidebar( 'footer-bottom' ); ?>
	</section>
	<?php endif; ?>

	<!-- .footer-copyright -->
	<?php if ( get_theme_mod( 'footer_text' ) ): ?>
		<div class="footer-copyright container text-center" style="border-top: 1px solid rgba(255, 255, 255, 0);">
			<div class="d-flex flex-column align-items-center justify-content-center">
				<div class="flex-1 text-center">
				<?php
					wp_nav_menu( array(
						'theme_location'  => 'legal',
						'menu_id'         => 'ligal',
						'container'       => 'div',
						'container_class' => '',
						'container_id'    => 'legal-menu-wrap',
						'menu_class'      => 'navbar-nav legal-nav d-flex flex-column flex-md-row flex-wrap align-items-center justify-content-md-end',
						'fallback_cb'     => '__return_false',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => new WP_bootstrap_4_walker_nav_menu()
					) );
				?>
				</div>
				<div class="copyright mt-3">
					<?php echo wp_kses_post( get_theme_mod( 'footer_text', 'Website 2022 © All Rights Reserved' ) ); ?>
				</div>
	
			</div>
		</div>
	<?php endif; ?>
	
</footer><!-- #colophon -->
		