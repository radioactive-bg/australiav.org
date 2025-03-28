<?php

WP_Bootstrap_4_Kirki::add_section( 'card', array(
    'title'          => esc_html__( 'Card Settings', 'wp-bootstrap-4' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );


WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'card_spacing',
	'label'    => esc_html__( 'Card Body Spacing', 'wp-bootstrap-4' ),
	'description'	 => __( 'Mobile and Desktop', 'wp-bootstrap-4' ),
	'section'  => 'card',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'padding-left'    => '1.25rem',
		'padding-right' => '1.25rem',
		'padding-top'    => '2rem',
		'padding-bottom' => '2rem',
		'padding-left-lg'    => '2rem',
		'padding-right-lg' => '2rem',
		'padding-top-lg'    => '2rem',
		'padding-bottom-lg' => '2rem',
	),
	'choices'     => [
		'labels' => [
			'padding-left'  => esc_html__( 'mobile left', 'wp-bootstrap-4' ),
			'padding-right'  => esc_html__( 'mobile right', 'wp-bootstrap-4' ),
			'padding-top'  => esc_html__( 'mobile top', 'wp-bootstrap-4' ),
			'padding-bottom'  => esc_html__( 'mobile bottom', 'wp-bootstrap-4' ),

			'padding-left-lg'  => esc_html__( 'desktop left', 'wp-bootstrap-4' ),
			'padding-right-lg'  => esc_html__( 'desctop right', 'wp-bootstrap-4' ),
			'padding-top-lg'  => esc_html__( 'desktop top', 'wp-bootstrap-4' ),
			'padding-bottom-lg'  => esc_html__( 'desctop bottom', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'padding-left',
	      'element' => array( '.card-body' ),
	      'property'    => 'padding-left',
	    ),
	    array(
	      'choice'      => 'padding-right',
		  'element' => array( '.card-body' ),
	      'property'    => 'padding-right',
	    ),
		array(
			'choice'      => 'padding-top',
			'element' => array( '.card-body' ),
			'property'    => 'padding-top',
		 ),
		array(
			'choice'      => 'padding-bottom',
			'element' => array( '.card-body' ),
			'property'    => 'padding-bottom',
		),

		array(
			'choice'      => 'padding-left-lg',
			'element' => array( '.card-body' ),
			'property'    => 'padding-left',
			'units'    => 'rem',
			'media_query' => '@media (min-width:992px)',
		),
		array(
			'choice'      => 'padding-right-lg',
			'element' => array( '.card-body' ),
			'property'    => 'padding-right',
			'units'    => 'rem',
			'media_query' => '@media (min-width:992px)',
		),
		array(
			'choice'      => 'padding-top-lg',
			'element' => array( '.card-body' ),
			'property'    => 'padding-top',
			'units'    => 'rem',
			'media_query' => '@media (min-width:992px)',
		),
		array(
			'choice'      => 'padding-bottom-lg',
			'element' => array( '.card-body' ),
			'property'    => 'padding-bottom',
			'units'    => 'rem',
			'media_query' => '@media (min-width:992px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'card_background_color',
	'section'  => 'card',
	'type'     => 'color',
    'label' => esc_html__( 'Card Background Color', 'wp-bootstrap-4' ),
    'default'  => '#fff',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.card'),
			'property'    => 'background-color',
		),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'card_border_style',
	'label'    => esc_html__( 'Card Border Style', 'wp-bootstrap-4' ),
	'section'  => 'card',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'border-radius'    => '0.25rem',
		'border-width'    => '1px',
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
	      'element'     =>  array('.card' ),
	      'property'    => 'border-radius',
	    ),
		array(
			'choice'      => 'border-width',
			'element'     =>  array('.card' ),
			'property'    => 'border-width',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'card_border_color',
	'section'  => 'card',
	'type'     => 'color',
    'label' => esc_html__( 'Card Border Color', 'wp-bootstrap-4' ),
    'default'  => '#efeae6',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( '.card'),
			'property'    => 'border-color',
		),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'card_shadow_style',
	'label'    => esc_html__( 'Box Shadow Style', 'wp-bootstrap-4' ),
	'section'  => 'card',
	'type'     => 'text',
    'default'  => '0 .5rem 1rem rgba(0,0,0,.15)',
	'output'   => array(
        array(
			'element'  => array( '.card'),
			'property'    => 'box-shadow',
		),
      
    ),
) );
