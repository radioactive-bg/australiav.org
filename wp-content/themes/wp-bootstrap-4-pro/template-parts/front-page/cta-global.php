<?php
$default_cta_label = '';
$default_cta_title = get_bloginfo( 'name' );
$default_cta_lead = get_bloginfo( 'description' );
$front_cta_btn_text = get_theme_mod( 'front_cta_btn_text');
$front_cta_btn_link = get_theme_mod( 'front_cta_btn_link' );
$front_cta_btn_style_classes =  get_theme_mod( 'front_cta_btn_style_classes', 'btn-primary btn-lg')
?>
<?php if( get_theme_mod( 'front_cta_title' ) || get_theme_mod( 'front_cta_label' ) || get_theme_mod( 'front_cta_lead' ) || get_theme_mod( 'front_cta_btn_text' ) ) : ?>
<section id="cta" class="<?php if ( get_theme_mod( 'front_cta_as_parallax', 0 ) ) : ?>cta-global-tall-section border-0<?php else: ?> cta-global-section<?php endif; ?>  section-gutter">
	<?php if ( get_theme_mod( 'front_cta_as_parallax', 0 ) ) : ?>
	<div class="parallax-section">
        <?php if ( get_theme_mod( 'front_cta_double_image_effect', 0 ) ) : ?>
            <div class="content-double parralax-content" data-speed="0.3">
                <div></div>
                <div class="double cta-global-section" data-effect="<?php echo wp_kses_post( get_theme_mod( 'front_cta_double_image_effect_style', '10') ); ?>"></div>
            </div>
        <?php else: ?>
            <div class="cta-global-section parralax-content" data-speed="0.3"></div>
        <?php endif; ?>
    </div>
	<?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg <?php if ( get_theme_mod( 'front_cta_center_content', 1 ) ) : ?>text-center mx-auto<?php endif; ?> align-self-center content-cta">
				<div class="x-card">
					<div class="card-body p-0">
                        <?php if ( !empty(get_theme_mod( 'front_cta_label') )) : ?>
						<label class="label"><?php echo wp_kses_post( get_theme_mod( 'front_cta_label', $default_cta_label ) ); ?></label>
                        <?php endif; ?>
                        <?php if ( !empty(get_theme_mod( 'front_cta_title' ) )) : ?> 
                        <h2 class="heading"><?php echo wp_kses_post( get_theme_mod( 'front_cta_title', $default_cta_title ) ); ?></h2>
                        <?php endif; ?>
                        <?php if ( !empty(get_theme_mod( 'front_cta_lead' ) )) : ?> 
                        <div class="content"><?php echo wp_kses_post( get_theme_mod( 'front_cta_lead', $default_cta_lead ) ); ?></div>
                        <?php endif; ?>
                      <?php if( get_theme_mod( 'front_cta_btn_text' ) ) : ?><a href="<?php echo esc_url( get_theme_mod( 'front_cta_btn_link' ) ); ?>" class="btn <?php echo esc_html( get_theme_mod( 'front_cta_btn_style_class', 'btn-primary btn-lg') ); ?> mt-4" title="<?php echo wp_kses_post( get_theme_mod( 'front_cta_btn_link_title_attr') ); ?>" ><?php echo esc_html( get_theme_mod( 'front_cta_btn_text' ) ); ?></a><?php endif; ?>
					</div>
				</div>
                <?php if( get_theme_mod( 'front_cta_shortcode' ) ) : ?>
                    <?php echo do_shortcode( get_theme_mod( 'front_cta_shortcode' ) );?>
                <?php endif; ?> 
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

