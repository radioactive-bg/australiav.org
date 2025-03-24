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
$label = get_sub_field('layout_label');
$column = get_sub_field('column');
$vertical_offset = get_sub_field('vertical_offset');
$layout_description = get_sub_field('layout_description');
// Layout background
$background_color = get_sub_field('background_color');
// Layout background image
$background_image = get_sub_field('background_image');
// Cards Scroll Effects 
$list_item_scroll_effects = get_sub_field('list_item_scroll_effects');
$active_list_item_scroll_effects = "";
$active__scroll_container = "";
$active_scroll_element = "";
if($list_item_scroll_effects == true && $scroll_me == true) {
    $active__scroll_container = "scrollme";
}
// Card Styles
$item_as_card = get_sub_field('item_as_card');
// Break list item on mobile (image on top)
$break_item = get_sub_field('break_item');
// Custom container
$container = get_sub_field('container');
$check_container = '';
if( get_sub_field('container') == 'container' ) {
    $check_container = true;
} else {
    $check_container = false;
}
// Alignment on heading title, label and description
$alignment = get_sub_field('alignment');
// Description position
$description_first = get_sub_field('description_first');
$align_center = '' ;
if ( get_sub_field('alignment') == 'text-center' ) {
    $align_center = true ;
} 
// Invert colors
$invert_content = get_sub_field('invert_content');
// Order
$order = get_sub_field('order');
$class_group = '';
if ( $order == 'order-default' ) {
    if ( $column == 'col-lg-12' ) {
        $img_offset = 'pr-lg-4 pr-xl-5';
    } elseif ( $column == 'col-lg-6' ) {
        $img_offset = 'pr-lg-4';
    } elseif ( $column == 'col-md-6 col-lg-4' ) {
        $img_offset = 'pr-lg-3';
    } else {
        $img_offset = '';
    }
    $class_group = 'pr-2 '. $img_offset .' mr-auto image-first';
} else {
    if ( $column == 'col-lg-12' ) {
        $img_offset = 'pl-lg-4 pl-xl-5';
    } elseif ( $column == 'col-lg-6' ) {
        $img_offset = 'pl-lg-4';
    } elseif ( $column == 'col-md-6 col-lg-4' ) {
        $img_offset = 'pl-lg-3';
    } else {
        $img_offset = '';
    }
    $class_group = 'pr-3 pr-lg-0 '. $img_offset .' ml-auto image-last';
} 
// Cards title custom class
$title_class = get_sub_field('title_class');
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');
// With Sedebar
$sidebar = '';
if ( is_page_template( array( 'page-templates/left-sidebar.php', 'page-templates/right-sidebar.php' )) ) {
	$sidebar = '';
}

