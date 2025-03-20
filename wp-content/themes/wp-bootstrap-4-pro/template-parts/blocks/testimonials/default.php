<?php

// *Repeater
// testimonials_carousel_repeater
// *Sub-Fields
// carousel_image
// carousel_text

// Default template

include 'vars.php';
?>

<div class="row">
	<?php if ( $layout_title || $label ): ?>
		<div class="col-12 mb-5 text-center">
			<?php if ( $label ):?>
				<label class="label"><?php echo $label; ?></label>
			<?php endif;?>
			<?php if ( $layout_title ):?>
			<h2 class="heading"><?php echo $layout_title; ?></h2>
			<?php endif;?>
			<?php if ( $description ):?>
			<div class="section-desc mx-auto"><?php echo $description; ?></div>
			<?php endif;?>
		</div>
	<?php endif;?>
</div>		
<?php // check if the repeater field has rows of data
	if( have_rows('testimonials_carousel_repeater') ):

	echo	 '<div id="testimonial_carousel" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">';
	
	// loop through the rows of data for the tab header
	$i = 0; // Set the increment variable
	while ( have_rows('testimonials_carousel_repeater') ) : the_row();
		$slide_image = get_sub_field('slide_image');
		$slide_title = get_sub_field('slide_title');
		$slide_position = get_sub_field('slide_position');
		$slide_description = get_sub_field('slide_description');

	?>
	
	<div class="carousel-item slide-item-<?php echo $i;?> <?php if($i == 0) echo 'active';?>" role="option">
		<div class="row align-items-center justify-content-center;" style="flex-grow: 1;">
			<div class="col-md-10 col-lg-8 mx-auto text-center">
				<div class="card text-white" style="border-radius: 16px;">
					<div class="card-body">
					<?php if ($slide_image):?>
						<img width="100px" height="100px" class="slide-img mx-auto mb-4 border" src="<?php echo esc_url($slide_image['url']) ;?>" alt="<?php echo esc_attr($slide_image['title']); ?>" style="border-radius: 100px;"/>
					<?php endif;?>
					<?php if( $slide_title ): ?>
						<h3 class="slide-title h4 text-uppercase mb-2"><?php echo $slide_title; ?></h3>
					<?php endif; ?>
					<?php if( $slide_position ): ?>
						<p class="slide-position small text-uppercase mb-0" style="color: rgba(0,0,0,0.37);"><?php echo $slide_position; ?></p>
					<?php endif; ?>
					<?php if( $slide_description ): ?>
						<div class="slide-desc mt-2"><?php echo $slide_description; ?></div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
				
	<?php   $i++; // Increment the increment variable

	endwhile; //End the loop 
	echo '</div>';
	$i = 0; // Set the increment variable
	
	echo '<ol class="carousel-indicators">';
			
	// loop through the rows of data for the tab header
	while ( have_rows('testimonials_carousel_repeater') ) : the_row();
	
		$slide_image = get_sub_field('slide_image');
		$slide_title = get_sub_field('slide_title');
	?>
	
	<li class="" style="text-indent:0" data-target="#testimonial_carousel" data-slide-to="<?php echo $i;?>" class="<?php if($i == 0) echo 'active';?>">
	<!-- <img width="" height="" src="<?php //echo $slide_image['url']; ?>" /> -->
	</li>
			
	<?php   $i++; // Increment the increment variable	
	
	endwhile; //End the loop  
		
	echo '</ol>';
	
	echo '<a class="carousel-control-prev" href="#testimonial_carousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#testimonial_carousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>';

else :

	// no rows found

	endif; ?>
