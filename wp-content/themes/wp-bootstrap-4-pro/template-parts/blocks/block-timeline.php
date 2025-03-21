<?php

// *Repeater
// Timeline repeater
// *Sub-Fields
// 
// 
$disable_layout = get_sub_field('disable_layout');
$layout_title = get_sub_field('layout_title');
$label = get_sub_field('layout_label');
$layout_description = get_sub_field('layout_description');
// Image alignment
$alignment = get_sub_field('alignment');
// Invert colors
$invert_content = get_sub_field('invert_content');
// Layout background
$background_color = get_sub_field('background_color');
// Layout background image
$background_image = get_sub_field('background_image');
// Custom container
$container = get_sub_field('container');
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');

if(!$disable_layout) {
?>

<section id="<?php echo $custom_id; ?>" class="section-timeline <?php echo ($custom_class ); ?>" style="<?php if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; ?><?php if ($background_color):?>background-color: <?php echo $background_color; ?>;<?php endif; ?>">
    <div class="<?php echo ($container); ?>">
        <div class="row <?php echo ($invert_content) ? 'text-white' : ''; ?>">
        <?php if ( $layout_title || $layout_description || $label ):?>
            <div class="col-12 mb-5 <?php echo ($alignment); ?>">
                <?php if ($label): ?>
                    <label class="label"><?php echo $label; ?></label>
                <?php endif;?>
                <?php if ($layout_title): ?>
                    <h2 class="heading <?php echo ($invert_content) ? 'text-white' : ''; ?>"><?php echo $layout_title; ?></h2>
                <?php endif;?>
                <?php if ( $layout_description ): ?>
                    <div class="content"><?php echo $layout_description; ?></div>
                <?php endif;?>
            </div>
        <?php endif;?>
		<?php if( have_rows('timeline_repeater') ): ?>
				<div class="timeline-container col-12">
					<?php $i=0; while ( have_rows('timeline_repeater') ) : the_row(); 
					     $title = get_sub_field('timeline_title');
						 $content = get_sub_field('timeline_content');
					    ?>
					    <div class="card timeline-block timeline-block-<?php echo $i;?> my-5">
						  <div class="card-body d-flex timeline-content">
							<?php if ( $title ): ?><h3 class="h4"><?php echo $title ; ?></h3><?php endif;?>
					       <?php if ( $content ): ?><div class="pl-3"><?php echo $content ?></div><?php endif;?>
						  </div>
					   </div>
					<?php $i++; endwhile; ?>
				</div>
		<?php endif; ?>
        </div>
    </div>
</section>
<?php 
}