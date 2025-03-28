<?php

if( class_exists( 'Kirki' ) ) {
    function wp_bootstrap_4_colors_section( $wp_customize ) {
        $wp_customize->get_control( 'background_color' )->label = esc_html__( 'Body Background Color', 'wp-bootstrap-4' );
        $wp_customize->get_section( 'colors' )->title = esc_html__( 'Theme Colors', 'wp-bootstrap-4' );
    }
    add_action( 'customize_register', 'wp_bootstrap_4_colors_section' );
}
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'body_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Body Color', 'wp-bootstrap-4' ),
    'default'  => '#333333',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( 'body','.text-default', '.sidebar-area .widget ul li a:not(:hover)'),
			'property' => 'color',
		),
      
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'heading_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Title Color', 'wp-bootstrap-4' ),
    'default'  => '#333333',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.site-content h1', '.site-content h2', '.site-content h3', '.site-content h4', '.site-content h5', '.site-content h6'),
			'property' => 'color',
		),
      
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'header_title',
	'section'  => 'colors',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Header', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_header_bg_color',
	'label'    => esc_html__( 'Header Background Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#ffffff',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.navbar' ),
			'property' => 'background-color',
		),
        array(
			'element'  => array( '.trans-header.body-scrolled .site-header.sticky-top .navbar' ),
			'property' => 'background-color',
		),
		array(
			'element'  => array( '.dropdown-menu' ),
			'property' => 'background-color',
		),
		array(
			'element'  => array( '.trans-header .navbar-collapse' ),
			'property' => 'background-color',
			'media_query' => '@media (max-width:991px)',
		),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_header_menu_color',
	'label'    => esc_html__( 'Header Menu Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#333333',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.navbar-nav .nav-link', '.site-header .btn-outline-dark', '.site-header .btn-link' ),
			'property' => 'color',
		),
		array(
			'element'  => array( '.dropdown-toggle::after', '.site-header .btn-outline-dark' ),
			'property' => 'border-color',
		),
		array(
			'element'  => array( 'button.dropdown-toggle'),
			'property' => 'border-color',
			'media_query' => '@media (max-width:991px)',
		),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_header_menu_hover_color',
	'label'    => esc_html__( 'Header Menu Hover and Active Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#004cff',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.navbar-nav .nav-item:not(.active)> .nav-link:hover', '.navbar-nav .nav-link.active:focus', '.navbar-nav .nav-link.active' ),
			'property' => 'color',
		),
		array(
			'element'  => array( '.navbar-nav .show>.nav-link', '.navbar-nav>.active>.nav-link', '.navbar-nav>.current-menu-parent>.nav-link' , '.navbar-nav .current-menu-item.active>.nav-link' , '.navbar-nav .nav-link.show', '.site-footer .menu>.current-menu-item>a:not(:hover)', '.site-footer .navbar-nav>.active>.nav-link' ),
			'property' => 'color',
		),
		array(
			'element'  => array( '.site-header .btn-outline-dark:hover', '.site-header .btn-link:hover', '.site-header .btn-outline-dark:not(:disabled):not(.disabled):active' ),
			'property' => 'color',
			
		),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'accent_title',
	'section'  => 'colors',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Link Color', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_accent_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Accent Color', 'wp-bootstrap-4' ),
    'default'  => '#0099db',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array('a', 'text-accent'),
			'property' => 'color',
            //'value_pattern' => '$!important',
		),
    ),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_accent_hover_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Accent Hover Color', 'wp-bootstrap-4' ),
    'default'  => '#0099db',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
		array(
            'element'  => array('a:hover','a:focus'),
			'property' => 'color',
        ),
    ),
	array(
		'element'  => array( 'a:not(.btn):not(.nav-link):focus', '.entry-meta a:hover', '.comments-link a:hover', '.edit-link a:hover' ),
		'property' => 'color',
	),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'primary_title',
	'section'  => 'colors',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Button Primary', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_primary_color',
    'label' => esc_html__( 'Primary Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#004cff',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.content-area .sp-the-post .entry-header .entry-title a:hover', '.sidebar-area .widget ul li.current-menu-item a' ),
			'property' => 'color',
		),
        array(
			'element'  => array( '.x-navbar-nav .dropdown-menu .active', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.sp-services-section .sp-single-service .sp-service-icon', '.button.add_to_cart_button', '.wc-proceed-to-checkout .checkout-button.button', '.price_slider_amount button[type="submit"]' ),
			'property' => 'background-color',
		),
		array(
			'element'  => array( '.heading:after', '.sidebar-area h2:after','.label-style:before', '.label-style:after' ),
			'property' => 'background-color',
		),
        array(
			'element'  => array( 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.button.add_to_cart_button', '.wc-proceed-to-checkout .checkout-button.button', '.price_slider_amount button[type="submit"]' ),
			'property' => 'border-color',
		),
        array(
			'element'  => array( '.text-primary *:not(.btn)'),
			'property' => 'color',
            'value_pattern' => '$ !important',
		),
        array(
            'element'  => array( '.entry-title a:hover', ),
            'property' => 'color',
            'value_pattern' => '$ !important',
        ),
        array(
            'element' => array( '.shop_table.shop_table_responsive.woocommerce-cart-form__contents button[type="submit"]', '.form-row.place-order button[type="submit"]', '.single-product .summary.entry-summary button[type="submit"]' ),
            'property' => 'background-color',
        ),
        array(
            'element' => array( '.shop_table.shop_table_responsive.woocommerce-cart-form__contents button[type="submit"]', '.form-row.place-order button[type="submit"]', '.single-product .summary.entry-summary button[type="submit"]'),
            'property' => 'border-color',
        ),
		array(
            'element' => array( '.woocommerce-form-login .button', '.woocommerce-button', '.woocommerce-Button', '.wc-forward', '.wc-backward' ),
            'property' => 'background-color',
        ),
        array(
            'element' => array( '.woocommerce-form-login .button', '.woocommerce-button', '.woocommerce-Button', '.wc-forward', '.wc-backward' ),
            'property' => 'border',
			'value_pattern' => '2px solid $',
        ),
    ),
) );


WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_primary_hover_color',
	'label'    => esc_html__( 'Primary Hover Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#0043e1',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array('input[type="button"]:hover', 'input[type="button"]:active', 'input[type="button"]:focus', 'input[type="submit"]:hover', 'input[type="submit"]:active', 'input[type="submit"]:focus', '.button.add_to_cart_button:hover', '.wc-proceed-to-checkout .checkout-button.button:hover', '.price_slider_amount button[type="submit"]:hover' ),
			'property' => 'background-color',
		),
        array(
			'element'  => array( 'input[type="button"]:hover', 'input[type="button"]:active', 'input[type="button"]:focus', 'input[type="submit"]:hover', 'input[type="submit"]:active', 'input[type="submit"]:focus', '.button.add_to_cart_button:hover', '.wc-proceed-to-checkout .checkout-button.button:hover', '.price_slider_amount button[type="submit"]:hover' ),
			'property' => 'border-color',
		),
		array(
            'element'       => array( '.btn-primary:focus', '.btn-primary:active',' .btn-primary:active:focus','.btn-outline-primary:focus', '.page-link:focus' ),
            'property'      => 'box-shadow',
			'suffix' => '!important',
            'value_pattern' => '0 0 0px 0.2rem $80',
        ),
        array(
            'element' => array( '.shop_table.shop_table_responsive.woocommerce-cart-form__contents button[type="submit"]:hover', '.form-row.place-order button[type="submit"]:hover', '.single-product .summary.entry-summary button[type="submit"]:hover'),
            'property' => 'background-color',
            'value_pattern' => '$ !important',
        ),
        array(
            'element' => array( '.shop_table.shop_table_responsive.woocommerce-cart-form__contents button[type="submit"]:hover', '.form-row.place-order button[type="submit"]:hover', '.single-product .summary.entry-summary button[type="submit"]:hover' ),
            'property' => 'border-color',
            'value_pattern' => '$ !important',
        ),
		array(
            'element' => array( '.woocommerce-form-login .button:hover', '.woocommerce-button:hover', '.woocommerce-Button:hover', '.wc-forward:hover', '.wc-backward:hover' ),
            'property' => 'background-color',
        ),
        array(
            'element' => array( '.woocommerce-form-login .button:hover', '.woocommerce-button:hover', '.woocommerce-Button:hover', '.wc-forward:hover', '.wc-backward:hover' ),
            'property' => 'border',
			'value_pattern' => '2px solid $',
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'secondary_title',
	'section'  => 'colors',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Button Secondary', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_secondary_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Secondary Color', 'wp-bootstrap-4' ),
    'default'  => '#47b24d',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
		array(
			'element'  => array( '.text-secondary *:not(.btn)'),
			'property' => 'color',
            'value_pattern' => '$ !important',
		),
    ),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_secondary_hover_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Secondary Hover Color', 'wp-bootstrap-4' ),
    'default'  => '#36913a',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
		array(
            'element'       => array( '.btn-secondary:focus', '.btn-secondary:active',' .btn-secondary:active:focus','.btn-outline-secondary:focus' ),
            'property'      => 'box-shadow',
			'suffix' => '!important',
            'value_pattern' => '0 0 0px 0.2rem $80',
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'dark_title',
	'section'  => 'colors',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Button Dark', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_dark_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Dark Color', 'wp-bootstrap-4' ),
    'default'  => '#333333',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array('.text-dark *:not(.btn)'),
			'property' => 'color',
            'value_pattern' => '$!important',
		),
    ),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_dark_hover_color',
	'section'  => 'colors',
	'type'     => 'color',
    'label' => esc_html__( 'Dark Hover Color', 'wp-bootstrap-4' ),
    'default'  => '#202020',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
		array(
            'element'       => array( '.btn-dark:focus', '.btn-dark:active',' .btn-dark:active:focus','.btn-outline-dark:focus' ),
            'property'      => 'box-shadow',
			'suffix' => '!important',
            'value_pattern' => '0 0 0px 0.2rem $80',
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'footer_title_end',
	'section'  => 'colors',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Footer', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_footer_bg_color',
	'label'    => esc_html__( 'Footer Background Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#ffffff',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.site-footer' ),
			'property' => 'background-color',
		),
    ),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_footer_text_color',
	'label'    => esc_html__( 'Footer Text Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#777777',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.site-footer' ),
			'property' => 'color',
		),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_footer_title_color',
	'label'    => esc_html__( 'Footer Title Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#333333',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.site-footer h1', '.site-footer h2', '.site-footer h3', '.site-footer h4', '.site-footer h5', '.site-footer h6', '.site-footer .h1', '.site-footer .h2', '.site-footer .h3', '.site-footer .h4', '.site-footer .h5', '.site-footer .h6' ),
			'property' => 'color',
		),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'styling_footer_link_color',
	'label'    => esc_html__( 'Footer Link Color', 'wp-bootstrap-4' ),
	'section'  => 'colors',
	'type'     => 'color',
    'default'  => '#333333',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.site-footer a:not(.btn):not(:hover)' ),
			'property' => 'color',
            //'value_pattern' => '$ !important',
		),
    ),
) );
