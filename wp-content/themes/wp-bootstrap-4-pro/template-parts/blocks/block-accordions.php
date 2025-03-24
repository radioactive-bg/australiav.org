<?php

// *Repeater
// bootstrap_accordion_repeater
// *Sub-Fields
// accordion_header
// accordion_content
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

<section id="<?php echo ($custom_id ); ?>" class="section-accordion <?php echo ($custom_class ); ?>" style="<?php if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; ?><?php if ($background_color):?>background-color: <?php echo $background_color; ?>;<?php endif; ?>">
    <div class="<?php echo ($container); ?>">
        <div class="row <?php echo ($invert_content) ? 'text-white' : ''; ?>">
        <?php if ( $layout_title || $layout_description || $label ):?>
            <div class="col-12 mb-3 <?php echo ($alignment); ?>">
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

        <?php if ( have_rows('accordion_repeater') ):
                $i = 1; 
                echo '<div id="accordion-'.$custom_id.'" class="accordion col-12 border-0">';
                while ( have_rows('accordion_repeater') ) : the_row();
                    $header = get_sub_field('accordion_header');
                    $content = get_sub_field('accordion_content');
                ?>
                <div class="card mb-3" style="background-color:#fff;">
                    <div class="card-header border-0" id="heading-<?php echo $i;?>">
						<button class="btn btn-link pl-3 <?php echo is_rtl() ? 'text-right' : 'text-left'; ?>" data-toggle="collapse" data-target="#collapse-<?php echo $custom_id;?>-<?php echo $i;?>" <?php echo ($i == 1) ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?> aria-controls="collapse-<?php echo $custom_id;?>-<?php echo $i;?>">
							<span><?php echo $header; ?></span>
						</button>
                    </div>
                    <div id="collapse-<?php echo $custom_id;?>-<?php echo $i;?>" class="collapse narrow-container <?php echo ($i == 1) ? 'show' : ''; ?>" aria-labelledby="heading-<?php echo $i;?>" data-parent="#accordion-<?php echo $custom_id;?>">
                        <div class="card-body content accordion-item-content pb-4 pt-0 px-3">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>    
                <?php 
                $i++;    
                endwhile; 
                echo '</div>';
else :
                echo 'No accordions found';
            endif; ?>
        </div>
    </div>
</section>
<?php 
}
