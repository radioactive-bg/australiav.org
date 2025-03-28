<?php
if ( $related_products ) : ?>

    <section class="related-products">
        <h2><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h2>
        <?php woocommerce_product_loop_start(); ?>
            <?php foreach ( $related_products as $related_product ) : ?>
                <?php
                $post_object = get_post( $related_product->get_id() );

                setup_postdata( $GLOBALS['post'] =& $post_object );

                // Custom HTML Structure
                ?>
                <li class="custom-product d-flex flex-column <?php echo esc_attr($args['bootstrap_classes']) ; ?> mt-4 mt-lg-5">
                    <div class="product-header-wrapper">
                        <a class="product-img-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php echo woocommerce_get_product_thumbnail(); ?>
                        </a>
						<div class="product-button-holder text-center">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>
                    </div>

                    <div class="product-details text-center">
                        <h3 class="product-title h5 text-dark mt-3">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <span class="price"><?php echo $related_product->get_price_html(); ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php woocommerce_product_loop_end(); ?>
    </section>

<?php
endif;

wp_reset_postdata();
