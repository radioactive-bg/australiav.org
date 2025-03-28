<?php
/**
 * Template part for displaying page heading
 *
 * @package WP_Bootstrap_4
 */
// Typewriter effects
$typewriter =  get_field('typewriter','options');

 // Lazyload images
$lazyload =  get_field('lazyload','options'); 
$lazy = '';
$src_source = 'src';
if($lazyload == true) {
    $lazy = 'lazy';
    $src_source = 'data-src';
}
// End Lazyload images

while ( have_posts() ) : the_post();
	$full_page_title = get_the_title();
    $center_mode = get_theme_mod( 'center_page_header', 1 );
    $bg_img_url = get_the_post_thumbnail_url();
    $bgr_overlay = '';
    $as_parallax = '';
    $img_heading = '';
    $brand_img_heading = '';
    $content_heading  = '';
    $link = '';
    $extra_link = '';
endwhile;
if( have_rows( 'page_header_settings' ) ) :
    while ( have_rows('page_header_settings')) : the_row();
        $img_heading = get_sub_field( 'icon_heading');
        $add_code = get_sub_field( 'add_code');
        $brand_img_heading = get_sub_field( 'brand_icon_heading');
        $order = get_sub_field('order_image');
        $invert_heading = get_sub_field('invert_heading');
        $content_heading = get_sub_field('content_heading');
        // First button
		$link = get_sub_field('button');
		$link_style = get_sub_field('button_style');
		$link_size = get_sub_field('button_size');
        $link_custom_title = get_sub_field('button_title');
		if( $link ):
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
		endif;
		// Second button
		$extra_link = get_sub_field('extra_button');
		$extra_link_style = get_sub_field('extra_button_style');
		$extra_link_size = get_sub_field('extra_button_size');
        $extra_link_custom_title = get_sub_field('extra_button_title');
		if( $extra_link ):
			$extra_link_url = $extra_link['url'];
			$extra_link_title = $extra_link['title'];
			$extra_link_target = $extra_link['target'] ? $extra_link['target'] : '_self';
		endif;
        $bgr_overlay = get_sub_field('background_overlay');
        $as_parallax = get_sub_field('as_parallax');
        $custom_class = get_sub_field('custom_class');
        $height_heading = get_sub_field('height_heading');
        $max_height_img = get_sub_field('max_height_heading_img');
        $max_width_heading = get_sub_field('max_width_heading');
        $has_gradient = '';
        if( have_rows( 'gradient_repeater' ) ) :
            while ( have_rows('gradient_repeater')) : the_row();
            $has_gradient = true;
            endwhile;
        endif;
        $mix_blend_mode = get_sub_field('mix_blend_mode');
    endwhile;
endif;

function add_background_mix() {            
    if( have_rows( 'page_header_settings' ) ) {
        while ( have_rows('page_header_settings')) { the_row();
            $bgr_color = get_sub_field('background_heading');
            $angle = get_sub_field('gradient_angle');
            $radial_gradient = get_sub_field('radial_gradient');
            $constructor_string = '';
            while ( have_posts() ) : the_post();
                $bg_img_url = get_the_post_thumbnail_url();
            endwhile;
			if ($bgr_color){
                echo 'background-color:'.$bgr_color. ';';
            }		
            if( have_rows( 'gradient_repeater' ) ) {
                $image_with_gradient = '';
                if ($bg_img_url) {
                    $image_with_gradient = ', url('. esc_url($bg_img_url) .') center top / cover  no-repeat ';
                }
                if ($radial_gradient){
                    $constructor_string .='background: radial-gradient(circle, ';
                    echo $constructor_string;
                } else {
                    $constructor_string .='background: linear-gradient('. $angle . 'deg,';
                    echo $constructor_string;
                }
                $i = 0;
                $string = '';
                while ( have_rows('gradient_repeater')) { the_row(); 
                    $i++;
                    $color_stop = get_sub_field('gradient_color'); 
                    $color_range = get_sub_field('color_range');
                    $string .= $color_stop;
                    $string .= ' ' . $color_range . '%';
                    $string .= ', ';
                }
                $string = trim($string);
                echo $string = substr($string, 0, -1);
                echo ') '. $image_with_gradient .';'; 
            } else {
                if ($bg_img_url) {
                    echo 'background-image:url('. esc_url($bg_img_url) .');';
                }
            }
        }
    }
}
?>

<style>
    .full-page-header{
        <?php echo add_background_mix();?>
        background-blend-mode: <?php echo $mix_blend_mode;?>;
    }
    .full-page-header:before{
        content: "";
    }
</style>

<?php if($bgr_overlay): ?>
<style>
   .full-page-header .bg-overlay{
        background-color: <?php echo $bgr_overlay;?>
   }
