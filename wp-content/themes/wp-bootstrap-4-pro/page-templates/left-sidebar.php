<?php
/*
* Template Name: Left Sidebar
*/

get_header(); ?>

<?php 
if ( get_field( 'heading_page') ) :
        get_template_part( 'template-parts/content', 'heading' );
endif; 
?>

<?php if ( get_field( 'content_page' ) ) : ?>
    <!-- No Page Heading -->
    <?php  if (!get_field( 'heading_page' ) ) : ?>
    <div class="<?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-no-page-header' : 'no-page-header' ; ?>">
    <?php endif; ?>
    <!-- End No Page Heading -->
        <div class="container section-gutter">
            <div class="row">
                <div class="col-lg-8 content-width">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <?php
                            while ( have_posts() ) : the_post();
                                get_template_part( 'template-parts/content', 'page' );
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            endwhile; // End of the loop.
                            // Acf Blocks
                            acf_blocks();
                            ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4 order-lg-first sidebar-width">
                <?php 
                if ( is_active_sidebar( 'sidebar-pages' ) ) {   ?>
                <div class="widget-area sidebar-area card">
                    <?php dynamic_sidebar( 'sidebar-pages' );  ?>
                </div>
                <?php } else {
                    get_sidebar();
                }
                ?>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    <!-- No Page Heading -->
    <?php  if (!get_field( 'heading_page' ) ) : ?>
    </div>
    <?php endif; ?>
    <!-- End No Page Heading -->
<?php endif; ?>

<?php

if ( !get_field( 'content_page' ) ) {
	
	// No Page Heading
    if (!get_field( 'heading_page' ) ) : ?>
        <div class="<?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-no-page-header' : 'no-page-header' ; ?>">
    <?php endif;

        acf_blocks();

	// No Page Heading
    if (!get_field( 'heading_page' ) ) : ?>
        </div>
    <?php endif;

}

if ( get_field( 'show_global_layout' ) ) :
   get_template_part( 'template-parts/front-page/cta-global' );
endif;
get_footer();
