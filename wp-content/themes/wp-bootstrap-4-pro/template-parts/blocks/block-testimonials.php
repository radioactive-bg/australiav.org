<?php

// *Repeater
// testimonials_carousel_repeater
// *Sub-Fields
// carousel_image
// carousel_text
$disable_layout = get_sub_field('disable_layout');
// Layout background
$background_color = get_sub_field('background_color');
// Layout background image
$background_image = get_sub_field('background_image');
// Invert colors layout
$invert_content = get_sub_field('invert_content');
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');
// Layout styles
$layout_style = get_sub_field('layout_style');

if(!$disable_layout) {
?>

<section id="<?php echo ($custom_id ); ?>" class="section-testimonial <?php echo ($custom_class ); ?>" style="<?php if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; ?><?php if ($background_color):?>background-color:<?php echo $background_color;?>;<?php endif; ?>">
	<div class="narrow-container container <?php echo ($invert_content) ? 'text-white' : ''; ?>">
		<?php 
		if( $layout_style == 'style_one' ) {
			get_template_part( 'template-parts/blocks/testimonials/skin-1' );
		} else {
			get_template_part( 'template-parts/blocks/testimonials/default' );
		}
		?>
	</div>
</section>
<?php 
}
