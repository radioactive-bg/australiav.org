<?php
include 'vars.php';
if(!$disable_layout) {
?>

<section id="<?php echo ($custom_id ); ?>" class="section-content-within <?php echo ($custom_class ); ?>">
	<div class="<?php echo ($container ); ?>">
		<div class="row">
			<div class="col-12 col-lg <?php echo ($text_align); ?> <?php echo ($invert_content) ? 'text-white' : ''; ?> align-self-center">
				<div class="section card py-5" style="<?php if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; ?><?php if ($background_color):?>background-color:<?php echo $background_color;?>;<?php endif; ?>">
					<div class="card-body py-0 px-3 px-lg-5">
						<?php if ($label):?>
							<label class="label"><?php echo $label; ?></label>
						<?php endif;?>
						<?php if ($title):?>
							<h2 class="<?php echo $heading_title_class; ?>"><?php echo $title; ?></h2>
						<?php endif;?>
						<?php if ($description):?>
							<div class="content section-desc"><?php echo $description; ?></div>
						<?php endif;?>
						<?php if( $link ): ?>
							<a class="btn <?php echo ($link_style .' '. $link_size); ?> <?php if ($description):?>mt-4<?php endif;?>" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo $link_custom_title ? ''. $link_custom_title .'' : '' .esc_attr( $link_title ).''; ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
						<?php if( $extra_link ): ?>
							<a class="btn <?php echo ($extra_link_style .' '. $extra_link_size); ?> <?php if ($description):?>mt-4<?php endif;?> ml-3" href="<?php echo esc_url( $extra_link_url ); ?>" title="<?php echo $extra_link_custom_title ? ''. $extra_link_custom_title .'' : '' .esc_attr( $extra_link_title ).''; ?>" target="<?php echo esc_attr( $extra_link_target ); ?>"><?php echo esc_html( $extra_link_title ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
}
