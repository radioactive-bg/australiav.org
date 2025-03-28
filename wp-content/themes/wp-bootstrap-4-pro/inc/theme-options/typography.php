<?php

WP_Bootstrap_4_Kirki::add_section( 'typography', array(
    'title'          => esc_html__( 'Typography', 'wp-bootstrap-4' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

// Global
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'global_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<h2 class="">' . esc_html__( 'Global settings', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_html_font_size',
	'label'    => esc_html__( 'Html Responsive Font Sizes', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '16px',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('html' ),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('html' ),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('html' ),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
//body
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_body_typo',
	'section'  => 'typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Body Typography', 'wp-bootstrap-4' ),
    'default'     => array(
		'font-family'    => "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif",
		// 'font-size' => '1rem',
		'variant'        => '',
		'line-height'    => '1.5',
		'letter-spacing' => '0px',
		'subset'         => array( 'latin-ext' ),
		//'color'          => '#333333',
		//'text-align'     => 'left',
	),
	'choices'  => array(
		'variant' => array( '100', '200','300', 'regular', 'italic', '600', '700', '700italic', '800', '900' ),
	),
    'output'      => array(
		array(
			'element' => array( 'body', 'button', 'input', 'optgroup', 'select', 'textarea' ),
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_body_font_size',
	'label'    => esc_html__( 'Body Font Size', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '1rem',
		'font-size-lg'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-lg'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element' => array('body', 'button', 'input', 'optgroup', 'select', 'textarea'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-lg',
			'element' => array('body', 'button', 'input', 'optgroup', 'select', 'textarea'),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:992px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_lead_typo',
	'section'  => 'typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Lead Paragraph Typography', 'wp-bootstrap-4' ),
    'default'     => array(
		'font-family'    => '',
		'font-size' => '',
		'variant'        => '',
		'line-height'    => '1.5',
		'letter-spacing' => '0px',
	),
    'output'      => array(
		array(
			'element' => array( '.lead' ),
		),
	),
) );
// Havigation
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'nav_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Navigation settings', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_header_nav_typo',
	'section'  => 'typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Header Nav Typography', 'wp-bootstrap-4' ),
    'default'     => array(
		'font-family'    => 'inherit',
		'variant'        => '',
		'text-transform'      => '',
		'line-height'    => '1.5',
		'letter-spacing' => '0px',
	),
    'output'      => array(
		array(
			'element' => array('.site-header a.nav-link'),
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_header_nav_font_size',
	'label'    => esc_html__( 'Header Nav Font Size', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '1rem',
		'font-size-lg'    => '1rem',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile menu', 'wp-bootstrap-4' ),
			'font-size-lg'  => esc_html__( 'Desktop menu', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element' => array('.site-header a'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-lg',
			'element' => array('.site-header a'),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:992px)',
		),
	),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'footer_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Footer and Sidebar settings', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_footer_nav_typo',
	'section'  => 'typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Footer and Sidebar Nav Typography', 'wp-bootstrap-4' ),
    'default'     => array(
		'font-family'    => 'inherit',
		'variant'        => '',
		'text-transform'      => '',
		'line-height'    => '1.5',
		'letter-spacing' => '0px',
	),
    'output'      => array(
		array(
			'element' => array( '.site-footer a:not(.btn)', '.sidebar-area a'),
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_footer_nav_font_size',
	'label'    => esc_html__( 'Footer Font Size', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '1rem',
		'font-size-lg'    => '1rem',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile menu', 'wp-bootstrap-4' ),
			'font-size-lg'  => esc_html__( 'Desktop menu', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element' => array( '.site-footer', '.site-footer a:not(.btn)'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-lg',
			'element' => array('.site-footer', '.site-footer a:not(.btn)'),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:992px)',
		),
	),
) );
// Headings
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'heading_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Heading Settings', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_heading_typo',
	'section'  => 'typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Heading Typography', 'wp-bootstrap-4' ),
    'default'     => array(
		'font-family'    => 'inherit',
		'variant'        => '500',
		'line-height'    => '1.2',
		'letter-spacing' => '0px',
	),
    'output'      => array(
		array(
			'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ),
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_page_heading_font_size',
	'label'    => esc_html__( 'Page Heading Font Size (h1)', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('h1', '.h1'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('h1', '.h1'),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('h1', '.h1'),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_section_heading',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_section_heading_font_size',
	'label'    => esc_html__( 'Section Heading Font Size (h2.heading)', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'H2 tag with class heading.', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('h2.heading', '.h2.heading'),
	      'property'    => 'font-size',
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('h2.heading', '.h2.heading'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('h2.heading', '.h2.heading'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_h2_title',
	'description' => esc_html__( 'Title Tags Typography', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_h2_font_size',
	'label'    => esc_html__( 'H2', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 2rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('h2:not(.heading):not([class^="display-"]):not(.entry-title):not(.card-title), .h2'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('h2:not(.heading):not([class^="display-"]):not(.entry-title):not(.card-title), .h2'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('h2:not(.heading):not([class^="display-"]):not(.entry-title):not(.card-title), .h2'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_h3_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_h3_font_size',
	'label'    => esc_html__( 'H3', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 1.75rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('h3, .h3'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('h3, .h3'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('h3, .h3'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_h4_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_h4_font_size',
	'label'    => esc_html__( 'H4', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 1.5rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('h4, .h4'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('h4, .h4'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('h4, .h4'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_h5_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_h5_font_size',
	'label'    => esc_html__( 'H5', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 1.25rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('h5, .h5'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('h5, .h5'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('h5, .h5'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_h6_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_h6_font_size',
	'label'    => esc_html__( 'H6', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 1rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('h6, .h6'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('h6, .h6'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('h6, .h6'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_display-1_title',
	'description' => esc_html__( '', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/><h3>Extra Title Classes Typography</h3>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_display-1_font_size',
	'label'    => esc_html__( 'Display 1', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 6rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('.display-1'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('.display-1'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('.display-1'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_display-2_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_display-2_font_size',
	'label'    => esc_html__( 'Display 2', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 5.5rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('.display-2'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('.display-2'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('.display-2'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_display-3_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_display-3_font_size',
	'label'    => esc_html__( 'Display 3', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 4.5rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('.display-3'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('.display-3'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('.display-3'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_display-4_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_display-4_font_size',
	'label'    => esc_html__( 'Display 4', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Default is: 3.5rem', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('.display-4'),
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('.display-4'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('.display-4'),
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'divider_post_grid_heading',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_post_grid_heading_font_size',
	'label'    => esc_html__( 'Post Grid Heading Font Size in Pages', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'This will overwrite Blog Archive setting Font Size.', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '',
		'font-size-md'    => '',
		'font-size-xl'    => '',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Desktop', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  '.post-item h2.entry-title',
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  '.post-item h2.entry-title',
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  '.post-item h2.entry-title',
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
// Buttons
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'btn_title',
	'section'  => 'typography',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Button settings', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_btn_typo',
	'section'  => 'typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Button Typography', 'wp-bootstrap-4' ),
    'default'     => array(
		'font-family'    => 'inherit',
		'variant'        => '',
		'text-transform'      => '',
		'line-height'    => '1.5',
		'letter-spacing' => '0px',
		'font-size' => '1rem',
	),
    'output'      => array(
		array(
			'element' => array('.btn', '.button.add_to_cart_button', '.single_add_to_cart_button', '.checkout-button', '.button', 'button', '.wpcf7-submit', '.wp-block-search__button' ),
		),
	),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_btn_padding',
	'label'    => esc_html__( 'Button Spacing', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'padding-top'    => '0.6rem',
		'padding-bottom' => '0.6rem',
		'padding-left'   => '1.3rem',
		'padding-right'  => '1.3rem',
	),
	'choices'     => [
		'labels' => [
			'padding-top'  => esc_html__( 'top', 'wp-bootstrap-4' ),
			'padding-bottom'  => esc_html__( 'bottom', 'wp-bootstrap-4' ),
			'padding-left' => esc_html__( 'left', 'wp-bootstrap-4' ),
			'padding-right' => esc_html__( 'right', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'padding-top',
	      'element'     =>  array('.btn', '.button.add_to_cart_button', '.single_add_to_cart_button', '.checkout-button', '.button', 'button', '.wpcf7-submit', '.wp-block-search__button' ),
	      'property'    => 'padding-top',
	    ),
	    array(
	      'choice'      => 'padding-bottom',
	      'element'     => array('.btn', '.button.add_to_cart_button', '.single_add_to_cart_button', '.checkout-button', '.button', 'button', '.wpcf7-submit', '.wp-block-search__button' ),
	      'property'    => 'padding-bottom',
	    ),
	    array(
	      'choice'      => 'padding-left',
		  'element'     => array('.btn', '.button.add_to_cart_button', '.single_add_to_cart_button', '.checkout-button', '.button', 'button', '.wpcf7-submit', '.wp-block-search__button' ),
	      'property'    => 'padding-left',
	    ),
	    array(
	      'choice'      => 'padding-right',
		  'element'     => array('.btn', '.button.add_to_cart_button', '.single_add_to_cart_button', '.checkout-button', '.button', 'button', '.wpcf7-submit', '.wp-block-search__button' ),
	      'property'    => 'padding-right',
	    ),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_btn_border_style',
	'label'    => esc_html__( 'Button Style', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'border-radius'    => '0px',
		'border-width'    => '2px',
	),
	'choices'     => [
		'labels' => [
			'border-radius'  => esc_html__( 'border radius', 'wp-bootstrap-4' ),
			'border-width'  => esc_html__( 'border width', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'border-radius',
	      'element'     =>  array('.btn', '.button.add_to_cart_button', '.single_add_to_cart_button', '.checkout-button', '.button', 'button', '.wpcf7-submit' ),
	      'property'    => 'border-radius',
	    ),
		array(
			'choice'      => 'border-width',
			'element'     =>  array('.btn', '.button.add_to_cart_button', '.single_add_to_cart_button', '.checkout-button', '.button', 'button', '.wpcf7-submit' ),
			'property'    => 'border-width',
		),
	),
) );
// btn lg
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_btn_lg_typo',
	'section'  => 'typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Large Button', 'wp-bootstrap-4' ),
    'default'     => array(
		'font-size' => '1.15rem',
	),
    'output'      => array(
		array(
			'element' => array( '.btn-lg', '.btn-group-lg>.btn' ),
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_btn_lg_padding',
	'label'    => esc_html__( 'Button Spacing', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'padding-top'    => '0.8rem',
		'padding-bottom' => '0.8rem',
		'padding-left'   => '1.6rem',
		'padding-right'  => '1.6rem',
	),
	'choices'     => [
		'labels' => [
			'padding-top'  => esc_html__( 'top', 'wp-bootstrap-4' ),
			'padding-bottom'  => esc_html__( 'bottom', 'wp-bootstrap-4' ),
			'padding-left' => esc_html__( 'left', 'wp-bootstrap-4' ),
			'padding-right' => esc_html__( 'right', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'padding-top',
	      'element' => array( '.btn-lg', '.btn-group-lg>.btn' ),
	      'property'    => 'padding-top',
	    ),
	    array(
	      'choice'      => 'padding-bottom',
		  'element' => array( '.btn-lg', '.btn-group-lg>.btn' ),
	      'property'    => 'padding-bottom',
	    ),
	    array(
	      'choice'      => 'padding-left',
		  'element' => array( '.btn-lg', '.btn-group-lg>.btn' ),
	      'property'    => 'padding-left',
	    ),
	    array(
	      'choice'      => 'padding-right',
		  'element' => array( '.btn-lg', '.btn-group-lg>.btn' ),
	      'property'    => 'padding-right',
	    ),
	),
) );

// btn sm
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_btn_sm_typo',
	'section'  => 'typography',
	'type'     => 'typography',
    'label' => esc_html__( 'Small Button', 'wp-bootstrap-4' ),
    'default'     => array(
		'font-size' => '0.9rem',
	),
    'output'      => array(
		array(
			'element' => array( '.btn-sm', '.btn-group-sm>.btn' ),
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'wp_bp_btn_sm_padding',
	'label'    => esc_html__( 'Button Spacing', 'wp-bootstrap-4' ),
	'section'  => 'typography',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'padding-top'    => '0.5rem',
		'padding-bottom' => '0.5rem',
		'padding-left'   => '1rem',
		'padding-right'  => '1rem',
	),
	'choices'     => [
		'labels' => [
			'padding-top'  => esc_html__( 'top', 'wp-bootstrap-4' ),
			'padding-bottom'  => esc_html__( 'bottom', 'wp-bootstrap-4' ),
			'padding-left' => esc_html__( 'left', 'wp-bootstrap-4' ),
			'padding-right' => esc_html__( 'right', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'padding-top',
	      'element' => array( '.btn-sm', '.btn-group-sm>.btn' ),
	      'property'    => 'padding-top',
	    ),
	    array(
	      'choice'      => 'padding-bottom',
		  'element' => array( '.btn-sm', '.btn-group-sm>.btn' ),
	      'property'    => 'padding-bottom',
	    ),
	    array(
	      'choice'      => 'padding-left',
		  'element' => array( '.btn-sm', '.btn-group-sm>.btn' ),
	      'property'    => 'padding-left',
	    ),
	    array(
	      'choice'      => 'padding-right',
		  'element' => array( '.btn-sm', '.btn-group-sm>.btn' ),
	      'property'    => 'padding-right',
	    ),
	),
) );