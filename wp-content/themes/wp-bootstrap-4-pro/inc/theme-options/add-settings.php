<?php

require get_template_directory() . '/inc/theme-options/class-theme-kirki.php';

WP_Bootstrap_4_Kirki::add_config( 'wp_bootstrap_4_theme', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

WP_Bootstrap_4_Kirki::add_panel( 'theme_options', array(
    'priority'    => 31,
    'title'       => esc_html__( 'Theme Options', 'wp-bootstrap-4' ),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'logo_height',
	'label'    => esc_html__( 'Logo Height (in px)', 'wp-bootstrap-4' ),
	'section'  => 'title_tagline',
	'type'     => 'number',
	'priority' => 8,
	'default'  => 60,
    'tooltip'  => esc_html__( 'Minimum height 25px & maximum height 200px. Width will be adjusted automatically.', 'wp-bootstrap-4' ),
    'choices'  => array(
		'min'  => 25,
		'max'  => 200,
		'step' => 1,
	),
    'output'   => array(
        array(
			'element'  => '.custom-logo',
			'property' => 'max-height',
			'units'    => 'px',
		),
    )
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'logo_height_mobile',
	'label'    => esc_html__( 'Mobile Logo Height (in px)', 'wp-bootstrap-4' ),
	'section'  => 'title_tagline',
	'type'     => 'number',
	'priority' => 8,
	'default'  => 40,
    'tooltip'  => esc_html__( 'Minimum height 25px & maximum height 100px. Width will be adjusted automatically.', 'wp-bootstrap-4' ),
    'choices'  => array(
		'min'  => 20,
		'max'  => 100,
		'step' => 1,
	),
    'output'   => array(
        array(
			'element'  => '.custom-logo',
			'property' => 'max-height',
			'units'    => 'px',
			'media_query' => '@media (max-width:767px)',
		),
    )
) );


// Add a new section under the WooCommerce panel
WP_Bootstrap_4_Kirki::add_section( 'woocommerce_custom_section', array(
	'title'          => esc_html__( 'Custom WooCommerce Settings', 'wp-bootstrap-4' ),
	'description'    => esc_html__( 'Additional WooCommerce settings.', 'wp-bootstrap-4' ),
	'panel'          => 'woocommerce', // Assign to the WooCommerce panel
	'priority'       => 160, // Position in the panel
) );

// Example setting: Set the number of products per row
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'section'     => 'woocommerce_custom_section',
	'settings'    => 'grid_product_count',
	'label'       => esc_html__( 'Products Per Row', 'wp-bootstrap-4' ),
	'type'     => 'select',
	'default'  => 'col-md-6 col-lg-4 col-xl-3',
	'choices'     => [
		'col-12' => esc_html__( 'One Column', 'wp-bootstrap-4' ),
		'col-md-6 col-xl-6' => esc_html__( 'Two Columns', 'wp-bootstrap-4' ),
		'col-md-6 col-xl-4' => esc_html__( 'Three Colums', 'wp-bootstrap-4' ),
		'col-md-6 col-lg-4 col-xl-3' => esc_html__( 'Four Colums', 'wp-bootstrap-4' ),
		'col-6 col-sm-3 col-lg-2' => esc_html__( 'Six Colums', 'wp-bootstrap-4' ),
	],
) );



// Add settings
include( get_template_directory() . '/inc/theme-options/theme-colors.php' );
include( get_template_directory() . '/inc/theme-options/typography.php' );
include( get_template_directory() . '/inc/theme-options/layout.php' );
include( get_template_directory() . '/inc/theme-options/card-settings.php' );
include( get_template_directory() . '/inc/theme-options/global-layouts.php' );
include( get_template_directory() . '/inc/theme-options/blog-settings.php' );
include( get_template_directory() . '/inc/theme-options/frontpage-slider.php' );
include( get_template_directory() . '/inc/theme-options/footer-text.php' );

/**
* Styling Customizer
*/
function wp_bootstrap_4_customizer_css()
{
	if( class_exists( 'Kirki' ) ) {
		wp_enqueue_style( 'wp-bootstrap-4-customizer-css', get_template_directory_uri() . '/inc/theme-options/customizer.css' );
	}
}
add_action( 'customize_controls_print_styles', 'wp_bootstrap_4_customizer_css' );
