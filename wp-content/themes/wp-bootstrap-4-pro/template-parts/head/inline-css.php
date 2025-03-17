<!-- root vars and internal images path -->
<style id="root-css" type="text/css">
	<?php 
	function wp_bootstrap_4_get_card_spacing() {
		// Default values
		$default_spacing = array(
			'padding-left'       => '1.25rem',
			'padding-right'      => '1.25rem',
			'padding-top'        => '2rem',
			'padding-bottom'     => '2rem',
			'padding-left-lg'    => '2rem',
			'padding-right-lg'   => '2rem',
			'padding-top-lg'     => '2rem',
			'padding-bottom-lg'  => '2rem',
		);

		// Get customizer values
		$card_spacing = get_theme_mod('card_spacing', $default_spacing);

		// Return spacing values
		return array(
			'padding-left'       => isset($card_spacing['padding-left']) ? $card_spacing['padding-left'] : $default_spacing['padding-left'],
			'padding-right'      => isset($card_spacing['padding-right']) ? $card_spacing['padding-right'] : $default_spacing['padding-right'],
			'padding-top'        => isset($card_spacing['padding-top']) ? $card_spacing['padding-top'] : $default_spacing['padding-top'],
			'padding-bottom'     => isset($card_spacing['padding-bottom']) ? $card_spacing['padding-bottom'] : $default_spacing['padding-bottom'],
			'padding-left-lg'    => isset($card_spacing['padding-left-lg']) ? $card_spacing['padding-left-lg'] : $default_spacing['padding-left-lg'],
			'padding-right-lg'   => isset($card_spacing['padding-right-lg']) ? $card_spacing['padding-right-lg'] : $default_spacing['padding-right-lg'],
			'padding-top-lg'     => isset($card_spacing['padding-top-lg']) ? $card_spacing['padding-top-lg'] : $default_spacing['padding-top-lg'],
			'padding-bottom-lg'  => isset($card_spacing['padding-bottom-lg']) ? $card_spacing['padding-bottom-lg'] : $default_spacing['padding-bottom-lg'],
		);
	}

	$card_spacing = wp_bootstrap_4_get_card_spacing();
	?>
	:root {
		--menu-icon-width: 1.4rem;
		--menu-icon-margin: .6rem;
		--menu-icon-text-width: calc(100% - (var(--menu-icon-width) + var(--menu-icon-margin)));
		--primary: <?php echo get_theme_mod( 'styling_primary_color', '#004cff' );?>;
		--primary-hover: <?php echo get_theme_mod( 'styling_primary_hover_color', '#0043e1' );?>;
		--secondary: <?php echo get_theme_mod( 'styling_secondary_color', '#47b24d' );?>;
		--secondary-hover: <?php echo get_theme_mod( 'styling_secondary_hover_color', '#36913a' );?>;
		--dark: <?php echo get_theme_mod( 'styling_dark_color', '#333333' );?>;
		--dark-hover: <?php echo get_theme_mod( 'styling_dark_hover_color', '#202020' );?>;
		--light: #f8f5f8;
		--accent: <?php echo get_theme_mod( 'styling_accent_color', '#0099db' );?>;
		--accent-hover: <?php echo get_theme_mod( 'styling_accent_hover_color', '#0099db' );?>;
		--container_extra_gutter-x: <?php echo get_theme_mod( 'container_extra_gutter', '0px' );?>;
		--gutter-x: <?php echo get_theme_mod( 'row_gutter_x', '15px' );?>;
		--spacer-1: <?php echo get_theme_mod( 'spacer-1', '0.25rem' );?>;
		--spacer-2: <?php echo get_theme_mod( 'spacer-2', '0.5rem' );?>;
		--spacer-3: <?php echo get_theme_mod( 'spacer-3', '1rem' );?>;
		--spacer-4: <?php echo get_theme_mod( 'spacer-4', '1.5rem' );?>;
		--spacer-5: <?php echo get_theme_mod( 'spacer-5', '3rem' );?>;
        /* Card Body Padding */
		--card-padding-left: <?php echo esc_attr($card_spacing['padding-left']); ?>;
        --card-padding-right: <?php echo esc_attr($card_spacing['padding-right']); ?>;
        --card-padding-top: <?php echo esc_attr($card_spacing['padding-top']); ?>;
        --card-padding-bottom: <?php echo esc_attr($card_spacing['padding-bottom']); ?>;
		<?php 
		/* Card Border Radius */
			$card_border_style = get_theme_mod( 'card_border_style', array( 'border-radius' => '0.25rem' ) );
			$border_radius = isset( $card_border_style['border-radius'] ) ? $card_border_style['border-radius'] : '0.25rem';
		?>
		--border-radius: <?php echo esc_attr( $border_radius ); ?>;
		<?php 
		/*  Global Hero Layout: Background image */
		$bg_image = get_header_image();
		if ( $bg_image ) {
			$hero_relative_path = preg_replace( '#^(.*)(/wp-content.*)#', '$2', $bg_image );
			echo '--hero-bg-image: url("' . esc_url( site_url( $hero_relative_path ) ) . '");';
		}
        /*  Global Hero Layout: Background image on Mobile*/
		$mobile_image_id  = get_theme_mod('header_image_mobile');
		$mobile_image_url = wp_get_attachment_url( $mobile_image_id );
		// If a valid URL is found
		if ( $mobile_image_url ) {
			// Strip domain+subfolders, keep everything from /wp-content onward
			$mobile_hero_relative_path = preg_replace('#^(.*)(/wp-content.*)#', '$2', $mobile_image_url);
			// Build a consistent full URL using site_url() + the stripped path
			echo '--hero-bg-image-mobile: url("' . esc_url( site_url( $mobile_hero_relative_path ) ) . '");';
		}

		/* CTA Global Layout: Background image */
		$cta_bg = get_theme_mod( 'cta_background_setting' );
		if ( !empty( $cta_bg['background-image'] ) ) {
			$original_url = $cta_bg['background-image'];
			$cta_relative_path = preg_replace('#^(.*)(/wp-content.*)#', '$2', $original_url);
			echo '--cta-bg-image: url("' . site_url( esc_url( $cta_relative_path ) ) .'");';
		} 
		?>
        /* Card Body lg Padding */
        @media (min-width: 992px) {
            --card-padding-left-lg: <?php echo esc_attr($card_spacing['padding-left-lg']); ?>;
            --card-padding-right-lg: <?php echo esc_attr($card_spacing['padding-right-lg']); ?>;
            --card-padding-top-lg: <?php echo esc_attr($card_spacing['padding-top-lg']); ?>;
            --card-padding-bottom-lg: <?php echo esc_attr($card_spacing['padding-bottom-lg']); ?>;
        }

	}
    <?php 
	// Global Hero Layout: Full setup
	$bg_image         = get_header_image();  // The WP built-in “header_image” setting
	$mobile_image_id  = get_theme_mod('header_image_mobile');
	$mobile_image_url = wp_get_attachment_url( $mobile_image_id );
	$bg_color         = get_theme_mod('header_bg_color', '#ffffff00');
	$bg_repeat        = get_theme_mod('header_bg_repeat', 'no-repeat');
	$bg_attach        = get_theme_mod('header_bg_attachment', 'scroll');
	$bg_position      = get_theme_mod('header_bg_position', 'left top');
	$bg_position_custom = get_theme_mod( 'header_bg_position_custom', '' );
	// Decide final position
	if ( 'custom' === $bg_position ) {
		if ( ! empty( $bg_position_custom ) ) {
			$final_bg_position = $bg_position_custom;
		} else {
			$final_bg_position = 'initial';
		}
	} else {
		// e.g. 'left top', 'center center', etc.
		$final_bg_position = $bg_position;
	}
	$bg_size          = get_theme_mod('header_bg_size', 'cover');
	$bg_size_custom   = get_theme_mod( 'header_bg_size_custom', '' );

	// Decide final value:
	if ( 'custom' === $bg_size ) {
   		if ( ! empty( $bg_size_custom ) ) {
			$final_bg_size = $bg_size_custom;
		} else {
			$final_bg_size = 'initial';
		}
	} else {
		// 'auto', 'cover', or 'contain'
		$final_bg_size = $bg_size;
	}
   
    function print_bg_properties( $bg_repeat, $bg_size, $bg_attach, $bg_position ) {
		if ( $bg_repeat ) {
			echo "background-repeat: " . esc_attr( $bg_repeat ) . ";\n";
		}
		if ( $bg_size ) {
			echo "background-size: " . esc_attr( $bg_size ) . ";\n";
		}
		if ( $bg_attach ) {
			echo "background-attachment: " . esc_attr( $bg_attach ) . ";\n";
		}
		if ( $bg_position ) {
			echo "background-position: " . esc_attr( $bg_position ) . ";\n";
		}
	}

	if ( $bg_image || $bg_color ) {
		echo ".jumbotron {\n";
		// Background color (if set)
		if ( $bg_color ) {
			echo "background-color: " . esc_attr( $bg_color ) . ";\n";
		}
		// Background image & related properties (if set)
		if ( $bg_image ) {
			// If no mobile image 
			if ( ! $mobile_image_url ) {
				echo "background-image: var(--hero-bg-image, none);\n";
			}
			print_bg_properties( $bg_repeat, $final_bg_size, $bg_attach, $final_bg_position );
		}
		echo "}\n";
	}

    // Large device override 
	$bg_position_large = get_theme_mod( 'header_bg_position_large', 'use_all_devices' );
	$bg_position_custom_large = get_theme_mod('header_bg_position_custom_large', '');

	// Decide final large-screen position
	if ( 'custom' === $bg_position_large ) {
		if ( ! empty( $bg_position_custom_large ) ) {
			$final_bg_position_large = $bg_position_custom_large;
		} else {
			$final_bg_position_large = 'initial';
		}
	} else {
		// e.g. 'left top', 'use_all_devices', etc.
		$final_bg_position_large = $bg_position_large;
	}
	$bg_size_large  = get_theme_mod( 'header_bg_size_large', 'use_all_devices' );
	$bg_size_custom_large   = get_theme_mod( 'header_bg_size_custom_large', '' );
    
	if ( 'custom' === $bg_size_large ) {
    	if ( ! empty( $bg_size_custom_large ) ) {
			$final_bg_size_large = $bg_size_custom_large;
		} else {
			$final_bg_size_large = 'initial';
		}
	} else {
		// 'auto', 'cover', 'contain', or 'use_all_devices'
		$final_bg_size_large = $bg_size_large;
	}

	// Get the user-chosen breakpoint (string)
	$media_breakpoint_string = get_theme_mod( 'header_bg_media_breakpoint', '992' );

	// Convert to integer for math
	$media_breakpoint = absint( $media_breakpoint_string );

	// For an “up” media query:  (e.g. min-width: 992px)
	$media_breakpoint_up = $media_breakpoint;         

	// For a “down” media query: (e.g. max-width: 991px)
	$media_breakpoint_down = $media_breakpoint - 1;

    if ( $bg_image ) {
		// Only output the large-device override if it's NOT "use_all_devices"
		if ( 'use_all_devices' !== $bg_position_large || 'use_all_devices' !== $bg_size_large || $mobile_image_url) {
			echo "@media (min-width: {$media_breakpoint_up}px) {\n";
			echo "  .jumbotron {\n";
			// If mobile image 
			if ( $mobile_image_url ) {
				echo "background-image: var(--hero-bg-image, none);\n";
			}
			// If position is not use_all_devices, override it for large screens
			if ( 'use_all_devices' !== $bg_position_large ) {
				echo "background-position: " . esc_attr( $final_bg_position_large ) . ";\n";
			}
			// If size is not use_all_devices, override it for large screens
			if ( 'use_all_devices' !== $bg_size_large ) {
				echo "    background-size: " . esc_attr( $final_bg_size_large ) . ";\n";
			}
			echo "  }\n";
			echo "}\n";
		}
    }

	/*  Global Hero Layout: Background image on Mobile */
	if ( $mobile_image_url ) {
		echo "@media (max-width: {$media_breakpoint_down}px) {\n";
		echo "  .jumbotron {\n";
		echo "    background-image: var(--hero-bg-image-mobile, none);\n";
		if ( ! $bg_image ) {
			print_bg_properties( $bg_repeat, $final_bg_size, $bg_attach, $final_bg_position );
		}
		echo "  }\n";
		echo "}\n";
    }
    
	// CTA Global Layout: Full setup
	// Get the entire array stored by Kirki
	$cta_bg = get_theme_mod('cta_background_setting');
	// Safely extract each property (default to empty so we can conditionally check)
	$color    = $cta_bg['background-color']    ?? '#ffffff';
	$repeat   = $cta_bg['background-repeat']   ?? 'no-repeat';
	$size     = $cta_bg['background-size']     ?? 'cover';
	$attach   = $cta_bg['background-attachment']   ?? 'scroll';
	$position = $cta_bg['background-position'] ?? 'left-top';
	$image    = $cta_bg['background-image'] ?? '';
    // Bail if the user never changed anything (empty array)
	if ( empty($color) && empty($image) ) {
		return;
	}
	// Start building your CSS rule
	$css  = ".cta-global-section {\n";
	// Only append each property if it's not empty
	if ( ! empty($color) ) {
		$css .= "background-color: " . esc_attr($color) . ";\n";
	}
    if ( ! empty($image) ) {
		if ( ! empty($repeat) ) {
			$css .= "background-repeat: " . esc_attr($repeat) . ";\n";
		}
		if ( ! empty($size) ) {
			$css .= "background-size: " . esc_attr($size) . ";\n";
		}
		if ( ! empty($attach) ) {
			$css .= "background-attachment: " . esc_attr($attach) . ";\n";
		}
		if ( ! empty($position) ) {
			$css .= "background-position: " . esc_attr($position) . ";\n";
		}
		$css .= "background-image: var(--cta-bg-image, none);\n";
	}
	$css .= "}";
	// Print the resulting CSS block
	echo $css;
	?>
    /* Internal theme images*/
	.navbar-toggler-icon {
		background-image: url('<?php echo get_template_directory_uri();?>/assets/images/burger.svg');
	}
	.item-description li:before,
	.content li:before{
	<?php if ((in_category('business') && !in_category('personal')) || is_page(array( 'business' ))):?>
		background-image: url('<?php echo get_template_directory_uri();?>/assets/images/list-small-icon-primary.svg');
	<?php else: ?>
		background-image: url('<?php echo get_template_directory_uri();?>/assets/images/list-small-icon.svg');
	<?php endif ;?>
	}
	.border-0 .card-item:not(:last-child) .card:after{
		background: url('<?php echo get_template_directory_uri();?>/assets/images/styled-arrow.svg') center/100% no-repeat;
	}
	.btn-link:not([data-toggle="collapse"]):after{
		content: '';
		background: url('<?php echo get_template_directory_uri();?>/assets/images/arrow-right-secondary.svg') center/100% no-repeat;
		width: 12px;
		height: 12px;
		display: inline-block;
		vertical-align: middle;
		margin-left: 6px;
	}
	.btn-link.text-primary:not([data-toggle="collapse"]):after{
		background: url('<?php echo get_template_directory_uri();?>/assets/images/arrow-right-primary.svg') center/100% no-repeat;
		width: 18px;
		height: 16px;
	}
	.btn:not(.btn-link):not(.nav-link):not([data-toggle="collapse"]):after{
		content: '';
		background: url('<?php echo get_template_directory_uri();?>/assets/images/bootstrap-icons/arrow-right-short.svg') center/110% no-repeat;
	}
	.steps-section .card-item:not(:last-child) .card:after {
		background: url('<?php echo get_template_directory_uri();?>/assets/images/lp-icon-arrow.svg') center/80% no-repeat
	}	
	footer.site-footer .menu li:before{
	   background-image: url('<?php echo get_template_directory_uri();?>/assets/images/leaf.svg');
	}
	<?php $parallax_hover =  get_field('parallax_hover','options'); 
	if($parallax_hover == true) { ?>
	/*--------------------------------------------------------------
	# On Hover Animations
	--------------------------------------------------------------*/
	.atvImg {
		transform-style: preserve-3d;
		-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
		width: 100%;
		height: 100%;
		display: inline-block;
		cursor: pointer;
	}
	.atvImg img {
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
		box-shadow: unset!important;
	}
	.atvImg-container {
		position: relative;
		width: 100%;
		height: 100%;
		transition: all 0.2s ease-out;
		padding-top: 100%;
	}
	.atvImg-container.over .atvImg-shadow {
		box-shadow: 0 45px 100px rgba(0, 0, 0, 0.4), 0 16px 40px rgba(0, 0, 0, 0.4);
		box-shadow: unset!important;
	}
	.atvImg-layers {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		overflow: hidden;
		transform-style: preserve-3d;
	}
	.atvImg-rendered-layer {
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		background-repeat: no-repeat;
		background-position: center;
		background-color: transparent;
		background-size: contain;
		transition: all 0.1s ease-out;
	}
	.atvImg-shadow {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		transition: all 0.2s ease-out;
		box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
		box-shadow: unset!important;
	}
	.atvImg-shine {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: linear-gradient(135deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0) 60%);
		box-shadow: unset!important;
		background: unset!important;
	}
	@media (max-width: 991px) {
		.atvImg{
			pointer-events: none;
		}
	}
	<?php } 
	$typewriter =  get_field('typewriter','options'); 
	if($typewriter == true) { ?>
	/*--------------------------------------------------------------
	# Animate css: elements to catch when typewriter effect is switched on 
	--------------------------------------------------------------*/
	.has-typewriter-effect .the-content *:not(.gradient-mesh):not(.gradient-mesh *), 
	.has-typewriter-effect .brandheading-btn,
	.has-typewriter-effect .jumbotron-description,
	.has-typewriter-effect .jumbotron-cta{
	    opacity: 0;
	}
	<?php } 
	$in_vew_animation =  get_field('in_vew_animation','options'); 
	if($in_vew_animation == true) { ?>
	/*--------------------------------------------------------------
	# In View Animations using Ainimate css start fixes
	--------------------------------------------------------------*/
	h2:not(.aimated),
	.flex-1 h3:not(.aimated), 
	.item-description p:not(.aimated),
	.item-description li:not(.aimated), 
	.section-desc p:not(.aimated), 
	.section-desc a:not(.aimated), 
	.section-desc li:not(.aimated), 
	.section-desc a:not(.aimated), 
	.content:not(.accordion-item-content) p:not(.aimated), 
	.content li:not(.aimated), 
	.content a:not(.aimated),
	.content+a:not(.aimated),
	.content+a:not(.aimated)+a:not(.aimated){
		opacity: 0;
	}
	/*--------------------------------------------------------------
	# Custom Animation Reveal on H2 Headings
	--------------------------------------------------------------*/
	@keyframes reveal {
	0% {
		background-position-x: 100%;
		-webkit-transform: translate3d(0, 100%, 0);
		opacity: 0;
		transform: translate3d(0, 100%, 0);
	}
	to {
		background-position-x: 0%;
		-webkit-transform: translateZ(0);
		opacity: 1;
		transform: translateZ(0);
	}
	}
	section h2.reveal {
	-webkit-animation-name: reveal;
	animation-name: reveal;
	}
	section h2 {
	background: linear-gradient(
		to right,
		rgb(255, 255, 255) 50%,
		rgb(19, 19, 19, 0.2) 50%
	);
	background-size: 200% 100%;
	background-position-x: 100%;
	color: transparent !important;
	background-clip: text;
	-webkit-background-clip: text;
	-webkit-animation-duration: 1.2s;
	-webkit-animation-fill-mode: both;
	animation-duration: 1.2s;
	animation-fill-mode: both;
	}

	h2.heading.text-dark,
	.text-dark *:not(.btn).heading,
	.text-dark *:not(.btn).display-4 {
	background: linear-gradient(
		to right,
		rgb(19, 19, 19) 50%,
		rgba(19, 19, 19, .2) 50%
	);
	background-size: 200% 100%;
	background-position-x: 100%;
	color: transparent !important;
	background-clip: text;
	-webkit-background-clip: text;
	}

	.cta-global-section h2.heading {
	background: linear-gradient(
		to right,
		rgb(255, 255, 255) 50%,
		rgb(255, 255, 255, 0.3) 50%
	);
	background-size: 200% 100%;
	background-position-x: 100%;
	color: transparent !important;
	background-clip: text;
	-webkit-background-clip: text;
	}

	<?php } ?>
</style>
<!-- End internal images path -->