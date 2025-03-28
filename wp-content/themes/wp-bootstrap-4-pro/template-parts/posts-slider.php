<?php

$featured_post_ids = get_theme_mod( 'featured_ids' );
$featured_count = get_theme_mod( 'featured_count', 5 );

if( $featured_post_ids && $featured_post_ids[0]!= '' ) {
	$args = array( 'post_type' => array('post'), 'post__in' => $featured_post_ids, 'showposts' => $featured_count, 'orderby' => 'post__in', 'ignore_sticky_posts' => true );
} else {
	$args = array( 'post_type' => array('post'), 'showposts' => $featured_count, 'ignore_sticky_posts' => true );
}

$featured_query = new WP_Query( $args );

?>

<?php if ( $featured_query->have_posts() ) : ?>
    <div id="posts-slider" class="carousel slide rounded mb-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php $post_counter = 0; ?>
            <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                <li data-target="#posts-slider" data-slide-to="<?php echo esc_attr( $post_counter ); ?>" class="<?php if ( $post_counter === 0 ) : echo "active"; endif; ?>"></li>
                <?php $post_counter++; ?>
            <?php endwhile; ?>
        </ol>
        <div class="carousel-inner rounded">
            <?php $post_counter = 0; ?>
            <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                <?php
                    $feat_image = get_template_directory_uri() . '/assets/images/default.jpg';
                    $feat_img_alt = '';
                    if( has_post_thumbnail() ) {
                        $get_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                        $feat_image = $get_feat_image[0];
                        $feat_img_alt = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
                    }
                    if ( $feat_img_alt === '' ) {
                        $feat_img_alt = get_the_title();
                    }
                ?>
                <div class="carousel-item rounded <?php if ( $post_counter === 0 ) : echo "active"; endif; ?>">
                    <img width="768px" height="400px" class="d-block w-100 rounded" src="<?php echo esc_url( $feat_image ); ?>" alt="<?php echo esc_attr( $feat_img_alt ); ?>">
                    <div class="carousel-caption d-none d-md-flex align-items-end">
                        <div class="w-100 text-center mb-4">
                            <h5><?php the_title(); ?></h5>
                            <p><?php echo esc_html( wp_bootstrap_4_get_short_excerpt( 20 ) ); ?></p>
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'Continue Reading', 'wp-bootstrap-4' ); ?> 
                            <?php if ( is_rtl() ): ?>
                                <img class="ml-1" width="16px" height="16px" src="<?php echo get_template_directory_uri(); ?>/assets/images/bootstrap-icons/chevron-left-white.svg" alt="icon left" style="max-width: 16px;"/>
                            <?php else: ?>
                                <img class="ml-1" width="16px" height="16px" src="<?php echo get_template_directory_uri(); ?>/assets/images/bootstrap-icons/chevron-right-white.svg" alt="icon right" style="max-width: 16px;"/>
                            <?php endif; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php $post_counter++; ?>
            <?php endwhile; ?>
        </div>
        <a class="carousel-control-prev" href="#posts-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"><?php esc_html_e( 'Previous', 'wp-bootstrap-4' ); ?></span>
        </a>
        <a class="carousel-control-next" href="#posts-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"><?php esc_html_e( 'Next', 'wp-bootstrap-4' ); ?></span>
        </a>
    </div>
<?php endif; ?>
