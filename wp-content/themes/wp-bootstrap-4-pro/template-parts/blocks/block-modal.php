<?php
/**
* Bootstrap ACF While Loop Modals
*/

// *Repeater
// modal_repeater
// *Sub-Fields
// modal_header
// modal_body
// ...

// check if the repeater field has rows of data
$current_user = wp_get_current_user();
$admin = '' ;
if (user_can( $current_user, 'administrator' )) {
	$admin = true ;
}
if ($admin == true) :?>
<section class="section-gutter bg-white">
	<div class="container narrow-container d-flex flex-wrap justify-content-center">
	<h2 class="w-100 text-center mb-3">Modal Repeater</h2>
	<p class="w-100 text-center mb-3">
		This layout is only admin visible! Use example to add button in current page for triggering the modal popup. <br>
		<b style="font-size: 14px;">&lt;a href="#modal_id" class="btn btn-primary mt-3" data-toggle="modal" title="modal title" type="button"&gt;Show Modal&lt;/a&gt;</b> <br>
		Change with your modal item ID.
	</p>
<?php 
endif ;

if( have_rows('modal_repeater') ):
	$i = 1; // Set the increment variable
 	// loop through the rows of data
    while ( have_rows('modal_repeater') ) : the_row();
		
		$modal_header = get_sub_field('modal_header');
		$modal_body = get_sub_field('modal_body');
		$modal_link = get_sub_field('modal_link');
		if( $modal_link ):
			$link_url = $modal_link['url'];
			$link_title = $modal_link['title'];
			$link_target = $modal_link['target'] ? $modal_link['target'] : '_self';
		endif;
		$modal_id = get_sub_field('modal_id');
	?>

	<?php if ($admin == true) :?>
	<!-- Button to Open the Modal -->
	<a type="button" class="btn btn-primary mx-2" data-toggle="modal" href="#<?php echo $modal_id;?>" title="modal-<?php echo $i;?>">
	<?php echo $i;?> | #<?php echo $modal_id;?>
	</a>
	<?php endif; ?>

	<!-- The Modal -->
	<div class="modal fade" id="<?php echo $modal_id;?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_id;?>-label" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	    <div class="modal-content">
	
	      <!-- Modal Header -->
	      <div class="modal-header px-lg-4">
			<?php if( $modal_header ): ?>
				<h4 class="modal-title">
					<?php echo $modal_header;?>
				</h4>
			<?php endif; ?>
	        <button type="button" class="close" data-dismiss="modal">✕</button>
	      </div>
	
	      <!-- Modal body -->
		  <?php if( $modal_body ): ?>
	      <div class="modal-body p-lg-4">
	       <?php echo $modal_body; ?>
	      </div>
		  <?php endif; ?>
	
	      <!-- Modal footer -->
		  <?php if( $modal_link ): ?>
			<div class="modal-footer px-lg-4">
                <a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo esc_attr( $link_title ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			</div>
		  <?php endif; ?>
	    </div>
	  </div>
	</div>
	              
	<?php   $i++; // Increment the increment variable
	
	endwhile; //End the loop 

else :

    // no rows found

endif;

if ($admin == true) :?>
</div>
</section>
<?php 
endif; 