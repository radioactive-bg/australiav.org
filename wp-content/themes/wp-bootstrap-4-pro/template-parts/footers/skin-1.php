<?php
/**
 * Footer Style: Skin 1
 *
 */
$footer_style = get_field('footer_style', 'option');

?>

<footer id="colophon" class="footer_<?php echo $footer_style ;?> site-footer">
	<section class="footer-widgets overflow-visible">
		<div class="container py-5 position-relative">
			<div class="row align-items-center">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="col-12 col-md mb-4 mb-lg-0 text-center text-md-left">
						<aside class="widget-area footer-1-area">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</aside>
					</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div class="col-12 col-md-auto mb-4 mb-lg-0">
					<aside class="widget-area footer-2-area">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</aside>
				</div>
				<?php endif; ?>
				
					<div class="col-12 col-md">
						<aside class="widget-area footer-3-area">
							<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<?php dynamic_sidebar( 'footer-3' ); ?>
							<?php endif; ?>
							<?php if ( get_theme_mod( 'footer_text' ) ): ?>
							<div class="text-center text-md-right">
							<?php echo wp_kses_post( get_theme_mod( 'footer_text', 'Website 2022 © All Rights Reserved' ) ); ?>
							</div>
							<?php endif; ?>
						</aside>
					</div>
				

				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<div class="col-12 col-md mt-4">
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
</footer><!-- #colophon -->