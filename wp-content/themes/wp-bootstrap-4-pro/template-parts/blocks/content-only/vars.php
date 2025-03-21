<?php
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
$title = get_sub_field('title');
$heading_title_class = get_sub_field('heading_title_class');
$label = get_sub_field('label');
$description = get_sub_field('description');
$text_align = get_sub_field('text_align');
$background_color = get_sub_field('background_color');
// Layout background image
$background_image = get_sub_field('background_image');
$as_parallax = get_sub_field('as_parallax');
$invert_content = get_sub_field('invert_content');
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
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');
?>