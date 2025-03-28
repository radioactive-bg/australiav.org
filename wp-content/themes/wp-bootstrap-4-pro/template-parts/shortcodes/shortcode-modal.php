<?php
/**
* Bootstrap ACF While Loop Modals
*/

// *Repeater
// modal_global_repeater
// *Sub-Fields
// modal_header
// modal_body
// modal_link
// ...

if( have_rows('modal_global_repeater', 'option') ):
    // Loop through rows.
    while( have_rows('modal_global_repeater', 'option') ) : the_row();
        // Load sub field value.
        $modal_header = get_sub_field('modal_header');
        $modal_body = get_sub_field('modal_body');
        $modal_link = get_sub_field('modal_link');
        if( $modal_link ):
            $link_url = $modal_link['url'];
            $link_title = $modal_link['title'];
            $link_target = $modal_link['target'] ? $modal_link['target'] : '_self';
        endif;
        $modal_id = get_sub_field('modal_id');
        $modal_active = get_sub_field('modal_active');
        // Checking if modal is active
        if($modal_active == 'yes') {
        ?>
        <!-- The Modal -->
        <div class="modal fade" id="<?php echo $modal_id;?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_id;?>-label" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header px-lg-4 pt-lg-4">
                    <?php if( $modal_header ): ?>
                        <h2 class="modal-title">
                            <?php echo $modal_header;?>
                        </h2>
                    <?php endif; ?>
                    <button type="button" class="close" data-dismiss="modal">✕</button>
                </div>
                <!-- Modal body -->
                <?php if( $modal_body ): ?>
                <div class="modal-body px-lg-4 pb-lg-4">
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
    <?php
    // End checking if modal is active
    }
    // End loop.
    endwhile;
endif;