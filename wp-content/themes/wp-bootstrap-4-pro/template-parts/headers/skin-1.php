<?php
/**
 * Header Style: Skin 1
 *
 */
$header_style = get_field('header_style', 'option');
$invert_heading = '';
if( have_rows( 'page_header_settings' ) ) :
    while ( have_rows('page_header_settings')) : the_row();
    $invert_heading = get_sub_field('invert_heading');
    endwhile;
endif;

$template_class = '';
$client_zone = false;
if ( is_page_template( array( 'page-templates/client-area.php', 'page-templates/register.php' )) ) {
	$client_zone = true ;
	$template_class = 'client-zone-header';
}
?>
<header id="masthead" class="header_<?php echo $header_style ;?> site-header <?php echo ( $client_zone == true ) ? $template_class : ''; ?> <?php echo ($invert_heading) ? 'inverted-nav' : ''; ?> <?php if ( get_theme_mod( 'sticky_header', 0 ) ) : echo 'sticky-top'; endif; ?>">

	    <?php if( get_theme_mod( 'header_within_container', 0 ) ) : ?><div class="<?php echo ( $client_zone == true ) ? 'container-fluid header-back px-lg-5' : 'container'; ?> py-4"><?php else: ?> <div class="container-fluid py-4 d-flex align-items-center"><?php endif; ?>
			<div class="row align-items-center">
				<div class="col-auto col-lg d-flex flex-wrap align-items-center justify-content-center justify-content-md-arrownd justify-content-lg-start">
				<?php if ( $client_zone ): ?> 
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="" rel="home" aria-current="page">
						<img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.png" class="custom-logo" alt="USA Green Card Dream">
					</a>
				<?php else: ?>
					<?php the_custom_logo(); ?>
				<?php endif; ?>
					<div class="site-branding-text col-12 col-md-auto col-lg text-center <?php if ( is_rtl()) : ?>text-md-right<?php else: ?>text-md-left<?php endif; ?> px-0 ml-0 ml-md-3">
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
				
				<div class="col col-lg-auto d-flex justify-content-end">
				<?php  
					if ( is_page_template( array( 'page-templates/client-area.php', 'page-templates/register.php' )) ) {
						do_action('wpml_add_language_selector'); 
					} else {
						if( have_rows('header_buttons_repeater', 'option') ):
                            acf_header_cta(); 
                        endif;
					}
				?>
				</div>				
			</div>
		</div><!-- /.container or /.container-fluid-->
	    <?php if( get_theme_mod( 'with_nav', 1 ) ) : ?>
		<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg w-100">
			<?php if( get_theme_mod( 'header_within_container', 0 ) ) : ?><div class="<?php echo ( $client_zone == true ) ? 'container-fluid px-lg-4' : 'container'; ?>"><?php else: ?> <div class="container-fluid"><?php endif; ?>
				<!-- logo was here, site title and site description was here-->
				<button class="navbar-toggler order-lg-1" type="button" data-toggle="collapse" data-target="#primary-menu-wrap" aria-controls="primary-menu-wrap" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<?php
					if ( is_page_template( array( 'page-templates/client-area.php', 'page-templates/register.php' )) ) {
						if ( is_user_logged_in() ) {
							$current_user = wp_get_current_user();
							$user = $current_user->display_name;
							$string_welcome = __( 'Welcome:', 'wp-bootstrap-4' ); 
							$string_logout = __( 'Logout', 'wp-bootstrap-4' ); 
							$string_cart = __( 'View your shopping cart', 'wp-bootstrap-4' );
							$string_amount = __( 'Amount:', 'wp-bootstrap-4' );
							$string_my_account = __( 'My Account Details', 'wp-bootstrap-4' ); 
							$string_vip = __( 'VIP Services', 'wp-bootstrap-4' );
							$string_item = __( 'item', 'wp-bootstrap-4' );
							$string_items = __( 'items', 'wp-bootstrap-4' );
						?>	
							<ul class="client-zone-user-navbar d-flex align-items-center order-lg-3 ml-lg-auto p-0 mb-0">
								<li class="nav-link nav-link-account">
									<img width="20px" height="20px" src="<?php echo (get_template_directory_uri() . '/assets/images/bootstrap-icons/person-fill-white.svg'); ?>" alt="user" style="max-width: 20px; margin-top: -3px;"/>
									<span class="d-none d-lg-inline-block"><?php echo $string_welcome; ?></span> 
									<a class="" href="<?php echo (get_permalink( get_option('woocommerce_myaccount_page_id')).'edit-account') ; ?>" title="<?php echo $string_my_account; ?>"><?php echo $user; ?></a>
								</li>
								<li class="nav-link nav-link-vip ml-1 d-none d-sm-inline-block">
									<img class="mr-1" width="20px" height="20px" src="<?php echo (get_template_directory_uri() . '/assets/images/crown.svg'); ?>" alt="crown" style="margin-top: -5px;"/>
									<a class="" href="<?php echo esc_url( home_url( '/price') ); ?>" title="<?php echo $string_vip; ?>">
										<?php echo $string_vip; ?>
									</a>
								</li>
								<li class="nav-link nav-link-cart ml-1">
									<span class="d-none d-lg-inline-block"><?php echo $string_amount; ?></span> 
									<a class="" href="<?php echo wc_get_cart_url(); ?>" title="<?php echo $string_cart; ?>"><?php echo sprintf ( _n( '%d ' . $string_item, '%d '. $string_items, WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> – <?php echo WC()->cart->get_cart_total(); ?></a>
								</li>
								<li class="nav-link nav-link-cart ml-1">
									<a class="" href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php echo $string_logout; ?>"><?php echo $string_logout; ?></a>
								</li>
							</ul>
						<?php
							wp_nav_menu( array(
								'theme_location'  => 'client-area',
								'menu_id'         => 'secondary-menu',
								'container'       => 'div',
								'container_class' => 'collapse navbar-collapse order-lg-2',
								'container_id'    => 'primary-menu-wrap',
								'menu_class'      => 'navbar-nav mr-auto py-4 py-lg-0 px-0',
								'fallback_cb'     => '__return_false',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 3,
								'walker'          => new WP_bootstrap_4_walker_nav_menu()
							) );
						
						} else {
							$string = __( 'Need to login first!', 'wp-bootstrap-4' ); 
						?>
							<span class="text-white py-1 mx-auto"> <?php echo ($string); ?></span> 
						<?php
						}
					} else {

						if ( is_active_sidebar( 'header-social' ) ) {
							dynamic_sidebar( 'header-social' ); 
						}
						if( get_theme_mod( 'header_within_container', 0 ) ) {
							
						}
						wp_nav_menu( array(
							'theme_location'  => 'menu-1',
							'menu_id'         => 'primary-menu',
							'container'       => 'div',
							'container_class' => 'collapse navbar-collapse order-lg-2',
							'container_id'    => 'primary-menu-wrap',
							'menu_class'      => 'navbar-nav mr-auto py-4 py-lg-0 px-0',
							'fallback_cb'     => '__return_false',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 3,
							'walker'          => new WP_bootstrap_4_walker_nav_menu()
						) );
					}
				?>
			
			</div><!-- /.container or /.container-fluid-->
		</nav><!-- #site-navigation -->
		<?php endif; ?>
	</header><!-- #masthead -->