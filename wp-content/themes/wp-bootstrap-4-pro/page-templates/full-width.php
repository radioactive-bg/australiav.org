<?php
/*
* Template Name: Full Width Container
*/

get_header(); ?>

<?php 
if ( get_field( 'heading_page') ) :
        get_template_part( 'template-parts/content', 'heading' );
endif; ?>

<?php if ( get_field( 'content_page' ) ) : ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-12">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', 'page-full' );
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    endwhile; // End of the loop.
                    ?>
                </div>
                <!-- /.col-md-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </main><!-- #main -->
</div><!-- #primary -->
<?php endif; ?>

<?php
acf_blocks();
if ( get_field( 'show_global_layout' ) ) :
   get_template_part( 'template-parts/front-page/cta-global' );
endif;
get_footer();
