<?php
$default_cover_label = '';
$default_cover_title = get_bloginfo( 'name' );
$default_cover_lead = get_bloginfo( 'description' );
$front_cover_title_color = get_theme_mod( 'front_cover_title_color', 'text-primary' ); 
$front_cover_lead_color = get_theme_mod( 'front_cover_lead_color', 'text-white' ); 
$front_cover_btn_style_classes =  get_theme_mod( 'front_cover_btn_style_classes', 'btn-primary btn-lg');
$front_cover_second_btn_style_classes =  get_theme_mod( 'front_cover_second_btn_style_classes', 'btn-outline-primary btn-lg');
$data_depth =  get_theme_mod( 'front_cover_as_parallax_data_depth', 0.3);
$typewriter =  get_field('typewriter','options');
?>

<?php if ( get_theme_mod( 'front_cover_type', 'image' ) === 'image' ) : ?>
    <section id="hero" class="<?php if ( get_theme_mod( 'front_cover_as_parallax', 0 ) ) : ?><?php else: ?>jumbotron<?php endif; ?> d-flex <?php if($typewriter): ?>has-typewriter-effect<?php endif; ?>" style="min-height: <?php echo get_theme_mod( 'front_cover_section_height', 96); ?>vh">
		<?php if ( get_theme_mod( 'front_cover_as_parallax', 0 ) ) : ?>
		<div data-depth="<?php echo $data_depth; ?>" data-type="parallax" class="parallax-section jumbotron">
            <?php get_template_part( 'template-parts/front-page/cover-element' ); ?>
        </div>
		<?php endif; ?>
        <div class="jumbo-overlay w-100 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="jumbotron-content col <?php if ( get_theme_mod( 'front_cover_center_content', 1 ) ) : ?>text-center mx-auto<?php endif; ?>" style="max-width: <?php echo get_theme_mod( 'front_cover_content_width', 1920); ?>px">
                        <?php if( !empty(get_theme_mod( 'front_cover_label' ) )) : ?>
                        <label class="jumbotron-label label"><?php echo wp_kses_post( get_theme_mod( 'front_cover_label', $default_cover_label ) ); ?></label>
                        <?php endif; ?>
                        <?php if( get_theme_mod( 'front_cover_title' ) ) : ?>
                        <h1 class="jumbotron-heading <?php echo $front_cover_title_color ; ?> <?php if( get_theme_mod( 'front_cover_lead' ) ) : ?>mb-4<?php endif; ?>" <?php if($typewriter): ?>data-text='["<?php echo wp_kses_post( get_theme_mod( 'front_cover_title', $default_cover_title ) ); ?>"]' style="opacity: 0;"<?php endif; ?>><?php echo wp_kses_post( get_theme_mod( 'front_cover_title', $default_cover_title ) ); ?></h1>
                        <?php endif; ?>
                        <?php if( get_theme_mod( 'front_cover_lead' ) ) : ?>
                        <p class="jumbotron-description lead font-weight-normal <?php echo $front_cover_lead_color ; ?>"><?php echo wp_kses_post( get_theme_mod( 'front_cover_lead', $default_cover_lead ) ); ?></p>
                        <?php endif; ?>
                        <?php if( get_theme_mod( 'front_cover_btn_text' ) ) : ?>
                        <a class="jumbotron-cta btn <?php echo esc_html($front_cover_btn_style_classes); ?> mt-4 mr-2 mr-sm-3" href="<?php echo esc_url( get_theme_mod( 'front_cover_btn_link' ) ); ?>" title="<?php echo wp_kses_post( get_theme_mod( 'front_cover_btn_link_title_attr') ); ?>">
                             <?php if( get_theme_mod( 'front_cover_btn_img' ) ) : ?>
                             <img width="30" height="30" class="mr-2" src="<?php echo esc_html( get_theme_mod( 'front_cover_btn_img' ) ); ?>" alt="icon-<?php echo esc_html( get_theme_mod( 'front_cover_btn_text' ) ); ?>" style="width: <?php echo get_theme_mod( 'front_cover_btn_img_width', 30); ?>px"/>
                             <?php endif; ?> 
                             <?php echo esc_html( get_theme_mod( 'front_cover_btn_text' ) ); ?>
                        </a>
                        <?php endif; ?>
                        <?php if( get_theme_mod( 'front_cover_second_btn_text' ) ) : ?>
                        <a class="jumbotron-cta btn <?php echo esc_html($front_cover_second_btn_style_classes); ?> mt-4" href="<?php echo esc_url( get_theme_mod( 'front_cover_second_btn_link' ) ); ?>" title="<?php echo wp_kses_post( get_theme_mod( 'front_cover_second_btn_link_title_attr') ); ?>">
                             <?php if( get_theme_mod( 'front_cover_second_btn_img' ) ) : ?>
                             <img width="30" height="30" class="mr-2" src="<?php echo esc_html( get_theme_mod( 'front_cover_second_btn_img' ) ); ?>" alt="icon-<?php echo esc_html( get_theme_mod( 'front_cover_second_btn_text' ) ); ?>" style="width: <?php echo get_theme_mod( 'front_cover_second_btn_img_width', 30); ?>px"/>
                             <?php endif; ?> 
                            <?php echo esc_html( get_theme_mod( 'front_cover_second_btn_text' ) ); ?>
                        </a>
                        <?php endif; ?>   
                    </div>
					<?php if( get_theme_mod( 'front_cover_shortcode' ) ) : ?>
					<div class="col-12">
					<?php
						echo do_shortcode( get_theme_mod( 'front_cover_shortcode' ) );
					?>
					</div>
					<?php endif; ?> 
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <?php
        echo do_shortcode( get_theme_mod( 'front_cover_slide_shortcode' ) );
    ?>
<?php endif; ?>

