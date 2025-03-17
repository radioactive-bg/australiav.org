<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WP_Bootstrap_4
 */

if ( ! function_exists( 'wp_bootstrap_4_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function wp_bootstrap_4_posted_on() {
		$time_string = __( 'Posted on: ', 'wp-bootstrap-4' ) . '<b><time class="entry-date published updated" datetime="%1$s">%2$s</time></b>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = __( 'Posted on: ', 'wp-bootstrap-4' ) . '<b><time class="entry-date published" datetime="%1$s">%2$s</time></b>';
		} 
		if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) ) {
			$time_string =__( 'Posted on: ', 'wp-bootstrap-4' ) . '<b><time class="entry-date published" datetime="%1$s">%2$s</time></b>, '. __( 'Updated on: ', 'wp-bootstrap-4' ) . '<b><time class="updated" datetime="%3$s">%4$s</time></b>';
		} 

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			// esc_html_x( 'Posted on %s', 'post date', 'wp-bootstrap-4' ),
			'<span>' . $time_string . '</span>',
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'wp-bootstrap-4' ),
			'<span class="author x-card"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'wp_bootstrap_4_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function wp_bootstrap_4_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) { 
			$categories = get_the_category();
			$tags = get_the_tags();

			if ( ! is_single() ) {
				// Display categories with ACF brand colors
				if ( ! empty( $categories ) ) {
					foreach ( $categories as $category ) {
						$term_id = $category->term_id;
						$brand_color = get_field( 'brand_color', 'term_' . $term_id );
						?>
						<span class="cat-links badge badge-pill" 
							style="background-color: <?php echo esc_attr( $brand_color ? $brand_color : 'var(--dark)' ); ?>;">
							<a href="<?php echo esc_url( get_category_link( $term_id ) ); ?>" 
							title="<?php echo esc_html($category->name); ?>" 
							rel="category" 
							class="text-white text-decoration-none">
								<?php echo esc_html( $category->name ); ?>
							</a>
						</span>
						<?php
					}
				}
			} else {
				// Display categories with ACF brand colors
				if ( ! empty( $categories ) ) {
					foreach ( $categories as $category ) {
						$term_id = $category->term_id;
						$brand_color = get_field( 'brand_color', 'term_' . $term_id );
						?>
						<span class="cat-links badge badge-pill" 
							style="background-color: <?php echo esc_attr( $brand_color ? $brand_color : 'var(--dark)' ); ?>;">
							<a href="<?php echo esc_url( get_category_link( $term_id ) ); ?>" 
							title="<?php echo esc_html($category->name); ?>" 
							rel="category" 
							class="text-white text-decoration-none">
								<?php echo esc_html( $category->name ); ?>
							</a>
						</span>
						<?php
					}
				}

				// Display tags with ACF brand colors
				if ( ! empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$term_id = $tag->term_id;
						$brand_color = get_field( 'brand_color', 'term_' . $term_id );
						?>
						<span class="tags-links badge badge-pill" 
							style="background-color: <?php echo esc_attr( $brand_color ? $brand_color : 'var(--dark)' ); ?>;">
							<a href="<?php echo esc_url( get_tag_link( $term_id ) ); ?>" 
							title="<?php echo esc_html($tag->name); ?>" 
							rel="tag" 
							class="text-white text-decoration-none">
								#<?php echo esc_html( $tag->name ); ?>
							</a>
						</span>
						<?php
					}
				}
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-bootstrap-4' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if ( ! function_exists( 'wp_bootstrap_4_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail or a custom ACF image.
 *
 * Wraps the post thumbnail or ACF image in an anchor element on index views, or a div
 * element when on single views.
 */
function wp_bootstrap_4_post_thumbnail($image) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	$size = 'full'; // Set default image size
	// Determine the attachment ID or fallback to the image URL
	$attachment_id = null;
	if ( $image ) {
		if ( filter_var( $image, FILTER_VALIDATE_URL ) ) {
			$attachment_id = attachment_url_to_postid( $image );
		} else {
			$attachment_id = $image; // Assume it's already an attachment ID
		}
	}
	if ( is_singular() ) : ?>
		<div class="single-post-thumbnail card-header card-header-single px-0 pb-0">
			<?php 
			if ( $image ) {
				// Use the provided ACF image
				if ( $attachment_id ) {
					echo wp_get_attachment_image( $attachment_id, $size, false, array(
						'alt' => get_the_title(),
						'class' => 'feature_img single_feature_img acf-img',
						'fetchpriority' => 'high',
						'data-no-lazy' => '1',
					) );
				} else {
					// Fallback to the image URL directly
					echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( get_the_title() ) . '" class="feature_img single_feature_img acf-img" fetchpriority="high" data-no-lazy="1" />';
				}
			} else {
				// Use the post's featured image
				the_post_thumbnail( 'full', array(
					'class' => 'feature_img single_feature_img',
					'data-no-lazy' => '1',
				) );
			}
			?>
		</div><!-- .post-thumbnail -->
	<?php else : ?>
		<!-- Not Singular -->
		<a class="card-header card-header-archive px-0 pb-0" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php 
			if ( $image ) {
				// Use the provided ACF image
				if ( $attachment_id ) {
					echo wp_get_attachment_image( $attachment_id, 'medium', false, array(
						'alt' => the_title_attribute( array( 'echo' => false ) ),
					) );
				} else {
					// Fallback to the image URL directly
					echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( the_title_attribute( array( 'echo' => false ) ) ) . '" class="feature_img acf-img" />';
				}
			} else {
				// Use the post's featured image
				the_post_thumbnail( 'medium', array(
					'alt' => the_title_attribute( array( 'echo' => false ) ),
				) );
			}
			?>
		</a>
	<?php endif; // End is_singular()
}
endif;


