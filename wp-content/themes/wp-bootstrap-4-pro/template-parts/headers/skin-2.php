<?php
/**
 * Header Style: Skin 2
 *
 */
$header_style = get_field('header_style', 'option');
$invert_heading = '';
if( have_rows( 'page_header_settings' ) ) :
    while ( have_rows('page_header_settings')) : the_row();
    $invert_heading = get_sub_field('invert_heading');
    endwhile;
endif;

?>
<header id="masthead" class="header_<?php echo $header_style ;?> site-header <?php echo ($invert_heading) ? 'inverted-nav' : ''; ?>  <?php if ( get_theme_mod( 'sticky_header', 0 ) ) : echo 'sticky-top'; endif; ?>">

<?php if( get_theme_mod( 'header_within_container', 0 ) ) : ?><div class="container py-2 py-lg-3 <?php echo is_front_page()? '' : ''; ?>"><?php else: ?><div class="container-fluid py-2 py-lg-3 <?php echo is_front_page()? '' : ''; ?>"><?php endif; ?>
	<div class="row">
		<div class="col-12 col-lg d-flex flex-wrap flex-column align-items-center">
			<button class="x-navbar-dark navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#primary-menu-wrapper" aria-controls="primary-menu-wrapper" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php the_custom_logo(); ?>
		
			<div class="site-branding-text col col-md-auto col-lg text-center <?php if ( is_rtl()) : ?>text-md-right<?php else: ?>text-md-left<?php endif; ?> px-0 ml-0 ml-md-3">
				<?php
					if ( is_front_page() || is_home() ) : ?>
						<h1 class="site-title h3 mb-0 mx-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand m-0"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<h2 class="site-title h3 mb-0 mx-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand m-0"><?php bloginfo( 'name' ); ?></a></h2>
					<?php
					endif;

					if ( get_theme_mod( 'show_site_description', 1 ) ) {
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_html( $description ); ?></p>
						<?php
						endif;
					}
				?>
			</div>
		</div>		
	</div>
</div><!-- /.container or /.container-fluid-->
<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg w-100">
	<?php if( get_theme_mod( 'header_within_container', 0 ) ) : ?><div class="container"><?php else: ?> <div class="container-fluid"><?php endif; ?>
		<?php
			
			wp_nav_menu( array(
				'theme_location'  => 'menu-1',
				'menu_id'         => 'primary-menu',
				'container'       => 'div',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'primary-menu-wrapper',
				'menu_class'      => 'navbar-nav mx-auto py-4 py-lg-0 px-0',
				'fallback_cb'     => '__return_false',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 2,
				'walker'          => new WP_bootstrap_4_walker_nav_menu()
			) );
			
		?>
	
	</div><!-- /.container or /.container-fluid-->
</nav><!-- #site-navigation -->
</header><!-- #masthead -->