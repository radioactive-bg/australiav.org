<?php

WP_Bootstrap_4_Kirki::add_section( 'footer_text', array(
    'title'          => esc_html__( 'Footer Copyright', 'wp-bootstrap-4' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );


WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'          => 'footer_text',
	'label'             => esc_html__( 'Footer Copyright text', 'wp-bootstrap-4' ),
	'section'           => 'footer_text',
	'type'              => 'text',
    'default'           => wp_kses_post( __( 'Website 2022 © All Rights Reserved', 'wp-bootstrap-4' ) ),
    'sanitize_callback' => 'wp_kses_post',
) );
