<?php
$double_image =  get_field('double_image','options');
WP_Bootstrap_4_Kirki::add_section( 'global', array(
    'title'          => esc_html__( 'Global Layouts', 'wp-bootstrap-4' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );
// Cover Section
if ( class_exists( 'Kirki' ) ) {
    add_action( 'customize_register', 'wp_bootstrap_4_move_header_bg_image' );

    function wp_bootstrap_4_move_header_bg_image( $wp_customize ) {

        // 1) Move the built-in Header Image control to the "global" section
        if ( $wp_customize->get_control( 'header_image' ) ) {
            $wp_customize->get_control( 'header_image' )->section = 'global';
        }
        $wp_customize->add_setting(
			'header_image_mobile',
			array(
				'default'           => '',
				'type'              => 'theme_mod',         // or 'option'
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',            // see #2 below
				'capability'        => 'edit_theme_options' // default is fine, but good to specify
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'header_image_mobile_control', // This is just the control's ID
				array(
					'label'    => __( 'Mobile Hero Image', 'wp-bootstrap-4' ),
					'description' => __( 'Alternate image used on small screens.', 'wp-bootstrap-4' ),
					'section'  => 'global',
					'settings' => 'header_image_mobile',    // Must match the setting ID above
					'mime_type' => 'image',
				)
			)
		);

        /*
         * 2) Add a new background-color setting & control
         * ------------------------------------------------
         */
        $wp_customize->add_setting( 'header_bg_color', array(
            'default'           => '#ffffff00',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'header_bg_color',
            array(
                'label'    => __( 'Hero Background Color', 'wp-bootstrap-4' ),
                'section'  => 'global',              // place in the same “global” section
                'settings' => 'header_bg_color',
            )
        ) );
        /*
         * 3) Add background-repeat
         * ------------------------------------------------
         */
        $wp_customize->add_setting( 'header_bg_repeat', array(
            'default'           => 'no-repeat',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( 'header_bg_repeat', array(
            'label'    => __( 'Hero Background Repeat', 'wp-bootstrap-4' ),
            'type'     => 'select',
            'section'  => 'global',
            'choices'  => array(
                'no-repeat' => __( 'No Repeat', 'wp-bootstrap-4' ),
                'repeat'    => __( 'Repeat', 'wp-bootstrap-4' ),
                'repeat-x'  => __( 'Repeat Horizontally', 'wp-bootstrap-4' ),
                'repeat-y'  => __( 'Repeat Vertically', 'wp-bootstrap-4' ),
            ),
        ) );
        /*
         * 4) Add background-attachment
         * ------------------------------------------------
         */
        $wp_customize->add_setting( 'header_bg_attachment', array(
            'default'           => 'scroll',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( 'header_bg_attachment', array(
            'label'    => __( 'Hero Background Attachment', 'wp-bootstrap-4' ),
            'type'     => 'select',
            'section'  => 'global',
            'choices'  => array(
                'scroll' => __( 'Scroll', 'wp-bootstrap-4' ),
                'fixed'  => __( 'Fixed', 'wp-bootstrap-4' ),
            ),
        ) );
		 // A dummy setting that doesn't save anything
		$wp_customize->add_setting( 'global_separator_1', [
			'sanitize_callback' => 'wp_filter_nohtml_kses', // or '__return_empty_string'
		] );

		// A control that outputs a line as a description
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'global_separator_1',
			[
				'label'       => '', // no label
				'description' => '<hr style="margin: 1rem 0;">', // or any HTML you want
				'section'     => 'global',
				'settings'    => 'global_separator_1',
				'type'        => 'hidden', // or 'text', but 'hidden' is fine since we won't show an input
			]
		) );
        /*
         * 5) Add background-size
         * ------------------------------------------------
         */
        $wp_customize->add_setting( 'header_bg_size', array(
            'default'           => 'cover',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( 'header_bg_size', array(
            'label'    => __( 'Hero Background Size', 'wp-bootstrap-4' ),
			'description' => __( 'All Devices: Mobile and Large Screens', 'wp-bootstrap-4' ),
            'type'     => 'select',
            'section'  => 'global',
            'choices'  => array(
                'auto'    => __( 'Auto', 'wp-bootstrap-4' ),
                'cover'   => __( 'Cover', 'wp-bootstrap-4' ),
                'contain' => __( 'Contain', 'wp-bootstrap-4' ),
				'custom'  => __( 'Custom (enter your own)', 'wp-bootstrap-4' ),
            ),
        ) );
        // The custom text field
		$wp_customize->add_setting( 'header_bg_size_custom', [
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( 'header_bg_size_custom', [
			'label'       => __( 'Custom Size', 'wp-bootstrap-4' ),
			'description' => __( 'e.g. "30px 50px", "100% auto", etc.', 'wp-bootstrap-4' ),
			'type'        => 'text',
			'section'     => 'global',
			'active_callback' => function () {
				return ( get_theme_mod( 'header_bg_size' ) === 'custom' );
			},
		] );
		// ----------------------------------------------
		// 6) New background-size for Large devices
		// ----------------------------------------------
		$wp_customize->add_setting( 'header_bg_size_large', array(
			'default'           => 'use_all_devices', // so by default it doesn't override anything
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'header_bg_size_large', array(
			'label'    => __( 'Large Devices', 'wp-bootstrap-4' ),
			'description' => __( 'Only for Large Screens', 'wp-bootstrap-4' ),
			'type'     => 'select',
			'section'  => 'global',
			'choices'  => array(
				'use_all_devices' => __( 'Nothing selected: Use as all devices', 'wp-bootstrap-4' ), // <--- new option
				'auto'    => __( 'Auto', 'wp-bootstrap-4' ),
				'cover'   => __( 'Cover', 'wp-bootstrap-4' ),
				'contain' => __( 'Contain', 'wp-bootstrap-4' ),
				'custom'  => __( 'Custom (enter your own)', 'wp-bootstrap-4' ),
			),
		) );

		// The custom text field
		$wp_customize->add_setting( 'header_bg_size_custom_large', [
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( 'header_bg_size_custom_large', [
			'label'         => __( 'Custom Size (Large Devices)', 'wp-bootstrap-4' ),
			'description'   => __( 'e.g. "30px 50px", "100% auto", etc.', 'wp-bootstrap-4' ),
			'type'          => 'text',
			'section'       => 'global',
			'active_callback' => function () {
				return ( get_theme_mod( 'header_bg_size_large' ) === 'custom' );
			},
		] );
        // A dummy setting that doesn't save anything
		$wp_customize->add_setting( 'global_separator_2', [
			'sanitize_callback' => 'wp_filter_nohtml_kses', // or '__return_empty_string'
		] );

		// A control that outputs a line as a description
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'global_separator_2',
			[
				'label'       => '', // no label
				'description' => '<hr style="margin: 1rem 0;">', // or any HTML you want
				'section'     => 'global',
				'settings'    => 'global_separator_2',
				'type'        => 'hidden', // or 'text', but 'hidden' is fine since we won't show an input
			]
		) );
        /*
         * 7) Add background-position All devices
         * ------------------------------------------------
         */
        $wp_customize->add_setting( 'header_bg_position', array(
            'default'           => 'left top',
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( 'header_bg_position', array(
            'label'    => __( 'Hero Background Position', 'wp-bootstrap-4' ),
			'description' => __( 'All Devices: Mobile and Large Screens', 'wp-bootstrap-4' ),
            'type'     => 'select',
            'section'  => 'global',
            'choices'  => array(
                'left top'      => __( 'Left Top', 'wp-bootstrap-4' ),
                'left center'   => __( 'Left Center', 'wp-bootstrap-4' ),
                'left bottom'   => __( 'Left Bottom', 'wp-bootstrap-4' ),
                'center top'    => __( 'Center Top', 'wp-bootstrap-4' ),
                'center center' => __( 'Center Center', 'wp-bootstrap-4' ),
                'center bottom' => __( 'Center Bottom', 'wp-bootstrap-4' ),
                'right top'     => __( 'Right Top', 'wp-bootstrap-4' ),
                'right center'  => __( 'Right Center', 'wp-bootstrap-4' ),
                'right bottom'  => __( 'Right Bottom', 'wp-bootstrap-4' ),
				'custom'        => __( 'Custom (enter your own)', 'wp-bootstrap-4' ),
            ),
        ) );
		// The custom text field
		$wp_customize->add_setting( 'header_bg_position_custom', [
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		// Create a text control that only appears if "custom" is chosen
		$wp_customize->add_control( 'header_bg_position_custom', [
			'label'         => __( 'Custom Position', 'wp-bootstrap-4' ),
			'description'   => __( 'e.g. "30% 70%", "10em 2rem", etc.', 'wp-bootstrap-4' ),
			'type'          => 'text',
			'section'       => 'global',
			'active_callback' => function () {
				return ( get_theme_mod( 'header_bg_position' ) === 'custom' );
			},
		] );
		// ----------------------------------------------
		// 8) New background-position for large devices
		// ----------------------------------------------
		$wp_customize->add_setting( 'header_bg_position_large', array(
			'default'           => 'use_all_devices', // so by default it doesn't override anything
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'header_bg_position_large', array(
			'label'    => __( 'Large Devices', 'wp-bootstrap-4' ),
			'description' => __( 'Only for Large Screens', 'wp-bootstrap-4' ),
			'type'     => 'select',
			'section'  => 'global',
			'choices'  => array(
				'use_all_devices' => __( 'Nothing selected: Use as all devices', 'wp-bootstrap-4' ), // <--- new option
				'left top'      => __( 'Left Top', 'wp-bootstrap-4' ),
				'left center'   => __( 'Left Center', 'wp-bootstrap-4' ),
				'left bottom'   => __( 'Left Bottom', 'wp-bootstrap-4' ),
				'center top'    => __( 'Center Top', 'wp-bootstrap-4' ),
				'center center' => __( 'Center Center', 'wp-bootstrap-4' ),
				'center bottom' => __( 'Center Bottom', 'wp-bootstrap-4' ),
				'right top'     => __( 'Right Top', 'wp-bootstrap-4' ),
				'right center'  => __( 'Right Center', 'wp-bootstrap-4' ),
				'right bottom'  => __( 'Right Bottom', 'wp-bootstrap-4' ),
				'custom'          => __( 'Custom (enter your own)', 'wp-bootstrap-4' ),
			),
		) );
		// The custom text field
		$wp_customize->add_setting( 'header_bg_position_custom_large', [
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		] );

		$wp_customize->add_control( 'header_bg_position_custom_large', [
			'label'         => __( 'Custom Position (Large)', 'wp-bootstrap-4' ),
			'description'   => __( 'e.g. "20% 80%", etc.', 'wp-bootstrap-4' ),
			'type'          => 'text',
			'section'       => 'global',
			'active_callback' => function () {
				return ( get_theme_mod( 'header_bg_position_large' ) === 'custom' );
			},
		] );
		// A dummy setting that doesn't save anything
		$wp_customize->add_setting( 'global_separator_3', [
			'sanitize_callback' => 'wp_filter_nohtml_kses', // or '__return_empty_string'
		] );

		// A control that outputs a line as a description
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'global_separator_3',
			[
				'label'       => '', // no label
				'description' => '<hr style="margin: 1rem 0;">', // or any HTML you want
				'section'     => 'global',
				'settings'    => 'global_separator_3',
				'type'        => 'hidden', // or 'text', but 'hidden' is fine since we won't show an input
			]
		) );
		// ----------------------------------------------
		// 9) Add a setting for the device breakpoint
		// ----------------------------------------------
		$wp_customize->add_setting( 'header_bg_media_breakpoint', [
			'default'           => '992',      // default to "Large"
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',    // or 'intval' – storing numeric strings like "576", "768", etc.
		] );

		// Add a select control for the breakpoint
		$wp_customize->add_control( 'header_bg_media_breakpoint', [
			'label'    => __( 'Choose Media Device Breakpoint', 'wp-bootstrap-4' ),
			'description' => __( 'Media query used to define Large screen.', 'wp-bootstrap-4' ),
			'section'  => 'global',
			'type'     => 'select',
			'choices'  => [
				'576'  => __( 'Small: ≥576px', 'wp-bootstrap-4' ),
				'768'  => __( 'Medium: ≥768px', 'wp-bootstrap-4' ),
				'992'  => __( 'Large: ≥992px', 'wp-bootstrap-4' ),
				'1200' => __( 'Extra Large: ≥1200px', 'wp-bootstrap-4' ),
			],
		]);
    }
}
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'paralax_divider',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_as_parallax',
	'label'    => esc_html__( 'Background image as parallax', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'checkbox',
    'default'  => 0,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_as_parallax_data_depth',
	'label'    => esc_html__( 'Paralax Depth', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'slider',
	'default'  => 0.3,
    'tooltip'  => esc_html__( 'Add value on background depth. On this value depends speed how background will move. Negative value also allowed.', 'wp-bootstrap-4' ),
    'choices'  => array(
		'min'  => -3,
		'max'  => 3,
		'step' => 0.1,
	),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cover_title',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Hero Cover Section Extra Setup', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_section_height',
	'label'    => esc_html__( 'Hero Section Height', 'wp-bootstrap-4' ),
	'tooltip'  => esc_html__( 'Min height of section. Max is 100vh (viewport height)', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'slider',
	'default'  => 96,
		'choices'  => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_center_content',
	'label'    => esc_html__( 'Center Align Content', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'checkbox',
    'default'  => 1,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_content_width',
	'label'    => esc_html__( 'Max Width of Content', 'wp-bootstrap-4' ),
	'tooltip'  => esc_html__( 'Width of Hero content', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'slider',
	'default'  => 1920,
		'choices'  => [
			'min'  => 0,
			'max'  => 1920,
			'step' => 10,
		],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cta_divider_content',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_title',
	'label'    => esc_html__( 'Cover Title', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => get_bloginfo( 'name' ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_title_color',
	'label'    => esc_html__( 'Cover Title Color', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'select',
    'default'  => 'text-primary',
	'choices'     => [
		'text-primary' => esc_html__( 'Primary color', 'wp-bootstrap-4' ),
		'text-secondary' => esc_html__( 'Secondary color', 'wp-bootstrap-4' ),
		'text-dark' => esc_html__( 'Dark color', 'wp-bootstrap-4' ),
		'text-light' => esc_html__( 'Light color', 'wp-bootstrap-4' ),
		'text-white' => esc_html__( 'White color', 'wp-bootstrap-4' ),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_title_size',
	'label'    => esc_html__( 'Cover Title responsive font size', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '2.5rem',
		'font-size-md'    => '3rem',
		'font-size-xl'    => '3.5rem',
	),
	'choices'     => [
		'labels' => [
			'font-size'  => esc_html__( 'Mobile first', 'wp-bootstrap-4' ),
			'font-size-md'  => esc_html__( 'Tablet > 992px', 'wp-bootstrap-4' ),
			'font-size-xl'  => esc_html__( 'Screen > 1200px', 'wp-bootstrap-4' ),
		],
		'accept_unitless' => true,
	],
	'output'      => array(
		array(
	      'choice'      => 'font-size',
	      'element'     =>  array('.jumbotron-heading' ),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('.jumbotron-heading' ),
			'property'    => 'font-size',
			'units'    => 'rem',
			'media_query' => '@media (min-width:768px) and (max-width:1199px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('.jumbotron-heading' ),
			'property'    => 'font-size',
			'units'    => 'rem',
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cta_divider_title',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_label',
	'label'    => esc_html__( 'Cover Label', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cta_divider_label',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_lead',
	'label'    => esc_html__( 'Cover Lead Paragraph', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => get_bloginfo( 'description' ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_lead_color',
	'label'    => esc_html__( 'Cover Lead Color', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'select',
    'default'  => 'text-white',
	'choices'     => [
		'text-primary' => esc_html__( 'Primary color', 'wp-bootstrap-4' ),
		'text-secondary' => esc_html__( 'Secondary color', 'wp-bootstrap-4' ),
		'text-dark' => esc_html__( 'Dark color', 'wp-bootstrap-4' ),
		'text-light' => esc_html__( 'Light color', 'wp-bootstrap-4' ),
		'text-white' => esc_html__( 'White color', 'wp-bootstrap-4' ),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cta_divider_lead',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_shortcode',
	'label'    => esc_html__( 'Cover Shortcode', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  =>  '',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cta_divider_shortcode',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_btn_text',
	'label'    => esc_html__( 'Cover Button Text', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_btn_link',
	'label'    => esc_html__( 'Cover Button Link', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_btn_link_title_attr',
	'label'    => esc_html__( 'Cover Button Link Title Attribute', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) ); 
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_btn_style_classes',
	'label'    => esc_html__( 'Cover Button Style Classes', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => 'btn-primary btn-lg',
) ); 
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'    => 'front_cover_btn_img',
	'label'       => esc_html__( 'Cover Button Image', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Add icon for button', 'wp-bootstrap-4' ),
	'section'     => 'global',
	'type'     => 'image',
	'default'     => '',
	'choices'     => [
		'save_as' => 'url',
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_btn_img_width',
	'label'    => esc_html__( 'Cover Button Image width', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'slider',
	'default'  => 30,
    'tooltip'  => esc_html__( 'Minimum height 0px & maximum height 100px.', 'wp-bootstrap-4' ),
    'choices'  => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
    'output'   => array(
        array(
			'property' => 'width',
			'units'    => 'px',
		),
    )
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cta_divider_buttons',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_second_btn_text',
	'label'    => esc_html__( 'Cover Second Button Text', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_second_btn_link',
	'label'    => esc_html__( 'Cover Second Button Link', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_second_btn_link_title_attr',
	'label'    => esc_html__( 'Cover Second Button Link Title Attribute', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) ); 
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_second_btn_style_classes',
	'label'    => esc_html__( 'Cover Second Button Style Classes', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => 'btn-outline-primary btn-lg',
) ); 
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'    => 'front_cover_second_btn_img',
	'label'       => esc_html__( 'Cover Second Button Image', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Add icon for second button', 'wp-bootstrap-4' ),
	'section'     => 'global',
	'type'     => 'image',
	'default'     => '',
	'choices'     => [
		'save_as' => 'url',
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cover_second_btn_img_width',
	'label'    => esc_html__( 'Cover Second Button Image width', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'slider',
	'default'  => 30,
    'tooltip'  => esc_html__( 'Minimum height 0px & maximum height 100px.', 'wp-bootstrap-4' ),
    'choices'  => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
    'output'   => array(
        array(
			'property' => 'width',
			'units'    => 'px',
		),
    )
) );

// Featured Section
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'featured_title',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'Featured Section', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'show_featured_section',
	'label'    => esc_html__( 'Show this section', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'checkbox',
    'default'  => 1,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'featured_page_1',
	'label'    => esc_html__( '1st Featured Page', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'dropdown-pages',
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'featured_page_2',
	'label'    => esc_html__( '2nd Featured Page', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'dropdown-pages',
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'featured_page_3',
	'label'    => esc_html__( '3rd Featured Page', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'dropdown-pages',
) );

// Global CTA
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cta_title',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/><h2 class="">' . esc_html__( 'CTA Global Section', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_center_content',
	'label'    => esc_html__( 'Center Align CTA Content', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'checkbox',
    'default'  => 1,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_title',
	'label'    => esc_html__( 'CTA Global Title', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => get_bloginfo( 'name' ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_label',
	'label'    => esc_html__( 'CTA Global Label', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_lead',
	'label'    => esc_html__( 'CTA Global Lead Paragraph', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => get_bloginfo( 'description' ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_shortcode',
	'label'    => esc_html__( 'CTA Shortcode', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  =>  '',
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_btn_text',
	'label'    => esc_html__( 'CTA Global Button Text', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_btn_link',
	'label'    => esc_html__( 'CTA Global Button Link', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) ); 
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_btn_link_title_attr',
	'label'    => esc_html__( 'CTA Global Button Link Title Attribute', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => '',
) ); 
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_btn_style_classes',
	'label'    => esc_html__( 'CTA Global Button Style Classes', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'text',
    'default'  => 'btn-primary btn-lg',
) ); 

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'type'			 => 'background',
	'settings'		 => 'cta_background_setting',
	'label'			 => __( 'CTA Background', 'wp-bootstrap-4' ),
	'description'	 => __( 'Background for Global CTA layout.', 'wp-bootstrap-4' ),
	'section'		 => 'global',
	'default'     => array(
		'background-color'    => '#ffffff',
		'background-image'    => '',
		'background-repeat'   => 'no-repeat',
		'background-size'     => 'cover',
		'background-attachment'   => 'scroll',
		'background-position' => 'left-top',
		'background-opacity'  => 90,
	),
	'priority'		 => 10,
	//'output'		 => '.cta-global-section',
	'output'   => false,
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_as_parallax',
	'label'    => esc_html__( 'Background image as parallax', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'checkbox',
    'default'  => 0,
) );

if($double_image == true) { 
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_double_image_effect',
	'label'    => esc_html__( 'Add Double Image Hover Effects on Background', 'wp-bootstrap-4' ),
	'description'	 => __( 'Depend of Background image as parallax is checked. Also if double image effect is turned to on from ACF global Theme Settings', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'checkbox',
    'default'  => 0,
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'front_cta_double_image_effect_style',
	'label'    => esc_html__( 'Double Image Hover Effect Styles', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Choose effect style', 'wp-bootstrap-4' ),
	'section'  => 'global',
	'type'     => 'select',
	'default'  => '10',
	'choices'     => [
		'1' => esc_html__( 'Effect 1', 'wp-bootstrap-4' ),
		'2' => esc_html__( 'Effect 2', 'wp-bootstrap-4' ),
		'3' => esc_html__( 'Effect 3', 'wp-bootstrap-4' ),
		'4' => esc_html__( 'Effect 4', 'wp-bootstrap-4' ),
		'5' => esc_html__( 'Effect 5', 'wp-bootstrap-4' ),
		'6' => esc_html__( 'Effect 6', 'wp-bootstrap-4' ),
		'7' => esc_html__( 'Effect 7', 'wp-bootstrap-4' ),
		'8' => esc_html__( 'Effect 8', 'wp-bootstrap-4' ),
		'9' => esc_html__( 'Effect 9', 'wp-bootstrap-4' ),
		'10' => esc_html__( 'Effect 10', 'wp-bootstrap-4' ),
		'11' => esc_html__( 'Effect 11', 'wp-bootstrap-4' ),
	],
) );
}
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'cta_divider_end',
	'section'  => 'global',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
// End Global CTA

