<?php
// Check witch skin is set
$layout_style = get_sub_field('layout_style');
// Lazyload images
$lazyload =  get_field('lazyload','options'); 
$lazy = '';
$src_source = 'src';
if($lazyload == true) {
    $lazy = 'lazy';
    $src_source = 'data-src';
}
// End Lazyload images
// 3D Parallax Hover Effect
$parallax_hover =  get_field('parallax_hover','options'); 
// Basic layout fields
$disable_layout = get_sub_field('disable_layout');
$title = get_sub_field('title');
$heading_title_class = get_sub_field('heading_title_class');
$label = get_sub_field('label');
$description = get_sub_field('description');
$text_align = get_sub_field('text_align');
$title_position = get_sub_field('title_position');
$background_color = get_sub_field('background_color');
$background_image = get_sub_field('background_image');
$invert_content = get_sub_field('invert_content');
$image = get_sub_field('image');
$img_bgr = get_sub_field('image_background');
$order = get_sub_field('order');
$image_align = get_sub_field('image_align');
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
// Custom container
$container = get_sub_field('container');
$check_order = '';
$container_fluid = '';
$class_group = '';
if (( get_sub_field('container') == 'container' ) && ( get_sub_field('order') == 'order-default' )){
    $check_order = 'img-first';
    if( $layout_style == 'style_one' ) {
        $class_group = 'col-12 col-lg align-self-center pt-5 pb-0 py-lg-0 pl-4 pr-4 pl-sm-5 pr-lg-3 content-last';
    } else {
         $class_group = 'col-12 col-lg align-self-center pt-5 pb-0 pb-lg-5 pl-4 pr-4 pl-sm-5 pr-lg-3 content-last';
    }
} 
if (( get_sub_field('container') == 'container' ) && ( get_sub_field('order') == 'order-lg-2' )){
    $check_order = 'img-last';
    if( $layout_style == 'style_one' ) {
        $class_group = 'col-12 col-lg align-self-center pt-5 pb-0 py-lg-0 pr-4 pl-4 pr-sm-5 pl-lg-3 content-first';
    } else {
        $class_group = 'col-12 col-lg align-self-center pt-5 pb-0 pb-lg-5 pr-4 pl-4 pr-sm-5 pl-lg-3 content-first';
    }

} 
if ( get_sub_field('container') == 'container-fluid' ) {
    $container_fluid = true ;
    $class_group = 'col-12 col-lg align-self-center py-5 px-4 px-sm-5 content-fluid mx-auto';
} 
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');
?>