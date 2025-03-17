<?php
$scroll_me =  get_field('scroll_me','options');
// Lazyload images
$lazyload =  get_field('lazyload','options'); 
$lazy = '';
$src_source = 'src';
if($lazyload == true) {
    $lazy = 'lazy';
    $src_source = 'data-src';
}
// End Lazyload images
$disable_layout = get_sub_field('disable_layout');
$layout_title = get_sub_field('layout_title');
$heading_title_class = get_sub_field('heading_title_class');
$label = get_sub_field('layout_label');
$layout_description = get_sub_field('layout_description');
$column = get_sub_field('column');
$row_gutter = get_sub_field('row_gutter');
$use_responsive = get_sub_field('use_responsive');
$vertical_offset = get_sub_field('vertical_offset');
$responsive_margins = get_sub_field('responsive_margins');
// Card Body
$card_body = get_sub_field('card_body');
$break_item = get_sub_field('break_item');
// Layout background
$background_color = get_sub_field('background_color');
// Layout background image
$background_image = get_sub_field('background_image');
// Layout background parallax
$as_parallax = get_sub_field('as_parallax');
// Cards Scroll Effects 
$card_scroll_effects = get_sub_field('card_scroll_effects');
$active_card_scroll_effects = "";
$active__scroll_container = "";
$active_scroll_element = "";
if($card_scroll_effects == true && $scroll_me == true) {
    $active__scroll_container = "scrollme";
}
// Card image full content
$cards_full = get_sub_field('cards_full');
// Custom container
$container = get_sub_field('container');
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');
// Image alignment
$alignment = get_sub_field('alignment');
// Description position
$description_first = get_sub_field('description_first');
$align_center = '' ;
if ( get_sub_field('alignment') == 'text-center' ) {
    $align_center = true ;
} 
// Cards Link as Content
$link_content = get_sub_field('link_content');
// Invert colors
$invert_content = get_sub_field('invert_content');
// Cards title custom class
$title_class = get_sub_field('title_class');

