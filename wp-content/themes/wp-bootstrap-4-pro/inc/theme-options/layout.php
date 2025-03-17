<?php

WP_Bootstrap_4_Kirki::add_section( 'layout', array(
    'title'          => esc_html__( 'Layout Settings', 'wp-bootstrap-4' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'container_width',
	'label'    => esc_html__( 'Container Max Width (in px)', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'transport' => 'refresh',
	'type'     => 'slider',
    'default'  => 1140,
	'choices'  => array(
		'min'  => '960',
		'max'  => '1900',
		'step' => '10',
	),
    'output' => array(
		array(
			'element'  => '.container',
			'property' => 'max-width',
			'units'    => 'px',
			'media_query' => '@media (min-width:'.WP_Bootstrap_4_Kirki::get_option( 'container_width' ).'px)'
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'narrow_container_width',
	'label'    => esc_html__( 'Narrow Container Max Width (in px)', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'transport' => 'refresh',
	'type'     => 'slider',
    'default'  => 960,
	'choices'  => array(
		'min'  => '600',
		'max'  => '1600',
		'step' => '10',
	),
    'output' => array(
		array(
			'element'  => array( '.container.narrow-container', '.narrow-container', '.section-desc'),
			'property' => 'max-width',
			'units'    => 'px',
			'media_query' => '@media (min-width:'.Kirki::get_option( 'narrow_container_width' ).'px)'
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'single_post_container_width',
	'label'    => esc_html__( 'Single Post Container Max Width (in px)', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'transport' => 'refresh',
	'type'     => 'slider',
    'default'  => 1140,
	'choices'  => array(
		'min'  => '960',
		'max'  => '1900',
		'step' => '10',
	),
    'output' => array(
		array(
			'element'  => '.single-post .site-content>.container',
			'property' => 'max-width',
			'units'    => 'px',
			'media_query' => '@media (min-width:'.WP_Bootstrap_4_Kirki::get_option( 'container_width' ).'px)'
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'container_extra_gutter',
	'section'  => 'layout',
	'type'        => 'dimension',
	'transport' => 'refresh',
    'label' => esc_html__( 'Container gutter: Horizontal extra space', 'wp-bootstrap-4' ),
    'default'     => '0px',
	'accept_unitless' => true,
	'choices'     => [
		'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'section_gutter_title',
	'section'  => 'layout',
	'type'     => 'custom',
    'default'  => '<hr/>',
	'description'  => esc_html__( 'Container gutter: offset container gutter. Useful to have more space on mobile devices"', 'wp-bootstrap-4' ),
) );
// Section Gutter
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'section_gutter_sizes',
	'label'    => esc_html__( 'Section gutter: Verical Sizes', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'padding-top'    => '4rem',
		'padding-bottom' => '4rem',
		'padding-top-lg'    => '6rem',
		'padding-bottom-lg' => '6rem',
	),
	'choices'     => [
		'labels' => [
			'padding-top'  => esc_html__( 'mobile top', 'wp-bootstrap-4' ),
			'padding-bottom'  => esc_html__( 'mobile bottom', 'wp-bootstrap-4' ),
			'padding-top-lg'  => esc_html__( 'desktop top', 'wp-bootstrap-4' ),
			'padding-bottom-lg'  => esc_html__( 'desctop bottom', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'padding-top',
	      'element' => array( '.section-gutter' ),
	      'property'    => 'padding-top',
		  'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	    ),
	    array(
	      'choice'      => 'padding-bottom',
		  'element' => array( '.section-gutter' ),
	      'property'    => 'padding-bottom',
		  'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	    ),
		array(
			'choice'      => 'padding-top-lg',
			'element' => array( '.section-gutter' ),
			'property'    => 'padding-top',
			'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
			'media_query' => '@media (min-width:992px)',
		  ),
		  array(
			'choice'      => 'padding-bottom-lg',
			'element' => array( '.section-gutter' ),
			'property'    => 'padding-bottom',
			'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
			'media_query' => '@media (min-width:992px)',
		  ),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'spacing_title_row',
	'section'  => 'layout',
	'type'     => 'custom',
    'default'  => '<hr/>',
	'description'  => esc_html__( 'Use units such as: "rem, px, vh, vw, % and etc"', 'wp-bootstrap-4' ),
	
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'row_gutter_x',
	'section'  => 'layout',
	'type'        => 'dimension',
	'transport' => 'refresh',
    'label' => esc_html__( 'Row gutter: Horizontal space between columns', 'wp-bootstrap-4' ),
    'default'     => '15px',
	'accept_unitless' => true,
	'choices'     => [
		'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'spacing_title',
	'section'  => 'layout',
	'type'     => 'custom',
    'default'  => '<hr/><h3 class="">' . esc_html__( 'Spacing Values', 'wp-bootstrap-4' ) . '</h3>',
	'description'  => esc_html__( 'Use units such as: "rem, px"', 'wp-bootstrap-4' ),
	
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'spacer-1',
	'section'  => 'layout',
	'type'        => 'dimension',
	'transport' => 'refresh',
    'label' => esc_html__( 'Spacer size 1', 'wp-bootstrap-4' ),
    'default'     => '0.25rem',
	'accept_unitless' => true,
	'choices'     => [
		'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'spacer-2',
	'section'  => 'layout',
	'type'        => 'dimension',
	'transport' => 'refresh',
    'label' => esc_html__( 'Spacer size 2', 'wp-bootstrap-4' ),
    'default'     => '0.5rem',
	'accept_unitless' => true,
	'choices'     => [
		'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'spacer-3',
	'section'  => 'layout',
	'type'        => 'dimension',
	'transport' => 'refresh',
    'label' => esc_html__( 'Spacer size 3', 'wp-bootstrap-4' ),
    'default'     => '1rem',
	'accept_unitless' => true,
	'choices'     => [
		'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'spacer-4',
	'section'  => 'layout',
	'type'        => 'dimension',
	'transport' => 'refresh',
    'label' => esc_html__( 'Spacer size 4', 'wp-bootstrap-4' ),
    'default'     => '1.5rem',
	'accept_unitless' => true,
	'choices'     => [
		'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'spacer-5',
	'section'  => 'layout',
	'type'        => 'dimension',
	'transport' => 'refresh',
    'label' => esc_html__( 'Spacer size 5', 'wp-bootstrap-4' ),
    'default'     => '3rem',
	'accept_unitless' => true,
	'choices'     => [
		'units'    => array('rem', 'em', 'px', 'vh', 'vw', '%'),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'headers_title',
	'section'  => 'layout',
	'type'     => 'custom',
	'description'  => esc_html__( 'Use to set values for margin, padding and gutter as classes', 'wp-bootstrap-4' ),
    'default'  => '<hr/><h3 class="">' . esc_html__( 'Header and Page head Settings', 'wp-bootstrap-4' ) . '</h3>',
) );
// Header Content Width
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'header_within_container',
	'label'    => esc_html__( 'Header Content Within Container', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'checkbox',
    'default'  => 0,
) );

// Transparent header
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'trans_header',
	'label'    => esc_html__( 'Transparent Header', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'checkbox',
    'default'  => 1,
) );

// Sticky header
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'sticky_header',
	'label'    => esc_html__( 'Sticky Header', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'checkbox',
    'default'  => 0,
    'tooltip'  => esc_html__( 'Some browsers may be outdated to support this feature.', 'wp-bootstrap-4' ),
) );
// Sticky header
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'with_nav',
	'label'    => esc_html__( 'With navigation', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'checkbox',
    'default'  => 1,
    'tooltip'  => esc_html__( 'Use for landing pages without navigation', 'wp-bootstrap-4' ),
) );

// Full Width Page Title Position
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'center_page_header',
	'label'    => esc_html__( 'Center Position of Page and Single Post Title', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'checkbox',
    'default'  => 1,
) );

// Default Sidebar Position
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'default_sidebar_position',
	'label'    => esc_html__( 'Default Sidebar Position', 'wp-bootstrap-4' ),
    'tooltip'  => esc_html__( 'This can be overwritten on the particular page by using a page template.', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'radio',
    'default'  => 'right',
    'choices'  => array(
        'right' => esc_html__( 'Right', 'wp-bootstrap-4' ),
        'left'  => esc_html__( 'Left', 'wp-bootstrap-4' ),
        'no'    => esc_html__( 'No Sidebar', 'wp-bootstrap-4' ),
    )
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'hide_sidebar_on_mobile',
	'label'    => esc_html__( 'Hide Sidebar On Mobile', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'radio',
    'default'  => 'no',
    'choices' => array(
        'no'  => esc_html__( 'No.', 'wp-bootstrap-4' ),
        'yes'  => esc_html__( 'Yes, hide sidebar on small devices.', 'wp-bootstrap-4' ),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'default_sidebar_position',
            'operator' => '!==',
            'value'    => 'no',
        ),
    ),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'scrollspy_title',
	'section'  => 'layout',
	'type'     => 'custom',
    'default'  => '<hr/><h3 class="">' . esc_html__( 'One Page Website', 'wp-bootstrap-4' ) . '</h3>',
) );
// Scrollspy
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'scrollspy',
	'label'    => esc_html__( 'Scrollspy (Header must be sticky.)', 'wp-bootstrap-4' ),
	'tooltip'  => esc_html__( 'Useful for one page website. Header must be sticky', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'checkbox',
    'default'  => 0,
) );

// Scrollspy data offset
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'data_offset',
	'label'    => esc_html__( 'Scrollspy data-offset', 'wp-bootstrap-4' ),
	'tooltip'  => esc_html__( 'Must be header height', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'              => 'number',
    'default'  => 0,
	'choices'  => [
			'min'  => 0,
			'max'  => 500,
			'step' => 10,
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'on_top_title',
	'section'  => 'layout',
	'type'     => 'custom',
    'default'  => '<hr/><h3 class="">' . esc_html__( 'On Top', 'wp-bootstrap-4' ) . '</h3>',
) );
// On top Button
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'on_top',
	'label'    => esc_html__( 'On top Button', 'wp-bootstrap-4' ),
	'section'  => 'layout',
	'type'     => 'checkbox',
    'default'  => 0,
    'tooltip'  => esc_html__( 'On top of page button', 'wp-bootstrap-4' ),
) );



