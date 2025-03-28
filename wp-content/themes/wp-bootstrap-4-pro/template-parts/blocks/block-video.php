<?php
// Lazyload images
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
$video_thumb = get_sub_field('video_thumb');
$video_url = get_sub_field('video_url');
$video_embed = get_sub_field('video_embed');
if($video_url): 
	 $video_slug = $video_url;
else:
	 $video_slug = '#';
endif;
$text_align = get_sub_field('text_align');
$background_color = get_sub_field('background_color');
// Layout background image
$background_image = get_sub_field('background_image');
$as_parallax = get_sub_field('as_parallax');
$column = get_sub_field('column');
$vertical_offset = get_sub_field('vertical_offset');
$invert_content = get_sub_field('invert_content');
// Custom container
$container = get_sub_field('container');
// Custom class
$custom_class = get_sub_field('custom_class');
// Custom id
$custom_id = get_sub_field('custom_id');

if(!$disable_layout) {
?>

<section id="<?php echo ($custom_id ); ?>" class="section-content <?php echo ($custom_class ); ?> <?php if (!$as_parallax): if($background_image):?><?php echo $lazy; ?><?php endif; endif; ?>" <?php if(!$as_parallax && $lazyload): if($background_image) :?>data-bg="<?php echo $background_image; ?>"<?php endif; endif; ?> style="<?php if ((!$as_parallax && !$lazyload)): if ($background_image):?>background-image: url('<?php echo $background_image; ?>');<?php endif; endif; ?><?php if ($background_color):?>background-color:<?php echo $background_color;?>;<?php endif; ?>">
	
	<?php if ($as_parallax):?>
	<div class="parallax-section">
         <?php if ($background_image):?><img width="1920" height="1040" class="d-inline-block mx-auto <?php echo $lazy; ?>" data-speed="0.3" <?php echo ($src_source .'="'. $background_image.'"'); ?> alt=""/><?php endif; ?>
    </div>
	<?php endif; ?>
	
    <div class="<?php echo ($container ); ?>">
        <div class="row">
            <div class="col-12 <?php echo ($text_align); ?> <?php echo ($invert_content) ? 'text-white' : ''; ?> align-self-center">
                <?php if ($title):?>
                    <h2 class="heading"><?php echo $title; ?></h2>
                <?php endif;?>
				<?php if ($video_url): ?>
					<a class="video-url" href="<?php echo $video_slug;?>" title="<?php if ($label): echo $label; endif;?>"> 
					<?php if($video_thumb):?>
						<img width="348" height="196" class="video_img" src="<?php echo $video_thumb;?>" alt="<?php if ($label): echo $label; endif;?>"/>
						<img class="play-icon" width="64" height="46" src="<?php echo get_template_directory_uri();?>/assets/images/playicon.svg" alt="play icon"/>
					<?php endif;?>
					 </a>
				<?php endif;?>
				<?php if($video_embed):?>
					<div class="video-embed-wrapper">
					<?php echo $video_embed; ?>
					</div>
				<?php endif;?>
            </div>
			<?php if( have_rows( 'videos_repeater' ) ):?>
             <?php while ( have_rows('videos_repeater')) : the_row();
                $video_thumb_repeater = get_sub_field('video_thumb_repeater');
                $video_url_repeater = get_sub_field('video_url_repeater');
				if($video_url_repeater): 
					 $video_slug_repeater = $video_url_repeater;
				else:
					 $video_slug_repeater = '#';
				endif;
			    $video_label = get_sub_field('video_label');
			    $video_embed_repeater = get_sub_field('video_embed_repeater');
                ?>
				<div class="item-video <?php echo ($column); ?> <?php echo ($vertical_offset); ?>">
					<?php if ($video_url_repeater): ?>
						<a class="video-url" href="<?php echo $video_slug_repeater;?>" title="<?php if ($video_label): echo $video_label; endif;?>"> 
						<?php if ($video_thumb_repeater):?>
							<img width="348" height="196" class="video_img" src="<?php echo $video_thumb_repeater;?>" alt="<?php if ($video_label): echo $video_label; endif;?>"/>
							<img class="play-icon" width="64" height="46" src="<?php echo get_template_directory_uri();?>/assets/images/playicon.svg" alt="play icon"/>
						<?php endif;?>
						 </a>
					<?php endif;?>
					<?php if ($video_embed_repeater):?>
						<div class="video-embed-wrapper">
						<?php echo $video_embed_repeater; ?>
						</div>
					<?php endif;?>
				</div>
			 <?php  endwhile; ?>
			<?php else : ?>
				<!-- // no layouts found -->
			<?php endif; ?>
        </div>
    </div>
</section>
<?php 
}

