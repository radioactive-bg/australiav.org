<?php
// *Repeater
// hero_carousel_repeater
// *Sub-Fields
// carousel_image
// carousel_text
// check if the repeater field has rows of data
// Custom id

$disable_layout = get_sub_field('disable_layout');
$custom_id = get_sub_field('custom_id');
$custom_class = get_sub_field('custom_class');
$background_image = get_sub_field('background_image');
$background_color = get_sub_field('background_color');
$invert_slides = get_sub_field('invert_slides');
$invert_controls = '';
if ($invert_slides == true){
	$invert_controls = 'invert-controls';
}
// Content alignment
$alignment = get_sub_field('alignment');
$align_center = '' ;
if ( get_sub_field('alignment') == 'text-center' ) {
    $align_center = true ;
} 
$show_thumbs = get_sub_field('show_thumbs');
$crossfade = get_sub_field('crossfade');
$has_fade = '';
if ($crossfade == true){
	$has_fade = 'carousel-fade';
}
$slider_height = get_sub_field('slider_height');
$slides_interval = get_sub_field('slides_interval');

if(!$disable_layout) {
?>
<section id="<?php echo ($custom_id ); ?>" class="section-hero-slider <?php echo ($custom_class ); ?>" style="<?php if ($background_image):?>background-image: url('<?php echo $background_image;?>');<?php endif; ?> <?php if ($background_color):?>background-color:<?php echo $background_color;?>;<?php endif; ?>">
<?php
if( have_rows('hero_carousel_repeater') ):
	echo '<div id="carousel-'.$custom_id.'" class="carousel slide '.$has_fade.'" data-ride="carousel" data-interval="'.$slides_interval.'" data-touch="true"><div class="carousel-inner" role="listbox">';
 	// loop through the rows of data for the tab header
 	$i = 0; // Set the increment variable
    while ( have_rows('hero_carousel_repeater') ) : the_row();
		$slide_image = get_sub_field('slide_image');
		$slide_background = get_sub_field('slide_background');
		$slide_extra_image = get_sub_field('slide_extra_image');
		$slide_title = get_sub_field('slide_title');
        $slide_description = get_sub_field('slide_description');
        $slide_cta_label = get_sub_field('slide_cta_label');
        $slide_cta_link = get_sub_field('slide_cta_link');
	?>
	 <div class="carousel-item carousel-item-<?php echo $i;?> <?php if($i == 0) echo 'active';?>" role="option" style="<?php if( $slide_image ): ?>background-image: url('<?php echo $slide_image['url']; ?>');<?php endif; ?> background-color:<?php echo $slide_background; ?>;">
	 	<div class="container d-flex align-items-center section-gutter" style="min-height:<?php echo $slider_height;?>vh;">	
        	<div class="row align-items-center" style="flex-grow: 1;">
				<?php if($slide_extra_image && $align_center != true): ?>
				<div class="slide-extra-img col-12 col-lg-6 text-center order-lg-2">
					<img class="mx-auto" width="1000" height="1000" src="<?php echo $slide_extra_image['url']; ?>" alt="<?php echo $slide_extra_image['title']; ?>"/>
				</div>
				<?php endif; ?>
            	<div class="slide-content d-flex flex-wrap <?php echo ($align_center == true) ? 'col-md-8 mx-auto' : 'col-12 col-lg-7 col-xl-7'; ?> <?php echo ($alignment); ?> <?php echo ($invert_slides) ? 'text-white' : ''; ?>">
					<?php if( $slide_title ): ?>
						<h1 data-animation="animated fadeInUp" class="slide-title jumbotron-heading w-100"><?php echo $slide_title; ?></h1>
					<?php endif; ?>
					<?php if( $slide_description ): ?>
						<div data-animation="animated fadeInUp" class="slide-desc order-first text-dark"><?php echo $slide_description; ?></div>
					<?php endif; ?>
					<?php if( $slide_cta_label ): ?>
						<a data-animation="animated fadeInUp" class="slide-cta btn btn-primary mt-4" href="<?php echo $slide_cta_link; ?>" title="<?php echo $slide_title; ?>"><?php echo $slide_cta_label; ?></a>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>        
	<?php   $i++; // Increment the increment variable
	endwhile; //End the loop 
	echo '</div>';
	if ($show_thumbs): // if thumbs indicators
	$i = 0; // Set the increment variable
	echo '<div class="container mx-auto position-relative"><ol class="carousel-indicators d-flex flex-wrap flex-md-nowrap">';
	// loop through the rows of data for the tab header
    while ( have_rows('hero_carousel_repeater') ) : the_row();
    	$slide_image = get_sub_field('slide_image');
		$thumbs_content = get_sub_field('thumbs_content');
		$slide_title = get_sub_field('slide_title');
    ?>
    <li class="indicator-<?php echo $i;?> w-100 h-100 col-12 col-lg mt-3 <?php if($i == 0) echo 'active';?>" style="text-indent:0;">
		<div class="card">
			<div class="slide-target w-100 h-100" style="position:absolute;" data-target="#carousel-<?php echo $custom_id;?>" data-slide-to="<?php echo $i;?>"></div>
			<div class="card-body">
				<?php 
				if($thumbs_content){
					echo $thumbs_content;  
				} else {
					if($slide_title): ?>
						<div class="h6"><?php echo $slide_title; ?></div>
					<?php 
					endif; 
					if($slide_image): ?>
						<img width="580" height="275" src="<?php echo $slide_image['url']; ?>"/>
					<?php 
					endif;
				} ?>
			</div>
		</div>
    </li>
	<?php  $i++; // Increment the increment variable	
	endwhile; //End the loop  
	echo '</ol></div>';
	endif; // endif thumbs indicators
	echo '<a class="carousel-control-prev" href="#carousel-'.$custom_id.'" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon '.$invert_controls.'" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carousel-'.$custom_id.'" role="button" data-slide="next">
			    <span class="carousel-control-next-icon '.$invert_controls.'" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
		</div>';
else :
    // no rows found
endif; ?>
</section>
<?php 
}