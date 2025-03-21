<?php 
$layout_style = get_sub_field('layout_style');

if( $layout_style == 'style_one' ) {
    get_template_part( 'template-parts/blocks/content-only/skin-1' );
} else {
    get_template_part( 'template-parts/blocks/content-only/default' );
}
?>