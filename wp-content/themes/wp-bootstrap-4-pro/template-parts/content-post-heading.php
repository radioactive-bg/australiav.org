<?php
/**
 * Template part for displaying Post heading
 *
 * @package WP_Bootstrap_4
 */
while ( have_posts() ) : the_post();
	$bg_img_url = get_the_post_thumbnail_url();
	$full_page_title = get_the_title();
    $senter_mode = get_theme_mod( 'center_page_header', 1 );
endwhile;
?>

<section class="full-page-header <?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-full-page-header' : '' ; ?>" <?php if ($bg_img_url) : ?>style="background-image: url('<?php echo esc_url($bg_img_url); ?>')"<?php else: ?> style="background-color: transparent;" <?php endif; ?>>
    <div class="page-header-overlay <?php if ( $bg_img_url ) : ?>bg-overlay<?php endif; ?>">
        <div class="container">
            <div class="row <?php echo $senter_mode ? 'justify-content-center' : '' ;?>">
                <div class="col-12 col-xl-9 d-flex <?php echo $senter_mode ? 'flex-column text-center' : '' ;?> <?php echo ($bg_img_url)? '' : '' ; ?>">
                    <div class="page-header-content">
						<?php if ( 'post' === get_post_type() ) : ?>
						<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
						<?php endif; ?>
                        <h1><?php echo $full_page_title; ?></h1>
                        <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php wp_bootstrap_4_posted_on(); ?>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>