</style>
<?php endif; ?>
<section class="full-page-header <?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-full-page-header' : '' ; ?> <?php echo ( $has_gradient == true ) ? 'has-gradient': ''; ?> <?php echo $custom_class; ?> <?php if($typewriter): ?>has-typewriter-effect<?php endif; ?>">
	<?php if ( $as_parallax ) : ?> <div data-depth="0.15" data-type="parallax" class="parallax-section full-page-header"></div> <?php endif; ?>
	
    <div class="page-header-overlay <?php if ( $bg_img_url ) : ?>bg-overlay<?php endif; ?> d-flex align-items-center" style="min-height:<?php echo $height_heading;?>vw;">
        <div class="container">
            <div class="row <?php echo $center_mode ? 'justify-content-center' : '' ;?> <?php echo ($invert_heading) ? 'text-white' : ''; ?>">
                <div class="col-12 d-flex flex-wrap <?php echo $center_mode ? 'justify-content-center text-center' : 'flex-lg-nowrap' ;?>">
                    <?php if($add_code): 
                    echo $add_code; 
                    elseif ($img_heading): ?>
						<?php if($center_mode): ?>
							<div class="col-12 <?php echo $order; ?> mb-3 mb-lg-4" style="max-width:<?php echo $max_width_heading;?>px;">
						<?php endif; ?>
                        	<img data-no-lazy="1" class="pageheading-img mx-auto <?php echo $center_mode ? '' : 'align-self-start' ;?> <?php echo $order; ?> <?php echo $lazy; ?>" width="426" height="350" <?php echo ($src_source .'="'. $img_heading .'"'); ?> alt="<?php echo $full_page_title; ?>" style="max-height:<?php echo $max_height_img;?>px;"/>
						<?php if($center_mode): ?>
						</div>
						<?php endif; ?>
                    <?php endif; ?>

                    <div class="page-header-content col-12 <?php echo ($content_heading && !$center_mode) ? 'col-lg' : 'col-lg' ;?> align-self-center px-0" style="max-width:<?php echo $max_width_heading;?>px;">
						<?php if($brand_img_heading): ?>
						<img data-no-lazy="1" class="brandheading-img mb-3 mb-lg-4 <?php echo $lazy; ?>" width="120" height="120" <?php echo ($src_source .'="'. $brand_img_heading .'"'); ?> alt="<?php echo $full_page_title; ?>" style="max-height: 80px;"/>
						<?php endif; ?>
                        <h1 class="<?php echo ($invert_heading) ? 'inverted-heading' : ''; ?>"  <?php if($typewriter): ?>data-text='["<?php echo $full_page_title; ?>"]' style="opacity: 0;"<?php endif; ?> ><?php echo $full_page_title; ?></h1>
                        <?php if($content_heading): ?>
                            <div class="the-content">
                                <?php echo the_content();?>
                            </div>
                        <?php endif; ?>
						<?php if( $link ): ?>
							<a class="brandheading-btn btn <?php echo ($link_style .' '. $link_size); ?> <?php echo ($content_heading)? 'mt-4' : '';?>" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo $link_custom_title ? ''. $link_custom_title .'' : '' .esc_attr( $link_title ).''; ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
						<?php if( $extra_link ): ?>
							<a class="brandheading-btn btn <?php echo ($extra_link_style .' '. $extra_link_size); ?> <?php echo ($content_heading)? 'mt-4' : '';?> ml-3" href="<?php echo esc_url( $extra_link_url ); ?>" title="<?php echo $extra_link_custom_title ? ''. $extra_link_custom_title .'' : '' .esc_attr( $extra_link_title ).''; ?>" target="<?php echo esc_attr( $extra_link_target ); ?>"><?php echo esc_html( $extra_link_title ); ?></a>
						<?php endif; ?>
                        <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php //wp_bootstrap_4_posted_on(); ?>
								<?php wp_bootstrap_4_entry_footer(); ?>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php if ( function_exists( 'yoast_breadcrumb' ) ) { ?>
<nav id="breadcrumb-navigation" class="breadcrumb-navigation relative navbar text-white w-100 py-sm-2">
	<div class="container">	
        <?php
        if ( function_exists( 'yoast_breadcrumb' ) ) {
            yoast_breadcrumb( );
        }
        ?>	
        <div class="extra-breadcrumb-nav ml-auto card overflow-visible border-0">
            <div class="card-body py-2 px-3 px-lg-5">
                <p class="mb-0 px-3"><?php echo __( 'visa types', 'wp-bootstrap-4' ) ;?></p>
                <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'client-area',
                        'menu_id'         => 'secondary-menu',
                        'container'       => 'div',
                        'container_class' => '',
                        'container_id'    => 'secondary-menu-wrap',
                        'menu_class'      => 'p-0 mb-0',
                        'fallback_cb'     => '__return_false',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 3,
                        'walker'          => new WP_bootstrap_4_walker_nav_menu()
                    ) );
                ?>	
            </div>
        </div>
	</div>
</nav>
<?php } ?>
