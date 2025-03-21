<?php
/*
* Template Name: Client Area
*/

get_header();

if (! is_wc_endpoint_url( 'lost-password' )) {
   
} else {
    
}

?>


<?php if ( ! is_user_logged_in() && (! is_wc_endpoint_url( 'lost-password' ))) : ?>
<section class="container login-container section-gutter">
    <div class="row flex-column justify-content-center align-items-center">
        <div class="col-12 text-center">
            <h1 class="h2 heading  text-primary mb-5"><?php esc_html_e( 'Log In', 'woocommerce' ); ?></h1>
        </div>
        <div class="col-12 col-md-8 col-lg-5">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <?php //the_custom_logo(); ?>
                    <div class="w-100 mt-3">
                            <?php echo wc_login_form(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
    <div class="<?php if ( !is_page( array( 'client-zone' ) ) ):  ?>container-fluid<?php else: ?>container <?php endif; ?>">
        <div class="row">
            <?php if ( !is_page( array( 'client-zone' ) ) && (! is_wc_endpoint_url( 'lost-password' )) ):  ?>
            <div class="col-12 col-lg-3 d-none d-lg-block client-zone-sidebar sidebar-width text-center px-0 pt-5 pb-lg-5">
                <?php 
                if ( is_active_sidebar( 'client-zone' ) ) {
                    dynamic_sidebar( 'client-zone' );
                }
                ?>
            </div>
            <?php endif; ?>
            <!-- /.col-lg-4 -->
            <div class="col-12 <?php echo ( !is_page( array( 'client-zone' ) ) ) ? 'col-lg px-0' : 'client-zone-page-content'; ?> client-zone-content content-width">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <?php
                            while ( have_posts() ) : the_post();
                                $bg_img_url = get_the_post_thumbnail_url();
                                $full_page_title = get_the_title();
                            endwhile;
                        ?>
                        <?php if ( !is_page( array( 'client-zone' ) ) ):  ?>
                        <section class="container">
                            <div class="row">
                                <div class="col-12 col-12 d-flex flex-wrap align-items-center py-4">
                                    <?php if ( $bg_img_url ) : ?>
                                        <img width="98px" height="98px" class="mr-3" src="<?php echo esc_url( $bg_img_url ); ?>" alt="<?php echo $full_page_title; ?>" style="max-width: 98px;"/>    
                                    <?php endif; ?>
                                    <h1 class="h2"><?php echo $full_page_title; ?></h1>
                                </div>
                            </div>
                        </section>
                        <?php endif; ?>
                    
                
                        <?php
                        if ( get_field( 'content_page' ) ) { 
                            if ( !is_page( array( 'client-zone' ) ) ) { ?>
                                <div class="col">
                            <?php
                            } 
                            while ( have_posts() ) : the_post();
                                get_template_part( 'template-parts/content', 'page' );
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            endwhile; // End of the loop.
                            if ( !is_page( array( 'client-zone' ) ) ) { ?>
                                </div>
                            <?php
                            } 
                           
                        } 
                        if ( !is_page( array( 'client-zone' ) ) ) {
                            acf_blocks();
                        }
                        ?>

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
            <!-- /.col-lg-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
<?php endif; ?>
<?php

if ( is_user_logged_in() && ( is_page( array( 'client-zone' ) ) )) {
    acf_blocks();
}
if ( get_field( 'show_global_layout' ) ) :
   get_template_part( 'template-parts/front-page/cta-global' );
endif;
get_footer();
