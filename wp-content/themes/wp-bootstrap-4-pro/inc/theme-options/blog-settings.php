<?php

WP_Bootstrap_4_Kirki::add_section( 'blog_settings', array(
    'title'          => esc_html__( 'Blog Settings', 'wp-bootstrap-4' ),
    'panel'          => 'theme_options',
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_settings_title_1',
	'section'  => 'blog_settings',
	'type'     => 'custom',
    'default'  => '<h2 class="region-title first-region-title">' . esc_html__( 'Blog Cover Section', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_display_cover_section',
	'label'    => esc_html__( 'Display Cover Section', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'checkbox',
    'default'  => 1,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'          => 'blog_cover_title',
	'label'             => esc_html__( 'Cover Title', 'wp-bootstrap-4' ),
	'section'           => 'blog_settings',
	'type'              => 'text',
    'sanitize_callback' => 'wp_kses_post',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'          => 'blog_cover_lead',
	'label'             => esc_html__( 'Cover Lead Text', 'wp-bootstrap-4' ),
	'section'           => 'blog_settings',
	'type'              => 'text',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'          => 'blog_cover_btn_text',
	'label'             => esc_html__( 'Cover Button Text', 'wp-bootstrap-4' ),
	'section'           => 'blog_settings',
	'type'              => 'text',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'          => 'blog_cover_btn_link',
	'label'             => esc_html__( 'Cover Button Link', 'wp-bootstrap-4' ),
	'section'           => 'blog_settings',
	'type'              => 'text',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'type'			 => 'background',
	'settings'		 => 'blog_cover_background_setting',
	'label'			 => __( 'Blog cover Background', 'wp-bootstrap-4' ),
	'description'	 => __( 'Background for Blog Cover layout.', 'wp-bootstrap-4' ),
	'section'		 => 'blog_settings',
	'default'     => array(
		'background-color'    => '#ffffff',
		'background-image'    => '',
		'background-repeat'   => 'no-repeat',
		'background-size'     => 'cover',
		'background-attach'   => 'scroll',
		'background-position' => 'left-top',
		'background-opacity'  => 100,
	),
	'priority'		 => 10,
	'output'		 => '.blog-full-page-header',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_display_tags',
	'label'    => esc_html__( 'Display Tags as Banners in Cover Section', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'checkbox',
    'default'  => 0,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_display_categories',
	'label'    => esc_html__( 'Display Categories as Banners in Cover Section', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'checkbox',
    'default'  => 0,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_settings_title_2',
	'section'  => 'blog_settings',
	'type'     => 'custom',
    'default'  => '<hr/><h2>' . esc_html__( 'Blog Grid Settings', 'wp-bootstrap-4' ) . '</h2>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'grid_count',
	'label'    => esc_html__( 'Number of Posts in Grid per Row.', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Choose Grid View for The Blog and Archive Pages.', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'select',
	'default'  => 'col-md-6 col-xl-6',
	'choices'     => [
		'' => esc_html__( 'One Column', 'wp-bootstrap-4' ),
		'col-md-6 col-xl-6' => esc_html__( 'Two Columns', 'wp-bootstrap-4' ),
		'col-md-6 col-xl-4' => esc_html__( 'Three Colums', 'wp-bootstrap-4' ),
		'col-md-6 col-xl-3' => esc_html__( 'Four Colums', 'wp-bootstrap-4' ),
	],
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_height',
	'label'    => esc_html__( 'Responsive Image Height (in %)', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'slider',
    'default'  => 56,
	'choices'  => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
    'output' => array(
		array(
			'element'  => array( '.card-header-archive', '.card-header-single'),
			'property' => 'padding-top',
			'units'    => '%',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
    'type'        => 'switch',
    'settings'    => 'remove_srcset',
    'label'       => esc_html__('Remove Srcset from Images', 'textdomain'),
    'section'     => 'blog_settings',
    'default'     => true,
    'choices'     => [
        'on'  => esc_html__('Yes', 'textdomain'),
        'off' => esc_html__('No', 'textdomain'),
    ],
));
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_title_size_divider',
	'section'  => 'blog_settings',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_title_size',
	'label'    => esc_html__( 'Post Grid Heading Font Size in Archive Pages', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'font-size'    => '1rem',
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
	      'element'     =>  'h2.entry-title',
		  'units'    => array('rem', 'em', 'px', 'vw', '%'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  'h2.entry-title',
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  'h2.entry-title',
			'property'    => 'font-size',
			'units'    => array('rem', 'em', 'px', 'vw', '%'),
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_title_size_color',
	'label'    => esc_html__( 'Post Grid Title Color', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'color',
    'default'  => 'var(--dark)',
	'choices'     => [
		'alpha' => true,
	],
    'output'   => array(
        array(
			'element'  => array( 'h2.entry-title a' ),
			'property' => 'color',
		),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_card_spacing_divider',
	'section'  => 'blog_settings',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_card_spacing',
	'label'    => esc_html__( 'Blog Grid Card Body Spacing', 'wp-bootstrap-4' ),
	'description'	 => __( 'Mobile and Desktop: This will Overwite Global Card Settings', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'        => 'dimensions',
	'transport' => 'refresh',
	'default'     => array(
		'padding-left'    => '',
		'padding-right' => '',
		'padding-top'    => '',
		'padding-bottom' => '',
		'padding-left-lg'    => '',
		'padding-right-lg' => '',
		'padding-top-lg'    => '',
		'padding-bottom-lg' => '',
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
	      'element' => array( '.post-item .card-body', '.archive-post-item .card-body' ),
	      'property'    => 'padding-left',
	    ),
	    array(
	      'choice'      => 'padding-right',
		  'element' => array( '.post-item .card-body', '.archive-post-item .card-body' ),
	      'property'    => 'padding-right',
	    ),
		array(
			'choice'      => 'padding-top',
			'element' => array( '.post-item .card-body', '.archive-post-item .card-body' ),
			'property'    => 'padding-top',
		 ),
		array(
			'choice'      => 'padding-bottom',
			'element' => array( '.post-item .card-body', '.archive-post-item .card-body' ),
			'property'    => 'padding-bottom',
		),

		array(
			'choice'      => 'padding-left-lg',
			'element' => array( '.post-item .card-body', '.archive-post-item .card-body' ),
			'property'    => 'padding-left',
			'units'    => 'rem',
			'media_query' => '@media (min-width:992px)',
		),
		array(
			'choice'      => 'padding-right-lg',
			'element' => array( '.post-item .card-body', '.archive-post-item .card-body' ),
			'property'    => 'padding-right',
			'units'    => 'rem',
			'media_query' => '@media (min-width:992px)',
		),
		array(
			'choice'      => 'padding-top-lg',
			'element' => array( '.post-item .card-body', '.archive-post-item .card-body' ),
			'property'    => 'padding-top',
			'units'    => 'rem',
			'media_query' => '@media (min-width:992px)',
		),
		array(
			'choice'      => 'padding-bottom-lg',
			'element' => array( '.post-item .card-body', '.archive-post-item .card-body' ),
			'property'    => 'padding-bottom',
			'units'    => 'rem',
			'media_query' => '@media (min-width:992px)',
		),
	),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_link_text_divider',
	'section'  => 'blog_settings',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'          => 'blog_grid_link_text',
	'label'             => esc_html__( 'Change Link Text', 'wp-bootstrap-4' ),
	'section'           => 'blog_settings',
	'type'              => 'text',
	'sanitize_callback' => 'wp_kses_post',
	'default'  => esc_html__( 'Continue Reading', 'wp-bootstrap-4' ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_btn_style_classes',
	'label'    => esc_html__( 'Blog Grid Button Style Classes', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'text',
    'default'  => 'btn-primary btn-sm',
) ); 
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'default_blog_display_divider',
	'section'  => 'blog_settings',
	'type'     => 'custom',
    'default'  => '<hr/>',
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings'    => 'default_blog_display',
	'label'       => esc_html__( 'Blog Display', 'wp-bootstrap-4' ),
    'description' => esc_html__( 'Choose between a full post or an excerpt for the blog and archive pages.', 'wp-bootstrap-4' ),
	'section'     => 'blog_settings',
	'type'        => 'radio',
    'default'     => 'excerpt',
    'choices'     => array(
        'excerpt' => esc_html__( 'Post excerpt', 'wp-bootstrap-4' ),
        'full'    => esc_html__( 'Full Post', 'wp-bootstrap-4' ),
    )
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'show_excerpt',
	'label'    => esc_html__( 'Show Excerpt', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'radio',
    'default'  => 'yes',
    'choices' => array(
        'no'  => esc_html__( 'No. Hide excerpt in archive pages.', 'wp-bootstrap-4' ),
        'yes'  => esc_html__( 'Yes, Show it.', 'wp-bootstrap-4' ),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'default_blog_display',
            'operator' => '==',
            'value'    => 'excerpt',
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_grid_excerpt',
	'label'             => esc_html__( 'Change Excerpt', 'wp-bootstrap-4' ),
	'description'    => esc_html__( 'Set excerpt words length', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'number',
    'default'  => 20,
	'priority'    => 10,
    'choices'  => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
    'active_callback' => array(
        array(
            'setting'  => 'default_blog_display',
            'operator' => '==',
            'value'    => 'excerpt',
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_settings_title_3',
	'section'  => 'blog_settings',
	'type'     => 'custom',
    'default'  => '<hr/><h2>' . esc_html__( 'Single Post settings', 'wp-bootstrap-4' ) . '</h2>',
) );


// Full Width Page Title
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'full_page_header',
	'label'    => esc_html__( 'Full Width Page Heading for Single Post with Background.', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'checkbox',
    'default'  => 1,
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_heading_font_size',
	'label'    => esc_html__( 'Single Post Heading Font Size (h1)', 'wp-bootstrap-4' ),
	'description'    => esc_html__( 'This will overwite general pageheading font size', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
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
	      'element'     =>  array('h1.entry-title'),
	      'property'    => 'font-size',
	    ),
		array(
			'choice'      => 'font-size-md',
			'element'     =>  array('h1.entry-title'),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:768px)',
		),
		array(
			'choice'      => 'font-size-xl',
			'element'     =>  array('h1.entry-title'),
			'property'    => 'font-size',
			'units'    => 'px',
			'media_query' => '@media (min-width:1200px)',
		),
	),
) );

WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'title_under_image',
	'label'    => esc_html__( 'Show Title Under Feature Image.', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'radio',
    'default'  => 'no',
    'choices' => array(
        'no'  => esc_html__( 'No.', 'wp-bootstrap-4' ),
        'yes'  => esc_html__( 'Yes, Show it Under Feature Image', 'wp-bootstrap-4' ),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'full_page_header',
            'operator' => '==',
            'value'    => 0,
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_display_related_posts',
	'label'    => esc_html__( 'Display Related Posts in Post Single.', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'checkbox',
    'default'  => 1,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'related_grid_count',
	'label'    => esc_html__( '', 'wp-bootstrap-4' ),
	'description' => esc_html__( 'Choose Grid View for Related Posts.', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'select',
	'default'  => 'col-md-6 col-xl-3',
	'choices'     => [
		'' => esc_html__( 'One Column', 'wp-bootstrap-4' ),
		'col-md-6 col-xl-6' => esc_html__( 'Two Columns', 'wp-bootstrap-4' ),
		'col-md-6 col-xl-4' => esc_html__( 'Three Colums', 'wp-bootstrap-4' ),
		'col-md-6 col-xl-3' => esc_html__( 'Four Colums', 'wp-bootstrap-4' ),
	],
	'active_callback' => array(
        array(
            'setting'  => 'blog_display_related_posts',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'related_count',
	'description'    => esc_html__( 'Count of Posts In Related Grid. Change Count Based on Chosen Grid View.', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'number',
    'default'  => '4',
    'choices'  => array(
		'min'  => 1,
		'max'  => 12,
		'step' => 1,
	),
	'active_callback' => array(
        array(
            'setting'  => 'blog_display_related_posts',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'position_related_posts',
	'description'    => esc_html__( 'Where to Show Related posts', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'radio',
    'default'  => 'content',
    'choices' => array(
        'content'  => esc_html__( 'Show it under content.', 'wp-bootstrap-4' ),
        'sidebar'  => esc_html__( 'Show it in sidebar.', 'wp-bootstrap-4' ),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'blog_display_related_posts',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_settings_title_4',
	'section'  => 'blog_settings',
	'type'     => 'custom',
    'default'  => '<hr/><h2>' . esc_html__( 'Featured Posts Slider', 'wp-bootstrap-4' ) . '</h2>',
	'description'  => esc_html__( 'Center Position of Title Van be Set in Layout Settings Panel"', 'wp-bootstrap-4' ),
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'blog_display_posts_slider',
	'label'    => esc_html__( 'Display Posts Slider', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'checkbox',
    'default'  => 1,
) );
WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
	'settings' => 'featured_count',
	'label'    => esc_html__( 'Number of Posts In Slider', 'wp-bootstrap-4' ),
	'section'  => 'blog_settings',
	'type'     => 'number',
    'default'  => '5',
    'choices'  => array(
		'min'  => 1,
		'max'  => 10,
		'step' => 1,
	),
) );
if( class_exists( 'Kirki_Helper' ) ) {
    WP_Bootstrap_4_Kirki::add_field( 'wp_bootstrap_4_theme', array(
    	'settings'    => 'featured_ids',
    	'label'       => esc_html__( 'Select Posts', 'wp-bootstrap-4' ),
    	'section'     => 'blog_settings',
    	'type'        => 'select',
        'multiple'    => 10,
        'choices'     => Kirki_Helper::get_posts( array( 'posts_per_page' => 100, 'post_type' => 'post' ) ),
    ) );
}
