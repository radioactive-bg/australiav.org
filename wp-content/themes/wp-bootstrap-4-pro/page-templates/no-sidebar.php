<?php
/*
* Template Name: No Sidebar (Container Width)
*/

get_header(); ?>


<?php 
if ( get_field( 'heading_page') ) :
        get_template_part( 'template-parts/content', 'heading' );
endif; 
?>

<?php if ( get_field( 'content_page' ) ) : ?>
    <div class="container section-gutter">
        <div class="row">
            <div class="col-md-12">
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
                        ?>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
            <!-- /.col-md-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
<?php endif; ?>

<?php 

// No Page Heading
if (!get_field( 'heading_page' ) ) : ?>
    <div class="<?php echo get_theme_mod( 'trans_header', 1 ) ? 'trans-no-page-header' : 'no-page-header' ; ?>">
<?php endif;
// End No Page Heading

    acf_blocks();

// No Page Heading
if (!get_field( 'heading_page' ) ) : ?>
    </div>
<?php endif;
// End No Page Heading

if ( get_field( 'show_global_layout' ) ) :
	get_template_part( 'template-parts/front-page/cta-global' );
endif;

get_footer();
