<?php
/**
 * Header Style: Default
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

<header id="masthead" class="header_<?php echo $header_style ;?> site-header <?php echo ($invert_heading) ? 'inverted-nav' : ''; ?> <?php if ( get_theme_mod( 'sticky_header', 0 ) ) : echo 'sticky-top'; endif; ?>">
		<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg py-2 py-lg-3">
		<?php if( get_theme_mod( 'header_within_container', 0 ) ) : ?><div class="container"><?php else: ?> <div class="container-fluid d-flex align-items-center px-xl-0"><?php endif; ?>
				<div class="site-branding-content col col-lg-auto d-flex flex-nowrap align-items-center px-0 pr-xl-5">
					<?php the_custom_logo(); ?>
			
					<div class="site-branding-text ml-3">
						<?php
							if ( is_front_page() || is_home() ) : ?>
								<h1 class="site-title d-block h3 mb-0 pb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand m-0"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<h2 class="site-title d-block h3 mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand m-0"><?php bloginfo( 'name' ); ?></a></h2>
							<?php
							endif;

							if ( get_theme_mod( 'show_site_description', 1 ) ) {
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description d-block"><?php echo esc_html( $description ); ?></p>
								<?php
								endif;
							}
						?>
					</div>
					<!-- Mobile -->
					<div class="mobile-visible d-flex align-items-center d-lg-none ml-auto">
						    <button class="btn btn-search d-none" type="button" id="dropdownSearch">
								<img width="20" height="20" data-no-lazy="1" src="<?php bloginfo( 'template_url' ); ?>/assets/images/search.svg" alt="search icon"/>
							</button>	
							<?php 
								do_action('wpml_add_language_selector');
	
							    if( have_rows('header_buttons_repeater', 'option') ):
								acf_header_cta(); 
							    endif;
							
								if ( function_exists( 'wp_bootstrap_4_woocommerce_header_cart' ) ) {
									wp_bootstrap_4_woocommerce_header_cart();
								}
							?>
					</div>
					<?php if( get_theme_mod( 'with_nav', 1 ) ) : ?>
					<button class="navbar-toggler <?php if( have_rows('header_buttons_repeater', 'option') ): ?>ml-3<?php else: ?>ml-3<?php endif; ?>" type="button" data-toggle="collapse" data-target="#primary-menu-wrapper" aria-controls="primary-menu-wrap" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<?php endif; ?>
				</div>
			    <?php if ( is_active_sidebar( 'header-social' ) ) { dynamic_sidebar( 'header-social' ); }?>
			     <?php do_action('wpml_add_language_selector'); ?>
			    <?php if( get_theme_mod( 'with_nav', 1 ) ) : ?>
				<div class="primary-menu-wrapper col-lg d-flex px-0">
					<?php
						wp_nav_menu( array(
							'theme_location'  => 'menu-1',
							'menu_id'         => 'primary-menu',
							'container'       => 'div',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'primary-menu-wrapper',
							'menu_class'      => 'navbar-nav mr-auto py-3 py-lg-0',
							'fallback_cb'     => '__return_false',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 3,
							'walker'          => new WP_bootstrap_4_walker_nav_menu()
						) );
						// Desktop	
						?>
							<div class="desktop-visible d-none d-lg-flex align-items-center ml-lg-4">
								<button class="btn btn-search d-none" type="button" id="dropdownSearch">
									<img width="20" height="20" data-no-lazy="1" src="<?php bloginfo( 'template_url' ); ?>/assets/images/search.svg" alt="search icon"/>
								</button>	
								<?php 
								    if( have_rows('header_buttons_repeater', 'option') ): acf_header_cta(); endif; 
									if ( function_exists( 'wp_bootstrap_4_woocommerce_header_cart' ) ) {
										wp_bootstrap_4_woocommerce_header_cart();
									}
								?>
							</div>
						<?php 
					?>	
				</div>
				<?php endif;?>
			</div><!-- /.container or /.container-fluid-->
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->