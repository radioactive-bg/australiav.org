<?php
// Layout Posts
// Lazyload images: Not Used!!!
$lazyload =  get_field('lazyload','options'); 
$lazy = '';
$src_source = 'src';
if($lazyload == true) {
    $lazy = 'lazy';
    $src_source = 'data-src';
}
// End Lazyload images
$disable_layout = get_sub_field('disable_layout');
$title = get_sub_field('title');
$label = get_sub_field('label');
$description = get_sub_field('description');
$text_align = get_sub_field('text_align');
$background_color = get_sub_field('background_color');
// Layout background image
$background_image = get_sub_field('background_image');
$as_parallax = get_sub_field('as_parallax');
$invert_content = get_sub_field('invert_content');
// First button
$link = get_sub_field('button');
$link_style = get_sub_field('button_style');
$link_size = get_sub_field('button_size');
$link_custom_title = get_sub_field('button_title');
if( $link ):
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif;
// Second button
$extra_link = get_sub_field('extra_button');
$extra_link_style = get_sub_field('extra_button_style');
$extra_link_size = get_sub_field('extra_button_size');
$extra_link_custom_title = get_sub_field('extra_button_title');
if( $extra_link ):
    $extra_link_url = $extra_link['url'];
    $extra_link_title = $extra_link['title'];
    $extra_link_target = $extra_link['target'] ? $extra_link['target'] : '_self';
endif;
// Custom container
$container = get_sub_field('container');
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');


// Get ACF fields for the posts block
$filter_by = get_sub_field('filter_by'); // ACF field, either 'by_id' or 'by_slug'
$category_name = get_sub_field('category_name'); // Old field (not used) Field is hidden in function php: acf/load_field/name=category_name

$post_ids = get_sub_field('post_ids');
$num = get_sub_field('num');
$post_type = get_sub_field('post_type') ? get_sub_field('post_type') : 'post';
$class = get_sub_field('class');
$image_size = get_sub_field('image_size');
$image_height = get_sub_field('image_height');
$as_slider = get_sub_field('as_slider');
$as_banner = get_sub_field('as_banner');
$as_banner_first = get_sub_field('as_banner_first');
$as_list = get_sub_field('as_list');
$excerpt = get_sub_field('excerpt');
$with_button = get_sub_field('with_button');
$data_no_lazy = get_sub_field('data_no_lazy');
$row_gutter = get_sub_field('row_gutter');

// Set up the arguments array based on the value of $filter_by
if ($filter_by === 'by_id') {
    // Case 1: By IDs
    $post_ids = get_sub_field('post_ids'); // Assuming this comes from an ACF field
    $args = array(
        'post__in'         => explode(',', $post_ids), // Get posts by IDs from ACF field 'post_ids'
        'posts_per_page'   => $num, // Assuming $num is retrieved from an ACF field
        'post_type'        => $post_type, // Assuming $post_type is from an ACF field
        'post_status'      => 'publish',
        'suppress_filters' => false,
    );
}  elseif ($filter_by === 'by_slug') {
    // Case 2: By Slug (or Category)
    $selected_categories = get_sub_field('category_select'); // Dynamically fetched categories
    $category_ids = array(); // Array to store category IDs

    // Ensure valid categories are retrieved
    if ($selected_categories && is_array($selected_categories)) {
        $category_ids = $selected_categories; // Use the selected categories directly
    }

    // Disable old field logic (commented out):
    // $category_slugs = explode(',', $category_name); // Explode comma-separated category slugs
    // foreach ($category_slugs as $slug) {
    //     $category = get_category_by_slug(trim($slug)); // Get the category by slug
    //     if ($category) {
    //         $category_ids[] = $category->term_id; // Add the category ID to the array
    //     }
    // }

    // If we have valid category IDs, use them in the query
    if (!empty($category_ids)) {
        $args = array(
            'category__in'     => $category_ids, // Use category__in with an array of category IDs
            'posts_per_page'   => $num, // Assuming $num is retrieved from an ACF field
            'post_type'        => $post_type, // Assuming $post_type is from an ACF field
            'post_status'      => 'publish',
            'suppress_filters' => false,
        );
    } else {
        // If no valid categories are found, fetch all posts
        $args = array(
            'posts_per_page'   => $num,
            'post_type'        => $post_type,
            'post_status'      => 'publish',
            'suppress_filters' => false,
        );
    }
}
// Query posts
$cat_posts = get_posts($args);
$blog_grid_link_text = esc_html__( 'Continue Reading', 'wp-bootstrap-4' );

$classes = $class;

if ($data_no_lazy):
    $data_no_lazy_value = '1';
endif;
$slider_class = '';
if ($as_slider):
    $slider_class = 'carousel-slider';
endif;

$grid_row = 'row_as_grid '.$slider_class.'';
if ($as_banner):
    $grid_row = 'row_as_banner '.$slider_class.'';
endif;
if ($as_banner_first):
    $grid_row = 'row_as_banner_first';
endif;
if ($as_list):
    $grid_row = 'row_as_list '.$slider_class.'';