if(!$disable_layout) {
?>

<section id="<?php echo ($custom_id ); ?>" class="section-list <?php echo ($custom_class ); ?> <?php echo ($active__scroll_container); ?>" style="<?php if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; ?><?php if ($background_color):?>background-color: <?php echo $background_color; ?>;<?php endif; ?>">
    <div class="<?php echo ($container); ?>">
        <div class="row <?php echo (!$item_as_card) ? 'align-items-start' : ''; ?> <?php echo ($invert_content) ? 'text-white' : ''; ?>">
        <?php if ($layout_title || $layout_description || $label):?>
            <div class="col-12 <?php echo ($alignment); ?>">
                <?php if ($label):?>
                    <label class="label"><?php echo $label; ?></label>
                <?php endif;?>
                <?php if ($layout_title):?>
                    <h2 class="heading"><?php echo $layout_title; ?></h2>
                <?php endif;?>
                <?php if ($layout_description && $description_first):?>
                    <div class="section-desc <?php echo ($align_center == true) ? 'mx-auto' : ''; ?> mb-4"><?php echo $layout_description; ?></div>
                <?php endif;?>
            </div>
        <?php endif;?>
        <?php if( have_rows( 'list' ) ):?>
            <?php while ( have_rows('list')) : the_row();
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $card_background = get_sub_field('card_background');
                $list_custom_class = get_sub_field('item_custom_class');
                $list_item_effect_orientation = get_sub_field('list_item_effect_orientation');
                $list_item_effect_offset = get_sub_field('list_item_effect_position_offset');
                $list_item_effect_rotate = get_sub_field('list_item_effect_rotate');
                $list_item_effect_rotate_angle = get_sub_field('list_item_effect_rotate_angle');
                $list_item_effect_scale = get_sub_field('list_item_effect_scale');
                $list_item_effect_scale_factor = get_sub_field('list_item_effect_scale_factor');
                $list_item_effect_start_position_opacity = get_sub_field('list_item_effect_start_position_opacity');
                $active_scroll_element = '';
                if($list_item_scroll_effects == true && $scroll_me == true) {
                    $active_scroll_element = "animateme";
                    $active_list_item_scroll_effects = "data-when='enter' data-from='1' data-to='0' data-opacity='$list_item_effect_start_position_opacity'  $list_item_effect_orientation='$list_item_effect_offset' $list_item_effect_rotate='$list_item_effect_rotate_angle' $list_item_effect_scale='$list_item_effect_scale_factor' data-easeinout='1'";
                }
                ?>
                <div class="list-item col-12 <?php echo ($column); ?> d-flex <?php echo ($check_container == true) ? ''.$vertical_offset.'' : 'px-0'; ?> <?php echo ($active_scroll_element); ?> <?php echo ($list_custom_class); ?> <?php echo ($break_item) ? 'break-list' : ''; ?>" <?php echo $active_list_item_scroll_effects; ?>>
                    <div class="<?php echo ($item_as_card) ? 'card' : ''; ?> <?php echo ($check_container == true) ? 'list-item-content' : 'py-5 px-3 p-sm-5'; ?> w-100 d-flex <?php if (!$item_as_card):?><?php echo ($break_item) ? 'flex-column flex-lg-row' : ''; ?><?php endif;?> align-items-start" style="background-color: <?php echo $card_background; ?>;">
                        <?php if ($item_as_card):?>
                            <div class="card-body w-100 d-flex <?php echo ($break_item) ? 'flex-column flex-lg-row' : ''; ?> align-items-start">
                        <?php endif;?>
                            <?php if ($image):?>
                            <div class="img-wrapper <?php echo ($order); ?> <?php echo ($order == 'order-default') ? $class_group : $class_group ; ?>">
                                <img width="200" height="200" class="mx-auto <?php echo $lazy; ?>" <?php echo ($src_source .'="'. esc_url($image['url']) .'"'); ?> alt="<?php echo esc_attr($image['title']); ?>"/>
                            </div>
                            <?php endif;?>
                            <div class="flex-1 <?php echo ($title && !$description) ? 'align-self-center' : ''; ?>">
                                <?php if ($title):?>
                                    <?php echo ($layout_title) ? '<h3' : '<h2'; ?> class="<?php echo ($title_class); ?> <?php echo ($title && !$description) ? 'mb-0' : ($title_class == 'h6' ? 'mb-0' : ''); ?>"><?php echo $title; ?><?php echo ($layout_title) ? '</h3>' : '</h2>'; ?> 
                                <?php endif;?>
                                <?php if ($description):?>
                                    <div class="item-description"><?php echo $description; ?></div>
                                <?php endif;?>
                            </div>
                        <?php if ($item_as_card):?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php  endwhile; ?>
        <?php else : ?>
            <!-- // no layouts found -->
        <?php endif; ?>
        <?php if ($layout_description && !$description_first):?>
            <div class="col-12 section-desc <?php echo ($align_center == true) ? 'mx-auto' : ''; ?> mt-5"><?php echo $layout_description; ?></div>
        <?php endif;?>
        </div>
    </div>
</section>
<?php 
}
