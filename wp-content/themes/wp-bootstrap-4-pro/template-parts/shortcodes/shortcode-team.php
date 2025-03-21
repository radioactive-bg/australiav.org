<?php
// Shortcode Display Post Type Team
// [post_type_posts category_name="" num="" post_type="team"]
?>
<div class="team-item col-12 col-md-6 col-lg-4 col-xl-3 d-flex mb-4">
	<div class="card">
		<div class="card-header p-0" style="position: relative;">
			<?php the_post_thumbnail('medium', [ 'class' => 'team-img' ]); ?>
			<?php if ( have_rows('social_repeater') ) : ?>
				<div class="team-socials">
					<!-- Loop through. -->
					<?php while( have_rows('social_repeater') ) : the_row();
						// Load sub field value.
						$social_url = get_sub_field('social_url');
						$social_icon = get_sub_field('social_icon');
					?>
						<?php if ($social_url):?>
						<a class="mx-1" rel="noopener norefferer" target="_blank" href="<?php echo $social_url; ?>" title="Follow <?php the_title(); ?>">
							<?php if ($social_icon):?>
							<img width="20" height="20" class="social_img" src="<?php echo $social_icon; ?>" alt="social icon" style="max-width: 20px;"/>
							<?php endif; ?>
						</a>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="card-body d-flex flex-column text-center">
			<h2 class="entry-title card-title h6">
				<?php the_title(); ?>
			</h2>
			<?php if( get_field('team_position') ): ?>
				<p><?php the_field('team_position'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php