endif;
if ($as_banner_first && $as_list):
    $grid_row = 'row_as_banner_first row_as_list';
endif;
if ($as_banner_first && $as_banner):
    $grid_row = 'row_as_banner_first row_as_banner';
endif;

$as_list_class = '';
$as_list_card_row = '';
$as_banner_class = '';
$post_content = '';

if ($as_banner):
    $as_banner_class = 'as_banner';
endif;

if ($as_list):
    $as_list_class = 'as_list';
    $as_list_card_row = 'flex-md-row';
    $post_content = '';
endif;

if (!$as_banner && !$as_list):
    $post_content = '';
endif;

if ($with_button):
    $button_offset  = 'mb-3';
endif;
if(!$disable_layout) {
?>

<section id="<?php echo esc_attr($custom_id); ?>" class="section-posts <?php echo esc_attr($custom_class); ?> <?php if (!$as_parallax): if($background_image):?><?php echo esc_attr($lazy); ?><?php endif; endif; ?>" <?php if(!$as_parallax && $lazyload): if($background_image) :?>data-bg="<?php echo esc_url($background_image); ?>"<?php endif; endif; ?> style="<?php if ((!$as_parallax && !$lazyload)): if ($background_image):?>background-image: url('<?php echo esc_url($background_image); ?>');<?php endif; endif; ?><?php if ($background_color):?>background-color:<?php echo esc_attr($background_color);?>;<?php endif; ?>">

    <?php if ($as_parallax):?>
        <div class="parallax-section">
             <?php if ($background_image):?><img width="1920" height="1040" class="d-inline-block mx-auto <?php echo esc_attr($lazy); ?>" data-speed="0.3" <?php echo ($src_source .'="'. esc_url($background_image).'"'); ?> alt=""/><?php endif; ?>
        </div>
    <?php endif; ?>
    
    <div class="<?php echo esc_attr($container); ?>">
        <div class="row">
            <div class="col-12 col-lg <?php echo esc_attr($text_align); ?> <?php echo ($invert_content) ? 'text-white' : ''; ?> align-self-center">
                <?php if ($label):?>
                    <label class="label"><?php echo esc_html($label); ?></label>
                <?php endif;?>
                <?php if ($title):?>
                    <h2 class="heading"><?php echo esc_html($title); ?></h2>
                <?php endif;?>
                <?php if ($description):?>
                    <div class="content"><?php echo wp_kses_post($description); ?></div>
                <?php endif;?>

                <?php if ($cat_posts): ?>
                    <div class="row <?php echo esc_attr($grid_row); ?>">
                        <?php foreach ($cat_posts as $key => $post): setup_postdata($post); ?>
                            <?php
                            if (($as_list && $as_banner_first && $key === 0) || ($as_banner && $as_banner_first && $key === 0)) :
                                $as_banner_class = 'as_banner';
                                $classes = 'col-12';
                            elseif ($as_list && $as_banner_first && $key > 0):
                                $as_banner_class = '';
                                $classes = $class;
						    elseif ($as_banner && $as_banner_first && $key > 0):
                                $as_banner_class = 'as_banner';
                                $classes = $class;
                            endif;
                          
                            $image = get_field('feature_img');
                            $size = $image_size;
                            ?>
						    <?php if ($as_banner_first): ?>
						     <!-- Conditional wrapper -->
							    <?php if ($key === 0) { ?>
									<div class="col-lg-5 d-flex"><div class="row <?php echo $row_gutter; ?>">
								<?php } elseif ($key === 1) { ?>
									<div class="col-lg"><div class="row <?php echo $row_gutter; ?>">
								<?php } ?>
	                        <?php endif; ?>
                            <div class="post-item post-item-<?php echo esc_attr($key); ?> <?php echo esc_attr($as_list_class) . ' ' . esc_attr($as_banner_class) . ' ' . esc_attr($classes) . ' d-flex'; ?>">
                                 <?php if ($as_banner || ($as_list && $as_banner_first && $key === 0) || ($as_banner && $as_banner_first && $key > 0)): ?>
                                    <a class="card w-100 border-0" href="<?php the_permalink(); ?>" title="<?php echo wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ); ?>: <?php echo the_title(); ?>" style="padding-top: <?php echo $image_height; ?>%;">
                                <?php else: ?>
									<?php if ($as_banner_first &&  ($as_banner && $key > 0)): ?>
									<?php endif; ?>
                                    <div class="card w-100 <?php echo esc_attr($as_list_card_row); ?> border-0">
                                        <a class="card-header card-header-archive px-0 pb-0" href="<?php the_permalink(); ?>" title="<?php echo wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ); ?> <?php echo the_title(); ?>" style="padding-top: <?php echo $image_height; ?>%;">
                                <?php endif;

                                if ($image):
                                    // Check if $image is a URL and convert it to an attachment ID
                                    if (filter_var($image, FILTER_VALIDATE_URL)) {
                                        $image_id = attachment_url_to_postid($image);
                                    } else {
                                        $image_id = $image; // Assume it's already an attachment ID
                                    }
                                    // If $image_id is valid, use wp_get_attachment_image
                                    if ($image_id) {
                                        // Default attributes for wp_get_attachment_image
                                        $attributes = array(
                                            'alt' => get_the_title(),
                                            'class' => 'feature_img acf-img',
                                        );

                                        // Add 'data-no-lazy' attribute if $data_no_lazy is true
                                        if (!empty($data_no_lazy)) {
                                            $attributes['class'] .= ' no-lazy'; // Add no-lazy class
                                            $attributes['data-no-lazy'] = '1';  // Add data-no-lazy attribute
                                        }
                                        $remove_srcset = get_theme_mod('remove_srcset', true); // Assuming 'remove_srcset' is the ID of your Kirki field
		                                if ($remove_srcset) {
                                            // Remove 'srcset' and 'sizes' dynamically
                                            add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment, $size) use ($image_id) {
                                                if ($attachment->ID == $image_id) {
                                                    unset($attr['srcset']);
                                                    unset($attr['sizes']);
                                                }
                                                return $attr;
                                            }, 10, 3);
                                        }
                                        // Output the image
                                        echo wp_get_attachment_image($image_id, $size, false, $attributes);
                                    } else {
                                        // Fallback: Display the URL directly if not a valid attachment ID
                                        echo '<img src="' . esc_url($image) . '" alt="' . esc_attr(get_the_title()) . '" class="feature_img acf-img" />';
                                    }
                                else:
                                    $image_attributes = array(
                                        'alt' => get_the_title(),
                                        'class' => 'feature_img size-' . esc_attr($size),
                                    );
                                    
                                    // Add 'no-lazy' attributes if $data_no_lazy is true
                                    if (!empty($data_no_lazy)) {
                                        $image_attributes['class'] .= ' no-lazy';
                                        $image_attributes['data-no-lazy'] = '1';
                                    }

                                    // Output the image
                                    echo wp_get_attachment_image(get_post_thumbnail_id(), $size, false, $image_attributes);
                                endif;
                                ?>
                                </a>
                                 <?php if ($as_banner || ($as_list && $as_banner_first && $key === 0) || ($as_banner && $as_banner_first && $key > 0)): ?>
                                    <h2 class="as_banner-content entry-title card-title text-white"><?php the_title(); ?></h2>
                                <?php endif;

                                if ((!$as_banner && ($as_banner_first && $key > 0)) || 
                                    ($as_list && $key > 0)  || 
                                    ($as_list && !$as_banner_first) ||
                                    (!$as_banner && !$as_list)):
                                    ?>
                                    <div class="card-body d-flex flex-column align-items-start <?php echo esc_attr($post_content); ?>">
                                        <?php wp_bootstrap_4_posts_cats(); ?>
                                        <h2 class="entry-title card-title w-100"><a class="" href="<?php the_permalink(); ?>" title="<?php echo wp_kses_post( get_theme_mod( 'blog_grid_link_text', $blog_grid_link_text) ); ?> <?php echo the_title(); ?>"><?php the_title(); ?></a></h2>
                                        <?php if ($excerpt): ?>
                                            <div class="entry-summary <?php echo esc_attr($button_offset); ?>">
												<?php echo the_excerpt(); ?>
										    </div>
                                        <?php endif; ?>
                                        <?php if ($with_button): ?>
                                            <?php echo wp_bootstrap_4_posts_link(); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                            <?php 
                            // Close the wrapping div if the card was used without the a tag
                            if (!($as_banner || ($as_banner_first && $key === 0))): ?>
                                </div> <!-- Close the wrapping card div -->
                            <?php endif; ?>
								
							<?php if ($as_banner_first): ?>
						   <!-- Close the first wrapper or remaining posts wrapper after the last post  -->
						   <?php if ($key === 0) { ?>
							  </div></div> <!-- Close first-post-wrapper -->
						   <?php } elseif ($key == count($cat_posts) - 1) { ?>
							  </div></div> <!-- Close remaining-posts-wrapper -->
						   <?php } ?>
						  <?php endif; ?>
						 
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div> <!-- Close the row div -->
                <?php else : ?>
                    <p>No posts found</p>
                <?php endif; ?>

                <?php if( $link ): ?>
                    <a class="btn <?php echo esc_attr($link_style) .' '. esc_attr($link_size); ?> mt-4" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo esc_attr($link_custom_title ? $link_custom_title : $link_title); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
                <?php if( $extra_link ): ?>
                    <a class="btn <?php echo esc_attr($extra_link_style) .' '. esc_attr($extra_link_size); ?> mt-4 ml-3" href="<?php echo esc_url( $extra_link_url ); ?>" title="<?php echo esc_attr($extra_link_custom_title ? $extra_link_custom_title : $extra_link_title); ?>" target="<?php echo esc_attr( $extra_link_target ); ?>"><?php echo esc_html( $extra_link_title ); ?></a>
                <?php endif; ?>
            </div> <!-- Close col-12 col-lg div -->
        </div> <!-- Close row div -->
    </div> <!-- Close container div -->
</section>
<?php 
}
