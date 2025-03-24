<?php

if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
}
else {
    if ( ! is_page_template() ) {
        get_header();
        if ( get_field( 'hide_customizer_layouts' ) ) :
            get_template_part( 'template-parts/front-page/cover' );
            get_template_part( 'template-parts/front-page/services' );
        endif;
        
        ?>

        <?php if ( get_field( 'content_page' ) ) : ?>
        <section class="main-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <h1 class="mb-4"><?php the_title(); ?></h1>
                            <?php wp_bootstrap_4_post_thumbnail($image = null); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
      
        <?php
        acf_blocks();
        if ( get_field( 'show_global_layout' ) ) :
            get_template_part( 'template-parts/front-page/cta-global' );
        endif;
        
        get_footer();
    }
    else {
        include( get_page_template() );
    }
}
?>
