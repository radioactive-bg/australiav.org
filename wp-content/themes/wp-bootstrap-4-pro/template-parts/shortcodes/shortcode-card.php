<?php
// Shortcode Display Post Type Card
// [post_type_posts category_name="" num="" post_type="card"]
$url = get_field('url');
?>
<div class="post-card-item col-12 col-md-6 <?php echo in_category('featured-projects')? 'col-lg-4 col-xl-3':'col-lg-4' ;?> d-flex mb-4">
	<div class="card">
		<div class="card-header p-0" style="position: relative;">
			<?php if($url): ?>
				<a rel="noopener norefferer" target="_blank" class="d-block" href="<?php echo $url; ?>" title="View <?php the_title(); ?>">
			<?php endif; ?>
			<?php the_post_thumbnail('medium', [ 'class' => 'img-card' ]); ?>
			<?php if($url): ?>
			</a>
			<?php endif; ?>
		</div>
		<div class="card-body d-flex flex-column text-center">
			<h2 class="entry-title card-title h6">
				<?php the_title(); ?>
			</h2>
		</div>
	</div>
</div>
<?php
