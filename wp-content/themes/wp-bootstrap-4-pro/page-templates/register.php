<?php
/*
* Template Name: Register
*/

if(is_user_logged_in()){
    wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));
} 
get_header(); ?>

<section class="section-register section-gutter">
    <div class="container">
        <div class="row flex-column justify-content-center align-items-center">
            <div class="col-12 text-center">
                <h1 class="h2 heading  text-primary mb-5"><?php esc_html_e( 'Register Now', 'woocommerce' ); ?></h1>
            </div>
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card">
                    <?php do_action( 'woocommerce_before_customer_login_form' );
                        // NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
                        // IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
                    ?>
                    <div class="card-body">
                        <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
                            <?php do_action( 'woocommerce_register_form_start' ); ?>
                            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                            </p>
                            <?php endif; ?>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                            </p>
                            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                                </p>
                            <?php else : ?>
                                <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
                            <?php endif; ?>
    
                            <?php do_action( 'woocommerce_register_form' ); ?>
    
                            <p class="woocommerce-form-row form-row">
                                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                                <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit mt-3" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                            </p>
    
                            <?php do_action( 'woocommerce_register_form_end' ); ?>
                        </form>
                    </div>
                    <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ( get_field( 'content_page' ) ) : ?>
    <div class="container section-gutter">
        <div class="row">

            <div class="col-12">
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
 acf_blocks();
 if ( get_field( 'show_global_layout' ) ) :
	get_template_part( 'template-parts/front-page/cta-global' );
 endif;
get_footer();