if ( ! function_exists( 'wp_bootstrap_4_acf_post_grid_thumbnail' ) ) :
function wp_bootstrap_4_acf_post_grid_thumbnail($image, $size, $blog_grid_link_text) { ?>
	<a class="card-header card-header-archive px-0 pb-0" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ); ?> <?php echo get_the_title(); ?>" >
		<?php 
		if ($image) :
		    // Convert URL to attachment ID if needed
			$attachment_id = attachment_url_to_postid($image);

			// Check the customizer setting to determine whether to remove 'srcset' and 'sizes'
			$remove_srcset = get_theme_mod('remove_srcset', true); // Assuming 'remove_srcset' is the ID of your Kirki field

			if ($attachment_id) {
				// Conditionally add the filter based on the Kirki setting
				if ($remove_srcset) {
					add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment, $size) use ($attachment_id) {
						if ($attachment->ID == $attachment_id) {
							unset($attr['srcset']);
							unset($attr['sizes']);
						}
						return $attr;
					}, 10, 3);
				}

				// Output the image
				echo wp_get_attachment_image($attachment_id, $size, false, array(
					'alt' => get_the_title(),
					'class' => 'feature_img acf-img size-' . $size,
				));

				// Clean up the filter after use if it was added
				if ($remove_srcset) {
					remove_filter('wp_get_attachment_image_attributes', 'custom_remove_srcset_sizes');
				}
			} else {
				// If no attachment ID is found, output the image URL directly
				echo '<img src="' . esc_url($image) . '" alt="' . esc_attr(get_the_title()) . '" class="feature_img acf-img size-' . $size . '" />';
			}

		else:  
		    echo wp_get_attachment_image( get_post_thumbnail_id(), $size, false, array('class' => 'feature_img size-'.$size.''));
		endif;
		?>
	</a>
<?php }
endif;

function wp_bootstrap_4_posts_link() {
	$blog_grid_link_text = esc_html__( 'Continue Reading', 'wp-bootstrap-4' );
	// Custom Styles from Post Grid Button
    $blog_grid_btn_style_classes =  get_theme_mod( 'blog_grid_btn_style_classes', 'btn-primary btn-sm');
	?>
	<a class="btn <?php echo $blog_grid_btn_style_classes ; ?> mt-auto" href="<?php the_permalink(); ?>" title="<?php echo wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ); ?> <?php echo the_title(); ?>">
	<?php echo wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ); ?>
	<img class="ml-1" width="16px" height="16px" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/bootstrap-icons/arrow-up-' . (is_rtl() ? 'left-primary' : 'right-primary') . '.svg'); ?>" alt="icon" style="filter: invert(0); max-width: 24px;"/>
	</a>
	<?php
}

function wp_bootstrap_4_posts_cats() {
	 global $post;
    // Get the categories of the current post
	$categories = get_the_category($post->ID); 
	if (!empty($categories)): ?>
		<div class="row gx-1 mb-2">
		<?php foreach ($categories as $category) {
			$term_id = $category->term_id; // Get category term ID
			$brand_color = get_field('brand_color', 'term_' . $term_id); // Get custom ACF color
			?>
			<div class="col-auto">
				<a class="post-item-cat-link text-white px-2 py-1 small" href="<?php echo esc_url(get_category_link($term_id)); ?>" title="<?php echo esc_html($category->name); ?>" 
				rel="category" 
				style="background-color: <?php echo esc_attr($brand_color ? $brand_color : 'var(--dark)'); ?>;">
					<?php echo esc_html($category->name); ?>
				</a>
			</div>
		<?php }; ?>
		</div>
	<?php endif;
}