<?php
/**
* Bootstrap ACF While Loop Modals
*/

// *Repeater
// header_buttons_repeater
// *Sub-Fields
// cta_link
// custom_class
// image 
// image_visibility
// text_visibility
// btn_active

if( have_rows('header_buttons_repeater', 'option') ):
    // Loop through rows.
    while( have_rows('header_buttons_repeater', 'option') ) : the_row();
        // Load sub field value.
        $cta_link = get_sub_field('cta_link');
        if( $cta_link ):
            $link_url = $cta_link['url'];
            $link_title = $cta_link['title'];
            $link_target = $cta_link['target'] ? $cta_link['target'] : '_self';
        endif;
        $custom_class = get_sub_field('custom_class');
        $image = get_sub_field('image');
        $image_url = get_template_directory_uri().'/assets/images/bootstrap-icons/'.$image.'.svg';
        $image_visibility = get_sub_field('image_visibility');
        $text_visibility = get_sub_field('text_visibility');
        $btn_active = get_sub_field('btn_active');

        // Checking if btn cta is active
        if($btn_active == 'yes') {
        ?>
        <?php if( $cta_link ): ?>
            <a class="btn <?php echo ($custom_class ); ?> align-self-center" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo esc_attr( $link_title ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
            <?php if ($image):?>
                 <img width="20" height="20" class="<?php echo ($image_visibility ); ?> mr-lg-1" src="<?php echo $image_url; ?>" alt="<?php echo esc_attr( $link_title ); ?>" style="width: 20px;"/>      
            <?php endif;?>
                <span class="<?php echo ($text_visibility ); ?>"><?php echo esc_html( $link_title ); ?></span>
            </a>
        <?php endif; ?>
          
    <?php
    // End checking if btn cta is active
    }
    // End loop.
    endwhile;
endif;