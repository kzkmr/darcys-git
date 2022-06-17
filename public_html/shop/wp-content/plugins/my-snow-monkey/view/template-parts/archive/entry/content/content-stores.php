<?php

/**
 * @package snow-monkey
 * @author Basic Figure
 * @license GPL-2.0+
 * @version 13.0.0
 */
?>
<?php

use Framework\Helper;

$post_type_object = get_post_type_object(get_post_type());
$taxonomy = 'stores_type';
$entries_layout   = get_theme_mod(get_post_type() . '-entries-layout');
?>

<div class="c-entry__content p-entry-content p-stores-content">
	<?php echo do_shortcode('[call_php file=pageheader]') ?>
	<?php echo do_shortcode('[call_php file=breadcrumb]') ?>
	<?php echo do_shortcode('[call_php file=stores-search]') ?>
	<?php
	$terms = get_terms(['taxonomy' => $taxonomy]);
	?>

	<div class="p-stores-content__list">
		<?php foreach ($terms as $term) : ?>
			<?php if ($term->count >= 1) : ?>
				<h3><?php echo esc_html($term->name); ?></h3>
				<div class="p-archive p-archive--stores">
					<?php
					$store_posts = get_posts(
						[
							'post_type'      => 'stores',
							'posts_per_page' => -1,
							'tax_query'      => [
								[
									'taxonomy' => $term->taxonomy,
									'field'    => 'slug',
									'terms'    => [$term->slug],
								]
							],
						]
					);
					?>
					<ul class="c-entries c-entries--stores">
						<?php foreach ($store_posts as $post) : setup_postdata($post); ?>
							<?php the_post(); ?>
							<li class="c-entries__item">
								<a href="<?php the_permalink(); ?>">
									<div class="c-entry-summary">
										<div class="c-entry-summary__figure">
											<?php
											if (has_post_thumbnail()) {
												the_post_thumbnail();
											}
											?>
										</div>
										<div class="c-entry-summary__body">
											<p class="c-entry-summary__title"><?php the_title(); ?></p>
											<?php /* echo $term->slug ; */ ?>
											<p class="c-entry-summary__product-title">取扱商品</p>
											<div class="c-entry-summary__term-wrap">
												<?php
												$terms_category = get_the_terms(get_the_ID(), 'stores_product');
												if (!empty($terms_category)) : if (!is_wp_error($terms_category)) :
												?>
														<ul class="c-entry-summary__term-list">
															<?php foreach ($terms_category as $term_category) : ?>
																<li><?php echo $term_category->name; ?></li>
															<?php endforeach; ?>
														</ul>
												<?php endif;
												endif; ?>
											</div>
										</div>
									</div>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		<?php endforeach;
		wp_reset_postdata(); ?>
	</div>

</div>

<script>
	jQuery(function($) {
		$(function() {
			$('.c-entry-summary__term-list li:contains("Ice")').addClass('cat-ice');
			$('.c-entry-summary__term-list li:contains("Coffee")').addClass('cat-coffee');
			$('.c-entry-summary__term-list li:contains("Bread")').addClass('cat-bread');
		});
	});
</script>