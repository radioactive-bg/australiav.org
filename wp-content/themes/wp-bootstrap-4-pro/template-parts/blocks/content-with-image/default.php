<?php
include 'vars.php';
if(!$disable_layout) {
?>

<section id="<?php echo ($custom_id ); ?>" class="section-content-img <?php echo ($custom_class ); ?>" style="<?php if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; ?><?php if ($background_color):?>background-color: <?php echo $background_color; ?>;<?php endif; ?>">
    <div class="<?php echo ($container ); ?>">
        <div class="row">
			<?php if ($title && $title_position):?>
			<div class="col-12 mb-4">
				 <h2 class="<?php echo $heading_title_class; ?>"><?php echo $title; ?></h2>
			</div>
            <?php endif;?>
            <?php if ($image):?>
            <div class="img-wrapper col-12 col-lg-6 <?php echo ($order); ?> <?php echo ($img_bgr) ? 'img-bgr-wrapper px-0 ' : ''.$image_align.''; ?> <?php echo ($parallax_hover) ? '' : 'align-self-center'; ?>">
                <?php if ($parallax_hover):?>
                    <div class="atvImg">
                        <div class="atvImg-layer" data-img="<?php echo esc_url($image['url']) ;?>"></div>
                    </div>
                <?php else: ?>
                    <img width="605" height="436" class="<?php echo ($img_bgr) ? 'img-bgr' : 'mx-auto'; ?> <?php echo $lazy; ?>" <?php echo ($src_source .'="'. esc_url($image['url']) .'"'); ?> alt="<?php echo esc_attr($image['title']); ?>"/>
                <?php endif; ?>
            </div>
            <?php endif;?>
            <div class="<?php echo ($text_align); ?> <?php echo ($invert_content) ? 'text-white' : ''; ?> <?php echo  $class_group; ?>">
                <?php if ($label):?>
                    <label class="label"><?php echo $label; ?></label>
                <?php endif;?>
                <?php if ($title && !$title_position):?>
                    <h2 class="<?php echo $heading_title_class; ?>"><?php echo $title; ?></h2>
                <?php endif;?>
                <?php if ($description):?>
                    <div class="content"><?php echo $description; ?></div>
                <?php endif;?>
                <?php if( $link ): ?>
                    <a class="btn <?php echo ($link_style .' '. $link_size); ?> mt-4" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo $link_custom_title ? ''. $link_custom_title .'' : '' .esc_attr( $link_title ).''; ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
                <?php if( $extra_link ): ?>
                    <a class="btn <?php echo ($extra_link_style .' '. $extra_link_size); ?> mt-4 ml-3" href="<?php echo esc_url( $extra_link_url ); ?>" title="<?php echo $extra_link_custom_title ? ''. $extra_link_custom_title .'' : '' .esc_attr( $extra_link_title ).''; ?>" target="<?php echo esc_attr( $extra_link_target ); ?>"><?php echo esc_html( $extra_link_title ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php 
}