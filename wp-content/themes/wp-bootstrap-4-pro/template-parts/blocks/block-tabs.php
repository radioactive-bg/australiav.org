<?php

// *Repeater
// bootstrap_tabs_repeater
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
// tab interface
$tab_interface = get_sub_field('tab_interface');
// Custom container
$container = get_sub_field('container');
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');

if(!$disable_layout) {
?>

<section id="<?php echo $custom_id; ?>" class="section-tabs <?php echo ($custom_class ); ?>" style="<?php if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; ?><?php if ($background_color):?>background-color: <?php echo $background_color; ?>;<?php endif; ?>">
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
		<?php if( have_rows('tabs_repeater') ): ?>
			<div class="col-12 <?php echo $alignment; ?>">
				<ul class="nav <?php echo $tab_interface; ?> w-100" id="nav-<?php echo $custom_id; ?>"  role="tablist">
					<?php $i=0; while ( have_rows('tabs_repeater') ) : the_row(); ?>
						<?php 
							$string = sanitize_title( get_sub_field('tab_title') ); 
						?>
						<li role="presentation" class="nav-item <?php if ($i==0) { ?>active<?php } ?>">
							<a class="nav-link <?php if ($i==0) { ?>active<?php } ?>" href="#<?php echo $string ?>" aria-controls="<?php echo $string ?>" role="tab" data-toggle="tab"><?php the_sub_field('tab_title'); ?></a>
						</li>
					<?php $i++; endwhile; ?>
				</ul>
				<div class="tab-content w-100 py-3 py-lg-4">
					<?php $i=0; while ( have_rows('tabs_repeater') ) : the_row(); ?>
						<?php 
							$string = sanitize_title( get_sub_field('tab_title') ); 
						?>
						<div role="tabpanel" class="tab-pane fade <?php if ($i==0) { ?>show active<?php } ?>" id="<?php echo $string; ?>">
							<h3><?php the_sub_field('tab_title'); ?></h3>
							<?php the_sub_field('tab_content'); ?>
						</div>
					<?php $i++; endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
        </div>
    </div>
</section>
<?php 
}