if(!$disable_layout) {
?>

<section id="<?php echo ($custom_id ); ?>" class="section-cards <?php echo ($custom_class ); ?> <?php echo ($active__scroll_container); ?> <?php if (!$as_parallax): if($background_image):?><?php echo $lazy; ?><?php endif; endif; ?>"  <?php if(!$as_parallax && $lazyload): if($background_image) :?>data-bg="<?php echo $background_image; ?>"<?php endif; endif; ?> style="<?php if ((!$as_parallax && !$lazyload)): if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; endif; ?> <?php if ($background_color):?>background-color:<?php echo $background_color;?>;<?php endif; ?>">
	<?php if ($as_parallax):?>
	<div class="parallax-section">
         <?php if ($background_image):?><img width="1920" height="1040" class="d-inline-block mx-auto <?php echo $lazy; ?>" data-speed="0.3" <?php echo ($src_source .'="'. $background_image.'"'); ?> alt=""/><?php endif; ?>
    </div>
	<?php endif; ?>
	
    <div class="<?php echo ( $container ); ?>">
        <div class="row <?php echo ($invert_content) ? 'text-white' : ''; ?> <?php echo ($align_center == true) ? 'justify-content-center' : ''; ?> <?php echo ($row_gutter); ?>">
        <?php if ( $layout_title || $layout_description ): ?>
            <div class="col-12 <?php echo ($alignment); ?> mb-3">
                <?php if ($label):?>
                    <label class="label"><?php echo $label; ?></label>
                <?php endif;?>
                <?php if ($layout_title):?>
                    <h2 class="<?php echo $heading_title_class; ?>"><?php echo $layout_title; ?></h2>
                <?php endif;?>
                <?php if ($layout_description && $description_first):?>
                    <div class="section-desc <?php echo ($align_center == true) ? 'mx-auto' : ''; ?> mb-3"><?php echo $layout_description; ?></div>
                <?php endif;?>
            </div>
        <?php endif;?>
        <?php if( have_rows( 'card' ) ):?>
            <?php while ( have_rows('card')) : the_row();
                $image = get_sub_field('image');
			    $card_background_image = get_sub_field('background_image');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                // button
                $link = get_sub_field('button');
                $link_style = get_sub_field('button_style');
                $link_size = get_sub_field('button_size');
			    $link_custom_title = get_sub_field('button_title');
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                endif;
                $card_background = get_sub_field('card_background');
                $card_custom_class = get_sub_field('item_custom_class');
			    $countries = get_sub_field('countries');
                $card_effect_orientation = get_sub_field('card_effect_orientation');
                $card_effect_offset = get_sub_field('card_effect_position_offset');
                $card_effect_rotate = get_sub_field('card_effect_rotate');
                $card_effect_rotate_angle = get_sub_field('card_effect_rotate_angle');
                $card_effect_scale = get_sub_field('card_effect_scale');
                $card_effect_scale_factor = get_sub_field('card_effect_scale_factor');
                $card_effect_start_position_opacity = get_sub_field('card_effect_start_position_opacity');
                $active_scroll_element = '';
                if($card_scroll_effects == true && $scroll_me == true) {
                    $active_scroll_element = "animateme";
                    $active_card_scroll_effects = "data-when='enter' data-from='1' data-to='0' data-opacity='$card_effect_start_position_opacity'  $card_effect_orientation='$card_effect_offset' $card_effect_rotate='$card_effect_rotate_angle' $card_effect_scale='$card_effect_scale_factor' data-easeinout='1'";
                }
            ?>
            <div class="card-item <?php echo ($column); ?> <?php echo ($use_responsive) ? ''.$responsive_margins.'' : ''.$vertical_offset.''; ?> d-flex justify-content-center <?php echo ($active_scroll_element); ?> <?php echo ($card_custom_class); ?>" <?php echo $active_card_scroll_effects; ?>>
                    <div class="card w-100 <?php echo ($align_center == true) ? 'align-items-center' : ''; ?> justify-content-center" style="<?php if ($card_background):?>background-color: <?php echo $card_background; ?>;<?php endif; ?><?php if ($card_background_image):?>background-image: url('<?php echo $card_background_image; ?>');<?php endif; ?>">
                         
                        <?php if ($cards_full == true):?>
                            <?php if ($image):?>
                                <div class="img-wrapper <?php echo ($alignment); ?>">
                                    <img width="373" height="307" class="<?php echo ($align_center == true) ? 'mx-auto' : ''; ?> <?php echo $lazy; ?>" <?php echo ($src_source .'="'. esc_url($image['url']) .'"'); ?> alt="<?php echo esc_attr($image['title']); ?>"/>
                                </div>
                            <?php endif;?>
                            <?php endif; ?>
                        
                        <div class="card-body d-flex w-100 <?php echo ($break_item) ? 'flex-row flex-md-column' : 'flex-column'; ?> <?php echo ($align_center == true) ? 'align-items-center' : ''; ?> <?php echo ($align_center == true && $break_item) ? 'text-md-center' : ''.$alignment.''; ?> <?php if (!$title && !$description):?>p-0<?php endif; ?> <?php echo ($card_body); ?>">
                            
                            <?php if ($link_content):?>
							    <!-- Link as content -->
                                <?php if($link): ?>
                                    <a class="d-block h-100 flex-1 <?php echo ($invert_content) ? '' : 'text-dark'; ?>" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo $link_custom_title ? esc_attr($link_custom_title) : (esc_attr($link_title) . ($title ? ' ' . esc_attr($title) : '')); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php endif; ?>
								<!-- End Link as content -->
                            <?php endif; ?>
                            
                            <?php if ($cards_full == false):?>
                            <?php if (($image && !$link) || ($link_content && $image && $link)):?>
                                <div class="img-wrapper <?php echo ($alignment); ?> <?php echo ($break_item) ? 'align-self-start align-self-md-center mb-md-3 mr-3 mr-md-0' : ''.(($title || $description) ? 'img-margin':'img-only').''; ?>">
                                    <img width="373" height="307" class="<?php echo ($align_center == true) ? 'mx-auto' : ''; ?> <?php echo $lazy; ?>" <?php echo ($src_source .'="'. esc_url($image['url']) .'"'); ?> alt="<?php echo esc_attr($image['title']); ?>"/>
                                </div>
                            <?php endif;?>
							<?php if ($link_content == false):?>
                                <?php if( $image && $link): ?>
									<div class="img-wrapper <?php echo ($alignment); ?> <?php echo ($break_item) ? 'align-self-start align-self-md-center mb-md-3 mr-3 mr-md-0' : ''.(($title || $description) ? 'img-margin':'img-only').''; ?>">
                                    <a class="d-block" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo $link_custom_title ? ''. $link_custom_title .'' : '' .esc_attr( $link_title ).''; ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                    <img width="373" height="307" class="<?php echo ($align_center == true) ? 'mx-auto' : ''; ?> <?php echo $lazy; ?>" <?php echo ($src_source .'="'. esc_url($image['url']) .'"'); ?> alt="<?php echo esc_attr($image['title']); ?>"/>
									</a>
									</div>
									<?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
							<div class="content flex-1">
								<?php if ($title):?><h3 class="<?php echo ($title_class); ?>"><?php echo $title; ?></h3><?php endif;?>
								<?php if ($countries && $countries != 'Nothing Selected'):?><p><?php echo $countries; ?></p><?php endif;?>
								<?php if ($description):?><?php echo $description; ?><?php endif;?>
							</div>
                           
                            <?php if ($link_content):?>
								<!-- Link as content -->
                                <?php if($link): ?>
                                </a>
                                <?php endif; ?>
							     <!-- End Link as content -->
                            <?php endif; ?>
                            
                            <?php if ($link_content == false):?>
                                <?php if( $link): ?>
                                    <a class="btn <?php echo ($link_style .' '. $link_size); ?> align-self-center <?php echo ($break_item) ? 'mt-md-3' : ' mt-3'; ?>" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo $link_custom_title ? ''. $link_custom_title .'' : '' .esc_attr( $link_title ).''; ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php  endwhile; ?>

        <?php else : ?>
            <!-- // no layouts found -->
        <?php endif; ?>
        <?php if ($layout_description && !$description_first):?>
            <div class="col-12 section-desc <?php echo ($alignment); ?> <?php echo ($align_center == true) ? 'mx-auto' : ''; ?> mt-4"><?php echo $layout_description; ?></div>
        <?php endif;?>
        </div>
    </div>
</section>
<?php 
}
