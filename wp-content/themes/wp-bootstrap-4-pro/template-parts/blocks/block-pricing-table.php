<?php
// check if the flexible content field has rows of data

// check if a nested repeater field has rows of data
if( have_rows('pricing_table_repeater') ):
	
//counter
	$i = 0;

// loop through the rows of data
while ( have_rows('pricing_table_repeater') ) : the_row();

	//increase counter
	$i++;

	//fields
	//text field
	$price_table_title = get_sub_field('pricing_table_title');
	//text field
	$pricing_table_price = get_sub_field('pricing_table_price');
	//comma separated items - text area
	$pricing_table_features = get_sub_field('pricing_table_features');
	//text field
	$pricing_table_button = get_sub_field('pricing_table_button');
	//text field
	$pricing_table_link = get_sub_field('pricing_table_link');
	//select field - bootstrap colors
	$pricing_table_color = get_sub_field('pricing_table_color');
	
	//expand features comma separated list
	$features = explode(",", $pricing_table_features);

	echo '<div class="col-md-4">';
		echo '<div class="panel pricing panel-'.$pricing_table_color.'">';
			echo '<div class="panel-heading"><h3 class="text-center">'.$price_table_title.'</h3></div>';
				echo '<div class="panel-body text-center">';
				echo '<p class="lead" style="font-size:40px"><strong>'.$pricing_table_price.'</strong></p>';
			echo '</div>';
					echo '<ul class="list-group list-group-flush text-center">';
						//wrap each feature in a list item
				foreach ($features as $feature => $featued_item) {
					echo '<li class="list-group-item">'. $featued_item. '</li>';
				}
			echo '</ul>';
			echo '<div class="panel-footer text-center">';
				echo '<a class="btn btn-lg  btn-'.$pricing_table_color.'" href="'.$pricing_table_link.'">'.$pricing_table_button.'</a>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	//clear every third table
	if($i % 3 == 0){
			echo '<div class="clearfix"></div>';
		}
			
endwhile;

//content after
echo '<div class="clearfix"></div>';
	
endif;
//end if a nested repeater field has rows of data
   